<?php defined('SYSPATH') or die('No direct script access.');

class My_Rest_Controller extends My_Api_Controller {

	/**
	 * @var  array  REST types
	 */
	protected $_action_map = array
	(
		HTTP_Request::GET    => 'index',
		HTTP_Request::PUT    => 'update',
		HTTP_Request::POST   => 'create',
		HTTP_Request::DELETE => 'delete',
	);

	/**
	 * @var  string  requested action
	 */
	protected $_action_requested = '';

	/**
	 * Checks the requested method against the available methods. If the method
	 * is supported, sets the request action from the map. If not supported,
	 * the "invalid" action will be called.
	 */
	public function before()
	{
		$this->_action_requested = $this->request->action();
                
		$method = Arr::get($_SERVER, 'HTTP_X_HTTP_METHOD_OVERRIDE', $this->request->method());
                
		if ( ! isset($this->_action_map[$method]))
		{
			$this->request->action('invalid');
		}
		else
		{
			$this->request->action($this->_action_map[$method]);
		}

		return parent::before();
	}

	/**
	 * undocumented function
	 */
	public function after()
	{
		if (in_array(Arr::get($_SERVER, 'HTTP_X_HTTP_METHOD_OVERRIDE', $this->request->method()), array(
			HTTP_Request::PUT,
			HTTP_Request::POST,
			HTTP_Request::DELETE)))
		{
			$this->response->headers('cache-control', 'no-cache, no-store, max-age=0, must-revalidate');
		}
	}

	/**
	 * Sends a 405 "Method Not Allowed" response and a list of allowed actions.
	 */
	public function action_invalid()
	{
		// Send the "Method Not Allowed" response
		$this->response->status(405)
			->headers('Allow', implode(', ', array_keys($this->_action_map)));
	}

} // End REST