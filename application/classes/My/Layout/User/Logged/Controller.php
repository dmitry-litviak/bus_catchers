<?php defined('SYSPATH') or die('No direct script access.');

class My_Layout_User_Logged_Controller extends My_Layout_User_Controller
{
    protected $logged_user;
    
    public function before()
    {
        parent::before();
        if (!Auth::instance()->logged_in())
            $this->redirect('');
        else
            $this->logged_user = Auth::instance()->get_user();
            
    }
}
