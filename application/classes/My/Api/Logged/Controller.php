<?php defined('SYSPATH') or die('No direct script access.');

class My_Api_Logged_Controller extends My_Api_Controller{
    
        public function before()
	{
		parent::before();
                        
                if (!Auth::instance()->logged_in()){
                    $this->setStatus(401)->send();
                }else{
                    $this->logged_user = Auth::instance()->get_user();
                }
	}
}
