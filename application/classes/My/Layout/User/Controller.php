<?php

defined('SYSPATH') or die('No direct script access.');

class My_Layout_User_Controller extends My_Layout_Controller {

    protected $session;
    
    public function before() {
        parent::before();
        $this->session = Session::instance();
        //choose main template
        Helper_Mainmenu::init(Kohana::$config->load('main_menu')->as_array());

        $this->template = View::factory('layouts/main');
        Helper_Output::factory()
                ->link_css('custom')
        ;
    }

}
