<?php defined('SYSPATH') or die('No direct script access.');

class My_Layout_Controller extends Controller {
	
	protected $_separator   = ' | ';
	protected $_prefix 	= 'BusCatchers';
	protected $_title 	= '';
	protected $_keywords	= '';
	protected $_description	= '';
	protected $_data	= array();

	public function before()
	{
                
		$config                 = Kohana::$config->load('config');
		$this->_title 		= $config->get('Site Title');
		$this->_keywords 	= $config->get('Site Keywords');
		$this->_description     = $config->get('Site Description');
                
                //include mandatory css js for both side ( Client & Admin )
		Helper_Output::factory()
                                        ->link_js('libs/jquey-1.8.2.min')
                                        ->link_js('libs/bootstrap.min')
                                        ->link_js('libs/holder_js/holder')
                                        ->link_js('default')
                                        ->link_js('libs/jquery.mobile.customized.min')
                                        ->link_js('libs/jquery.easing.1.3')
                                        ->link_js('libs/underscore-min')
                                        ->link_js('libs/canvasloader-min')
                                        ->link_js('application')
                                        ->link_css('bootstrap.min')
                                        ->link_css('bootstrap-responsive.min')
                                        ->link_css('main')
                                        ->link_css('icons/general/stylesheets/general_foundicons')
                                        ->link_css('icons/social/stylesheets/social_foundicons')
                                        ->link_css('fontawesome/css/font-awesome.min')
                                        ;
	}

	/*
	*  SEO data
	*/
	public function setTitle($title = '')
	{
		if($title != '') {
			$this->_title = __($title).$this->_separator.__($this->_prefix);
		}
                
		return $this;
	}

	public function setKeyword($text = '')
	{
		if($text != '') {
			$this->_keywords = $text;
		}
		return $this;
	}

	public function setDescription($text = '')
	{
		if($text != '') {
			$this->_description = $text;
		}
		return $this;
	}

	/*
	* set partial template
	*/
	public function view($partials = '', $data = array())
	{
		$this->template->content = View::factory($partials);

		if(!empty($data)) {
			$this->setData($data, $this->template->content);
		}
		return $this;
	}

	public function setData($data = array(), $scope = false)
	{
		if(!empty($data)) {
			foreach ($data as $key => $value) {
				if($scope) {
					$scope->$key = $value;
				}
				$this->template->$key = $value;
			}
		}

		$this->_data = $data;

		return $this;
	}

	/*
	* @param $format:: html(default), json
	*/
	public function render($format = 'html')
	{
		 $this->template->title 		= $this->_title;
		 $this->template->keywords 		= $this->_keywords;
		 $this->template->description 	= $this->_description;
		 switch($format) {
		 	case 'html': 
		 		$this->response->body($this->template);
		 		break;
		 	case 'json':
		 		header('Content-type: text/json');
				header('Content-type: application/json');
				echo json_encode($this->_data);
		 		break;
		 }
	}
}