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
                    ->link_js('libs/jquery.validate.min')
                    ->link_js('public/assets/workspace')
                    ->link_js('libs/jquery-ui.min')
                    ->link_js('libs/jquery.form')
                    ->link_js('libs/jquery.raty.min')
                    ->link_js('company/raty')
                    ->link_css('font-awesome')
                    ->link_css('social-buttons');
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
            $this->session->set('user', (array) $user_profile);
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
        $comments = DB::select()->from('comments')
                ->join(DB::expr('(SELECT comment_id, SUM(vote) AS votes FROM votes GROUP BY comment_id) AS votes'), 'LEFT')
                ->on('votes.comment_id', '=', 'comments.id')
                ->where('comments.company_id', '=', $post['id'])
                ->order_by('votes', 'desc')
                ->execute()->as_array();
        foreach ($comments as $key => $comment) {
            $comments[$key]['date'] = Helper_Output::ago(strtotime($comment['date']));
//            $votes = DB::select(array(DB::expr('SUM(vote)'), 'votes'))
//                    ->from('votes')
//                    ->where('comment_id', '=', $comment['id'])
//                    ->execute()
//                    ->get('votes');
            $comments[$key]['votes'] = $comment['votes'] ? $comment['votes'] : 0;
        }
        Helper_Jsonresponse::render_json("success", "", $comments);
    }

    public function action_vote() {
        $post = Helper_Output::clean($this->request->post());
        $vote = ORM::factory('Vote')
                ->where('comment_id', '=', $post['comment_id'])
                ->where('user_id', '=', $post['user_id'])
                ->find();
        if ($post['sign'] == '+') {
            $post['vote'] = 1;
        }

        if ($post['sign'] == '-') {
            $post['vote'] = -1;
        }

        if ($vote->id) {
            Helper_Jsonresponse::render_json('error', "", "You have already voted for this comment");
        } else {
            unset($post['sign']);
            $new_vote = ORM::factory('Vote');
            $new_vote->values($post);
            $new_vote->save();
            Helper_Jsonresponse::render_json('success', "", "");
        }
    }

}

