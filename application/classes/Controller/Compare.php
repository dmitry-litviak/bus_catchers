<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Compare extends My_Layout_User_Controller {

    public function before() {
        parent::before();
        Helper_Mainmenu::setActiveItem('compare');
    }

    public function action_index() {
        Helper_Output::factory()
                ->link_js('libs/jquery.raty.min')
                ->link_js('compare/index');
        $data['companies'] = ORM::factory('Company')->find_all();
        $this->setTitle('Comparison')
                ->view('compare/index', $data)
                ->render();
    }

}

// End Compare Controller
