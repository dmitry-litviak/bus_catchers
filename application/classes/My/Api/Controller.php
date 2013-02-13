<?php defined('SYSPATH') or die('No direct script access.');

class My_Api_Controller extends Controller {
    
    protected $_code	 = 200;
    protected $_response = array();

    public function set_response($response = array())
	{
		$this->_response = $response;
        return $this;
	}
        
    protected function send($finish = true)
    {
        //header(':', true, $this->_status);
        header('Content-type: application/json');

        echo json_encode(array('response' => $this->_response));
        if($finish)
            die;
    }




    public function set_code($code = 200, $text = '')
    {
        $this->_code = $code;

        if ($this->_code == '' OR ! is_numeric($this->_code))
        {
            echo 'Status codes must be numeric';
        }

        if (isset(Response::$messages[$this->_code]) AND $text == '')
        {
            $text = Response::$messages[$this->_code];
        }

        if ($text == '')
        {
            echo 'No status text available.  Please check your status code number or supply your own message text.';
        }

        $server_protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : FALSE;

        if (substr(php_sapi_name(), 0, 3) == 'cgi')
        {
            header("Status: {$this->_code} {$text}", TRUE);
        }
        elseif ($server_protocol == 'HTTP/1.1' OR $server_protocol == 'HTTP/1.0')
        {
            header($server_protocol." {$this->_code} {$text}", TRUE, $this->_code);
        }
        else
        {
            header("HTTP/1.1 {$this->_code} {$text}", TRUE, $this->_code);
        }

        return $this;
    }





        
}
