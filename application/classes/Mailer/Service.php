<?php defined('SYSPATH') or die('No direct script access.');
class Mailer_Service extends Mailer
{
	public function before()
	{
		$this->config = Kohana::$environment;
	}
        

        public function request($args)
	{
		$this->type 		= 'html';
		$this->to 		= array('web.alex.leontev@gmail.com' => 'Alex Leontev');
		$this->from 		= array($args['user']['email'] => $args['user']['user_fullname']);
		$this->subject		= 'Reqest Callback!';
		$this->data 		= $args;
	}
        
}