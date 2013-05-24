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
        if (!empty($get) && !is_array($get['company'])) {
            $get['company'] = explode(',', $get['company']);
        }
        $data['get'] = $get;
        if (count($get)) {
//            Session::instance()->set('get', $get);
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
        $data['companies'] = ORM::factory('Company')->find_all();
        $this->setTitle('Map')
                ->view('map/index', $data)
                ->render();
    }

    public function action_get_markers() {
//        $get = Session::instance()->get('get');
        $get = Helper_Output::clean($this->request->post());
        $markers = array();
        if (!empty($get)) {
            $markers = DB::select('*')->from('stations')->where('company_name', 'in', $get['companies'])->execute()->as_array();
        }
//        if (!empty($get)) {
//            $markers = DB::select('*')->from('stations')->where('company_name', 'in', $get['companies'])->execute()->as_array();
//            $markers = DB::select()->from('routes')
//                    ->where('origin_key', 'IN', DB::select('id')
//                            ->from('stations')
//                            ->where('company_name', '=', $get['company'])
//                            ->where('city', '=', $get['depart']))
//                    ->join("stations", "LEFT")
//                    ->on("routes.origin_key", "=", "stations.id")
//                    ->execute()
//                    ->as_array();
//        }
        Helper_Jsonresponse::render_json('success', null, $markers);
    }

    public function action_get_info() {
        $station = DB::select('*')->from('stations')->where('id', '=', $this->request->post('id'))->execute()->as_array();
        Helper_Jsonresponse::render_json('success', null, $station);
    }

}

// End Compare Controller
