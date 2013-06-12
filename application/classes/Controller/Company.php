<?php

defined('SYSPATH') or die('No direct script access.');

require_once HYBRIDAUTH_PATH . 'hybridauth/Hybrid/Auth.php';

class Controller_Company extends My_Layout_User_Controller {

    public function before() {
        parent::before();
        Helper_Mainmenu::setActiveItem('compare');
    }

    public function action_info() {
        if ($this->request->param('id')) {
            Helper_Output::factory()
                    ->link_js('libs/jquery.raty.min')
                    ->link_js('compare/index');
            $param = Helper_Output::clean($this->request->param());
            $data['company'] = ORM::factory('Company')->where('name', '=', $param['id'])->find();
            if (!$data['company']->id) {
                $this->redirect('compare');
            }
            $this->setTitle('Company')
                    ->view('company/' . $param['id'], $data)
                    ->render();
        }
    }

    public function action_login() {
        $mode = Helper_Output::clean($this->request->query());
        $mode = $mode['type'];
//        Helper_Main::print_flex($_SERVER);die;
        try {
            $hybridauth = new Hybrid_Auth(HYBRIDAUTH_PATH . 'hybridauth/config.php');

            $user = $hybridauth->authenticate($mode);

            $user_profile = $user->getUserProfile();
//            Session::instance()->set($key, $value);
            Helper_Main::print_flex($user_profile);
            
        } catch (Exception $e) {
            echo "Ooophs, we got an error: " . $e->getMessage();
        }
    }
    
    public function action_logout() {
        
    }

}

// End Compare Controller
