<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	private $auth;

	public function __construct()
    {
        parent::__construct();
        $this->auth = $this->my_auth->check();
        $this->my_layout->setLayout("layout/backend"); 
    }

	public function index()
	{
		if($this->auth == NULL) 
			$this->my_string->php_redirect(HHV_BASE_URL.'backend/auth/login');

		$data['data']['auth'] = $this->auth;
		$this->my_layout->view("backend/home/index", isset($data)?$data:NULL);
	}

	public function lang()
	{
		if($this->auth == NULL) 
			$this->my_string->php_redirect(HHV_BASE_URL.'backend/auth/login');

		$data['data']['auth'] = $this->auth;
		$this->my_layout->view("backend/home/index", isset($data)?$data:NULL);
	}
}

