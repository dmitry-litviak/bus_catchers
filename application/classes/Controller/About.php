<?php defined('SYSPATH') or die('No direct script access.');

class Controller_About extends My_Layout_User_Controller {

    public function before()
    {
        parent::before();
        Helper_Mainmenu::setActiveItem('about');
    }

    public function action_index()
    {
//        Helper_Output::factory()->link_js('home/index');

        $this->setTitle('About')
            ->view('about/index')
            ->render();
    }


} // End Home Controller
