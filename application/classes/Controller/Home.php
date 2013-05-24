<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends My_Layout_User_Controller {

    public function action_index() {
        Helper_Output::factory()
                ->link_js('libs/jquery.form')
                ->link_js('libs/tablesorter')
                ->link_js('libs/tablesorter.widget')
                ->link_js('public/assets/workspace')
                ->link_js('home/index')
                ->link_css('theme.bootstrap');
        $data['cities'] = ORM::factory('City')->find_all();
        $data['companies'] = ORM::factory('Company')->find_all();
        $data['dates'] = Helper_Output::get_next_n_days(7);
        $this->setTitle(Kohana::$config->load('config')->get('Site Title'))
                ->view('home/index', $data)
                ->render();
    }

    public function action_get_schedule() {

        $table_name = Helper_Output::db_name_date($this->request->post('depart_time'));
//        $table_name = '2013February12';
        try {
            //if table is not exist, then this row through an error
            $companies = $this->request->post('companies');
            if (!empty($companies)) {
                $tables = DB::query(Database::SELECT, "SHOW FULL COLUMNS FROM " . $table_name)->execute()->as_array();
                $query = DB::select('*')->from($table_name)
                        ->where('DEPART_CITY', '=', $this->request->post('depart_city'))
                        ->where('ARRIVE_CITY', '=', $this->request->post('arrive_city'))
                        ->where('TRIP_COST', '!=', NULL);
                if ($this->request->post('companies')) {
                    $query = $query->where_open();
                    foreach ($this->request->post('companies') as $company) {
                        $query = $query->or_where('COMPANY_NAME', '=', $company);
                    }
                    $query = $query->where_close();
                }
                $result = $query->execute()->as_array();
//            sleep(10);
                foreach ($result as &$item) {
                    $item['DEPART_TIME'] = Helper_Output::time_for_table($item['DEPART_TIME']);
                    $item['ARRIVE_TIME'] = Helper_Output::time_for_table($item['ARRIVE_TIME']);
                    $item['TRIP_LENGTH'] = $item['TRIP_LENGTH'] != 'NULL' ? strtolower(str_replace('m', 'min', $item['TRIP_LENGTH'])) : '--';
                }
            } else {
                $result = array();
            }
            if (empty($result)) {
                Helper_Jsonresponse::render_json('error', 'Fares not available for this search query', null);
            } else {
                Helper_Jsonresponse::render_json('success', null, $result);
            }
        } catch (Database_Exception $e) {
            Helper_Jsonresponse::render_json('error', 'Fares not available for this search query', null);
        }
    }

}

// End Home Controller
