<?php defined('SYSPATH') or die('No direct script access.');
/*
 * @package		PayPal IPN
 * @author      Pap Tamas
 * @copyright   (c) 2012-2013 Pap Tamas
 * @website		https://github.com/paptamas/kohana-paypal-ipn
 * @license		http://www.opensource.org/licenses/isc-license.txt
 *
 */

class Kohana_PayPal_IPN_Listener {

    const PAYPAL_HOST = 'www.paypal.com';
    const SANDBOX_HOST = 'www.sandbox.paypal.com';

    /**
     *  If true, an SSL secure connection (port 443) is used for the post back
     *  as recommended by PayPal. If false, a standard HTTP (port 80) connection
     *  is used. Default true.
     *
     *  @var boolean
     */
    public $use_ssl = TRUE;

    /**
     *  The amount of time, in seconds, to wait for the PayPal server to respond
     *  before timing out. Default 30 seconds.
     *
     *  @var int
     */
    public $timeout = 30;

    private $_post_data = array();
    private $_post_uri = '';
    private $_response_status = '';
    private $_response = '';

    private $_is_verified;

    /**
     *  Post back using fsockopen()
     *
     *  Sends the post back to PayPal using the fsockopen() function. Called by
     *  the process_ipn(). Throws an exception if the post fails.
     *  Populates the response, response_status, and post_uri properties on success.
     *
     * @param  string  The post data as a URL encoded string
     * @throws Kohana_Exception
     */
    protected function post_back_data($encoded_data)
    {

        if ($this->use_ssl)
        {
            $uri = 'ssl://'.$this->get_paypal_host();
            $port = '443';
            $this->_post_uri = $uri.'/cgi-bin/webscr';
        }
        else
        {
            $uri = $this->get_paypal_host(); // no "http://" in call to fsockopen()
            $port = '80';
            $this->_post_uri = 'http://'.$uri.'/cgi-bin/webscr';
        }

        $fp = fsockopen($uri, $port, $errno, $errstr, $this->timeout);

        if ( ! $fp)
        {
            // fsockopen error
            throw new Kohana_Exception("fsockopen error: [$errno] $errstr", NULL, 1);
        }

        $header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
        $header .= "Host: ".$this->get_paypal_host()."\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: ".strlen($encoded_data)."\r\n";
        $header .= "Connection: Close\r\n\r\n";

        fputs($fp, $header.$encoded_data."\r\n\r\n");

        while( ! feof($fp))
        {
            if (empty($this->_response))
            {
                // extract HTTP status from first line
                $this->_response .= $status = fgets($fp, 1024);
                $this->_response_status = trim(substr($status, 9, 4));
            }
            else
            {
                $this->_response .= fgets($fp, 1024);
            }
        }

        fclose($fp);
    }

    /**
     * Get paypal host
     *
     * @return string
     */
    private function get_paypal_host()
    {
        return (intval($this->get_post_data('test_ipn')) == 1)
            ? self::SANDBOX_HOST
            : self::PAYPAL_HOST;
    }

    /**
     * Get POST data
     *
     * Returns the data posted by PayPal to the IPN listener
     *
     * @param null $key
     * @param null $default
     * @return mixed
     */
    public function get_post_data($key = NULL, $default = NULL)
    {
        if ($key === NULL)
        {
            return $this->_post_data;
        }
        else
        {
            return (isset($this->_post_data[$key]))
                ? $this->_post_data[$key]
                : $default;
        }
    }

    /**
     *  Get POST URI
     *
     *  Returns the URI that was used to send the post back to PayPal. This can
     *  be useful for troubleshooting connection problems. The default URI
     *  would be "ssl://www.sandbox.paypal.com:443/cgi-bin/webscr"
     *
     *  @return string
     */
    public function get_post_uri()
    {
        return $this->_post_uri;
    }

    /**
     *  Get response
     *
     *  Returns the entire response from PayPal as a string including all the
     *  HTTP headers.
     *
     *  @return string
     */
    public function get_response()
    {
        return $this->_response;
    }

    /**
     *  Get response status
     *
     *  Returns the HTTP response status code from PayPal. This should be "200"
     *  if the post back was successful.
     *
     *  @return string
     */
    public function get_response_status()
    {
        return $this->_response_status;
    }

    /**
     *  Get Text Report
     *
     *  Returns a report of the IPN transaction in plain text format. This is
     *  useful in emails to order processors and system administrators. Override
     *  this method in your own class to customize the report.
     *
     *  @return string
     */
    public function get_text_report()
    {
        // date and POST url
        $r = str_repeat('-', 80);
        $r .= "\n[".date('Y-m-d H:i:s').'] - '.$this->get_post_uri();

        // HTTP Response
        $r .= str_repeat('-', 80);
        $r .= "\n{$this->get_response()}\n";

        // POST vars
        $r .= str_repeat('-', 80);
        $r .= "\n";

        foreach ($this->get_post_data() as $key => $value) {
            $r .= str_pad($key, 25)." $value\n";
        }
        $r .= "\n\n";

        return $r;
    }

