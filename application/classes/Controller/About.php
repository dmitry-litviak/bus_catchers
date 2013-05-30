<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_About extends My_Layout_User_Controller {

    public function before() {
        parent::before();
        Helper_Mainmenu::setActiveItem('about');
    }

    public function action_index() {
        $this->setTitle('About')
                ->view('about/index')
                ->render();
    }

    public function action_guide() {
        Helper_Output::factory()
                ->link_js('libs/run_prettify')
                ->link_js('libs/goldens');
        $this->setTitle('Web Scrapping')
                ->view('about/guide')
                ->render();
    }

}

// End About Controller
