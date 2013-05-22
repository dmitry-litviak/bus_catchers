<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Company extends My_Layout_User_Controller {

    public function before() {
        parent::before();
        Helper_Mainmenu::setActiveItem('compare');
    }

    public function action_info() {
        if ($this->request->param('id')) {
            Helper_Output::factory()->link_js('compare/index');
            $param = Helper_Output::clean($this->request->param());
            $data['company'] = ORM::factory('Company')->where('name', '=', $param['id'])->find();
            if (!$data['company']->id) {
                $this->redirect('compare');
            }
            $this->setTitle('Company')
                    ->view('company/'.$param['id'], $data)
                    ->render();
        }
    }

}

// End Compare Controller
