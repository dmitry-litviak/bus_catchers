<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Compare extends My_Layout_User_Controller {

    public function before() {
        parent::before();
        Helper_Mainmenu::setActiveItem('compare');
    }

    public function action_index() {
        $data['companies'] = ORM::factory('Company')->find_all();
        $this->setTitle('Compare')
                ->view('compare/index', $data)
                ->render();
    }

}

// End Compare Controller
