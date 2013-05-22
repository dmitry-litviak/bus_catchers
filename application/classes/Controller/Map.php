<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Map extends My_Layout_User_Controller {

    public function before() {
        parent::before();
        Helper_Mainmenu::setActiveItem('map');
    }

    public function action_index() {
        Helper_Output::factory()
                ->link_js('public/assets/workspace')
                ->link_js('map/index');
        $get = Helper_Output::clean($this->request->query());
        if (count($get)) {
//            $data['depart'] = ORM::factory('Station')
//                        ->where('city', '=', $get['depart'])
//                        ->where('company_name', '=', $get['company'])
//                        ->find_all();
//            $data['arrive'] = ORM::factory('Station')
//                        ->where('city', '=', $get['arrive'])
//                        ->where('company_name', '=', $get['company'])
//                        ->find_all();
            $data['d_city'] = ORM::factory('City')->where('name', '=', substr($get['depart'], 0, strpos($get['depart'], ',')))->find();
            $data['a_city'] = ORM::factory('City')->where('name', '=', substr($get['arrive'], 0, strpos($get['arrive'], ',')))->find();
        } else {
            $data['d_city'] = (object) array(
                        'lat' => 40,
                        'long' => -78
            );
            $data['a_city'] = (object) array(
                        'lat' => 40,
                        'long' => -78
            );
        }
        $this->setTitle('Map')
                ->view('map/index', $data)
                ->render();
    }

    public function action_get_markers() {
        Helper_Jsonresponse::render_json('success', null, DB::select('*')->from('stations')->execute()->as_array());
    }

    public function action_get_info() {
        Helper_Jsonresponse::render_json('success', null, DB::select('*')->from('stations')->where('id', '=', $this->request->post('id'))->execute()->as_array());
    }

}

// End Compare Controller
