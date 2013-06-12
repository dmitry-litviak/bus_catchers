<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Hybridauth_Index extends My_Layout_User_Controller {

    public function action_install() {
        require_once HYBRIDAUTH_PATH . 'hybridauth/install.php';
    }

    public function action_endpoint() {
        require_once HYBRIDAUTH_PATH . 'hybridauth/index.php';
    }

}