    /**
     *  Process IPN
     *
     *  Handles the IPN post back to PayPal and parsing the response. Call this
     *  method from your IPN listener script. Returns true if the response came
     *  back as "VERIFIED", false if the response came back "INVALID", and
     *  throws an exception if there is an error.
     *
     * @param array
     *
     * @throws Kohana_Exception
     */
    public function process_ipn($post_data = NULL)
    {
        // Create encoded data
        $encoded_data = 'cmd=_notify-validate';

        $this->_post_data = ($post_data) ? $post_data : Request::initial()->post();

        foreach ($this->_post_data as $key => $value) {
            $value = urlencode(stripslashes($value));
            $encoded_data .= "&$key=$value";
        }

        // Post encoded data back to PayPal
        $this->post_back_data($encoded_data);

        // Check response status
        if (strpos($this->_response_status, '200') === FALSE)
        {
            throw new Kohana_Exception("Invalid response status: ".$this->_response_status, NULL, 2);
        }

        if (strpos($this->_response, "VERIFIED") !== FALSE)
        {
            $this->_is_verified = TRUE;
        }
        elseif (strpos($this->_response, "INVALID") !== FALSE)
        {
            $this->_is_verified = FALSE;
        }
        else
        {
            throw new Kohana_Exception("Unexpected response from PayPal.", NULL, 3);
        }
    }

    /**
     * Check if the payment is verified
     *
     * Returns TRUE if payment is "VERIFIED", FALSE if "INVALID"
     *
     * @return mixed
     */
    public function is_verified()
    {
        return $this->_is_verified;
    }

    /**
     * Return the payment status
     *
     * Completed:           The payment has been completed, and the funds have been
     *                      added successfully to your account balance
     *
     * Denied:              You denied the payment. This happens only if the payment was
     *                      previously pending because of possible reasons described for the
     *                      pending_reason variable or the Fraud_Management_Filters_X variable.
     *
     * Refunded:            You refunded the payment
     *
     * Reversed:            A payment was reversed due to a charge-back or other type of reversal.
     *                      The funds have been removed from your account balance and returned to the buyer.
     *                      The reason for the reversal is specified in the ReasonCode element.
     *
     * Canceled_Reversal:   A reversal has been canceled. For example, you won a dispute with the customer,
     *                      and the funds for the transaction that was reversed have been returned to you.
     *
     * Full list of possible payment statuses: http://goo.gl/4ydfC
     *
     * @return string
     */
    public function payment_status()
    {
        return $this->get_post_data('payment_status');
    }

    /**
     * Check if the transaction is unique (based on transaction id and payment status)
     *
     * @return bool
     */
    public function is_unique_transaction()
    {
        return ORM::factory('PayPal_Payment')->is_unique($this->get_post_data('txn_id'), $this->get_post_data('payment_status'));
    }

    /**
     * Check if receiver_email is the email we expect (your Primary PayPal address, or
     * if using sandbox, then your sandbox seller user's email)
     *
     * This handles a situation where another merchant could accidentally or
     * intentionally attempt to use your listener.
     *
     * @param $email - the email address to check
     * @return bool
     */
    public function check_email($email)
    {
        return ($this->_post_data['receiver_email'] == $email);
    }

    /**
     * Save the current payment to database
     */
    public function save_payment()
    {
        $info = '';
        foreach ($this->get_post_data() as $key => $value)
        {
            if ( ! in_array($key, array('txn_id', 'parent_txn_id', 'mc_gross', 'mc_currency', 'payer_id', 'payer_email', 'first_name', 'last_name')))
            {
                $info .= str_pad($key, 25)." $value\n";
            }
        }

        // Create and setup payment
        $payment = ORM::factory('PayPal_Payment');
        $payment->set('transaction_id', $this->get_post_data('txn_id'));
        $payment->set('parent_transaction_id', $this->get_post_data('parent_txn_id'));
        $payment->set('payment_status', $this->get_post_data('payment_status'));
        $payment->set('gross', $this->get_post_data('mc_gross'));
        $payment->set('currency', $this->get_post_data('mc_currency'));
        $payment->set('payer_id', $this->get_post_data('payer_id'));
        $payment->set('payer_email', $this->get_post_data('payer_email'));
        $payment->set('payer_name', $this->get_post_data('first_name', '').' '.$this->get_post_data('last_name', ''));
        $payment->set('payment_date', date('Y-m-d H:i:s'));
        $payment->set('info', $info);

        // Save the payment
        $payment->save();
    }

    /**
     * Factory
     *
     * @return PayPal_IPN_Listener
     */
    public static function factory()
    {
        return new PayPal_IPN_Listener();
    }
}

// END Kohana_PayPal_IPN_Listener