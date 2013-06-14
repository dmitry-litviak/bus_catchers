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
    
    public function action_get_avg_rating() {
        $post = Helper_Output::clean($this->request->post());
        $rating = ORM::factory("Comment")->get_avg_rating($post['id']);
        Helper_Jsonresponse::render_json('success', '', $rating);
    }

}

// End Compare Controller
