<?php defined('SYSPATH') or die('No direct script access.');
/*
 * @package		PayPal IPN
 * @author      Pap Tamas
 * @copyright   (c) 2012-2013 Pap Tamas
 * @website		https://github.com/paptamas/kohana-paypal-ipn
 * @license		http://www.opensource.org/licenses/isc-license.txt
 *
 */

class Kohana_Controller_PayPal_IPN extends Controller {

    /**
     * Whether to log or not errors
     *
     * @var boolean
     */
    public $log_errors = TRUE;

    /**
     * Whether to use or not SSL when connecting to paypal
     *
     * @var bool
     */
    public $use_ssl = TRUE;

    /**
     * Listener's timeout
     *
     * @var int
     */
    public $timeout = 30;

    /**
     * PapPal IPN listener instance
     *
     * @var PayPal_IPN_Listener
     */
    protected $_listener;

    /**
     * The expected receiver email
     *
     * This should be your primary paypal email address or, if using sandbox,
     * the email address of your seller test user.
     */
    public $expected_receiver_email = 'YOUR_EMAIL_ADDRESS';

    /**
     * Main method
     */
    public function action_index()
    {
        // Create and set up listener
        $this->_listener = PayPal_IPN_Listener::factory();
        $this->_listener->use_ssl = $this->use_ssl;
        $this->_listener->timeout = $this->timeout;

        try
        {
            // Process the notification
            $this->_listener->process_ipn($this->request->post());

            if ($this->_listener->is_verified())
            {
                // The payment is VERIFIED, process it
                $this->_process_verified_payment();
            }
            else
            {
                // The payment is INVALID, process it
                $this->_process_invalid_payment();
            }
        }
        catch (Kohana_Exception $e)
        {
            // Something went wrong, log the error
            if ($this->log_errors)
            {
                Log::instance()->add(Log::NOTICE, $e->getMessage());
            }
        }
    }

    /**
     * Process a verified payment
     */
    protected function _process_verified_payment()
    {
        switch ($this->_listener->payment_status())
        {
            case 'Completed':
                $this->_process_completed_payment();
                break;
            case 'Pending':
                $this->_process_pending_payment();
                break;
            case 'Denied':
                $this->_process_denied_payment();
                break;
            case 'Refunded':
                $this->_process_refunded_payment();
                break;
            case 'Reversed':
                $this->_process_reversed_payment();
                break;
            case 'Canceled_Reversal':
                $this->_process_canceled_reversal_payment();
                break;
        }
    }

    /**
     * Process an invalid payment
     */
    protected function _process_invalid_payment()
    {
        /**
         * Do something with this invalid payment, for example save the
         * text report (($this->_listener->get_text_report())) to db, or just ignore it.
         */
    }

    /**
     * Process completed payment
     */
    protected function _process_completed_payment()
    {
        $this->_check_and_save();
    }

    /**
     * Process pending payment
     */
    protected function _process_pending_payment()
    {
        $this->_check_and_save();
    }

    /**
     * Process denied payment
     */
    protected function _process_denied_payment()
    {
        $this->_check_and_save();
    }

    /**
     * Process refunded payment
     */
    protected function _process_refunded_payment()
    {
        $this->_check_and_save();
    }

    /**
     * Process reversed payment
     */
    protected function _process_reversed_payment()
    {
        $this->_check_and_save();
    }

    /**
     * Process canceled reversal payment
     */
    protected function _process_canceled_reversal_payment()
    {
        $this->_check_and_save();
    }

    /**
     * Check if the receiver email is the expected one, and the transaction
     * is unique. If yes, save the payment to database.
     */
    protected function _check_and_save()
    {
        if ($this->_listener->check_email($this->expected_receiver_email))
        {
            if ($this->_listener->is_unique_transaction())
            {
                // Save payment to db
                $this->_listener->save_payment();
            }
            else
            {
                // This transaction id was already used
                if ($this->log_errors)
                {
                    $message = strtr('Not unique transaction: [:transaction_id] [:payment_status].', array(
                        ':transaction_id' => $this->_listener->get_post_data('txn_id'),
                        ':payment_status' => $this->_listener->get_post_data('payment_status')
                    ));
                    Log::instance()->add(Log::NOTICE, $message);
                }
            }
        }
        else
        {
            // The receiver email address is not the expected one
            if ($this->log_errors)
            {
                $message = strtr('Email addresses does not match: [:email_posted] [:email_expected].', array(
                    ':email_posted' => $this->_listener->get_post_data('receiver_email'),
                    ':email_expected' => $this->expected_receiver_email
                ));
                Log::instance()->add(Log::NOTICE, $message);
            }
        }
    }
}

// END Kohana_Controller_PayPal_IPN