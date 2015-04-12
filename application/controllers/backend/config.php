<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends MY_Controller {

	private $auth;
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->my_layout->setLayout("layout/backend");

        $this->auth = $this->my_auth->check();

        if($this->auth == NULL) 
            $this->my_string->php_redirect(HHV_BASE_URL.'backend');
        $this->my_auth->allow($this->auth, 'backend/config');
    }

	public function index($group = 'frontend')
	{
        $this->my_auth->allow($this->auth, 'backend/config/index');
        if(!isset($group) || empty($group))
            $this->my_string->php_redirect(HHV_BASE_URL.'backend');
        $_lang = $this->session->userdata('_lang');
        $config = $this->db->select('label, keyword, value_'.$_lang.', type')->where(array('group' => $group, 'publish' => '1'))->from('config')->get()->result_array();
        if(!isset($config) || count($config) == 0)
            $this->my_string->php_redirect(HHV_BASE_URL.'backend');
        $data['seo']['title'] = "Cấu hình hệ thống";
        $_allow_post = NULL;
        foreach ($config as $keyConfig => $valConfig) {
            $_allow_post[]  = $valConfig['keyword'];
        }
        if($this->input->post('change')){
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;    
            $_post = $this->my_string->allow_post($_post, $_allow_post);
            $_data = NULL;

            foreach ($_post as $keyPost => $valPost) {
                $_data[] = array(
                  'keyword' => $keyPost ,
                  'value_'.$_lang => $valPost ,
                  'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
                );
            }
            $this->db->update_batch('config', $_data, 'keyword'); 
            $this->my_string->js_redirect('Cấu hình hệ thống thành công!', HHV_BASE_URL.'backend/config/index');
        }
        $data['data']['auth'] = $this->auth;
        $data['data']['_config'] = $config;
        $data['data']['_group'] = $group;
        $data['data']['_lang'] = $_lang;
        $this->my_layout->view("backend/config/index", isset($data)?$data:NULL);
    }
}