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
                    ->link_js('public/assets/workspace')
                    ->link_js('libs/jquery-ui.min')
                    ->link_js('libs/jquery.form')
                    ->link_js('libs/jquery.raty.min')
                    ->link_js('company/raty');
            $param = Helper_Output::clean($this->request->param());
            $data['company'] = ORM::factory('Company')->where('name', '=', $param['id'])->find();
            if (!$data['company']->id) {
                $this->redirect('compare');
            }
            $this->session->set('info', $param['id']);
            $this->setTitle('Company')
                    ->view('company/' . $param['id'], $data)
                    ->render();
        }
    }

    public function action_login() {
        $mode = Helper_Output::clean($this->request->query());
        $mode = $mode['type'];
        try {
            $hybridauth = new Hybrid_Auth(HYBRIDAUTH_PATH . 'hybridauth/config.php');

            $user = $hybridauth->authenticate($mode);

            $user_profile = $user->getUserProfile();
            $this->session->set('user', (array)$user_profile);
        } catch (Exception $e) {
            echo $e;
        }
        $this->redirect(URL::site("company/info/" . $_SESSION['info']));
    }
    
    public function action_logout() {
        Session::instance()->delete('user');
        $this->redirect("company/info/" . $_SESSION['info']);
    }
    
    public function action_comment() {
        $post = Helper_Output::clean($this->request->post());
        $comment = ORM::factory('Comment');
        $comment->values($post);
        $comment->save();
        Helper_Jsonresponse::render_json("success", "", $comment->as_array());
    }
    
    public function action_get_comments() {
        $post = Helper_Output::clean($this->request->post());
        $comments = DB::select()->from('comments')->where('company_id', '=', $post['id'])->execute();
        Helper_Jsonresponse::render_json("success", "", $comments->as_array());
    }

}

