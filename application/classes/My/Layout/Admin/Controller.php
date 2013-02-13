<?php defined('SYSPATH') or die('No direct script access.');

class My_Layout_Admin_Controller extends My_Layout_Controller
{
        public function before()
	{
		parent::before();
                $auth = Auth::instance();
                if (!$auth->logged_in() || $auth->get_user()->roles->order_by('role_id', 'desc')->find()->name != 'admin' )
                        $this->redirect('session');
                Helper_Adminsitebar::init(Kohana::$config->load('admin_menu')->as_array());
                
		$this->template = View::factory('layouts/admin');
                
	}
  
}