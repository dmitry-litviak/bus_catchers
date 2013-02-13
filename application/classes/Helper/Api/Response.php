<?php 
class Helper_Api_Response
{
	protected $status        = 200;
	protected $response      = array();

        public static function factory() {
            return new Helper_Api_Response();
        }

        public function setStatus($status = 200) 
	{
		$this->status = $status;
                return $this;
	}

	public function setResponse($response = array()) 
	{
		$this->response = $response;
                return $this;
	}

	public function send()
	{
                header(':', true, $this->status);
		header('Content-type: application/json');
		echo json_encode(array(
				'message'	=> Response::$messages[$this->status],
				'response'	=> $this->response
			));
		die();
	}
        
       
}