<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Saigon');
        $_lang = $this->session->userdata('_lang');
        if (!isset($_lang) || empty($_lang)) {
        	$this->session->set_userdata('_lang', 'vi');
        }
    }
}