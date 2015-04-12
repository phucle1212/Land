<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	private $auth;

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->my_layout->setLayout("layout/backend");

        $this->auth = $this->my_auth->check();

        if($this->auth == NULL) 
			$this->my_string->php_redirect(HHV_BASE_URL.'backend');

		$this->my_auth->allow($this->auth, 'backend/account');
    }

    /*
    ******** Change account information 
    **********************************************/
	public function info()
	{
		$this->my_auth->allow($this->auth, 'backend/account/info');
		$user = $this->db->where(array('username' => $this->auth['username']))->from('user')->get()->row_array();
		if(!isset($user) || count($user) == 0)
			$this->my_string->php_redirect(HHV_BASE_URL.'backend');
		$data['seo']['title'] = "Thay đổi thông tin tài khoản";
		$_post = $user;

		if($this->input->post('change')){
			$_post = $this->input->post('data');
			print_r($_post);
			$data['data']['_post'] = $_post; 

			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|required|valid_email|callback__email');
			if ($this->form_validation->run() == TRUE)
			{
				$_post = $this->my_string->allow_post($_post, array('email', 'fullname'));
				$_post['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->where(array('username' => $user['username']))->update('user', $_post); 
				$this->my_string->js_redirect('Thay đổi thông tin tài khoản thành công!', HHV_BASE_URL.'backend/auth/login');
			}
		}

		$data['data']['_post'] = $_post;
		$data['data']['auth'] = $this->auth;
		$this->my_layout->view("backend/account/info", isset($data)?$data:NULL);
	}

	/*
    ******** Change password
    **********************************************/
	public function password()
	{
		$this->my_auth->allow($this->auth, 'backend/account/password');
		$user = $this->db->where(array('username' => $this->auth['username']))->from('user')->get()->row_array();
		if(!isset($user) || count($user) == 0)
			$this->my_string->php_redirect(HHV_BASE_URL.'backend');
		$data['seo']['title'] = "Thay đổi mật khẩu";
		if($this->input->post('change')){
			$_post = $this->input->post('data');
			$data['data']['_post'] = $_post; 

			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[oldpassword]', 'Mật khẩu cũ', 'trim|required|callback__oldpassword');
			$this->form_validation->set_rules('data[newpassword]', 'Mật khẩu mới', 'trim|required');
			$this->form_validation->set_rules('data[renewpassword]', 'Xác nhận mật khẩu mới', 'trim|required||matches[data[newpassword]]');
			if ($this->form_validation->run() == TRUE)
			{
				$_temp = $_post; unset($_post);
				$_post['password'] = $_temp['newpassword'];
				$_post['salt'] = $this->my_string->random(69, TRUE);
				$_post['password'] = $this->my_string->encode_password($user['username'], $_post['password'], $_post['salt']);
				$_post['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->where(array('username' => $user['username']))->update('user', $_post); 
				$this->my_string->js_redirect('Thay đổi mật khẩu thành công!', HHV_BASE_URL.'backend/auth/login');
			}
		}
		
		$data['data']['auth'] = $this->auth;
		$this->my_layout->view("backend/account/password", isset($data)?$data:NULL);
	}

	/***
	* Set validate to email
	***/
	public function _email($email = NULL){
		$count = $this->db->where(array('email' => $email, 'email !=' => $this->auth['email']))->from('user')->count_all_results();
		if($count > 0){
			$this->form_validation->set_message('_email', 'Email '.$email.' đã tồn tại.');
			return FALSE;
		}
		return TRUE;
	}

	/***
	* Set validate to oldpassword
	***/
	public function _oldpassword($oldpassword = NULL){
		$user = $this->db->from('user')->where(array('id' => $this->auth['id']))->get()->row_array();
		$oldpassword= $this->my_string->encode_password($user['username'], $oldpassword, $user['salt']);
		if($user['password'] != $oldpassword){
			$this->form_validation->set_message('_oldpassword', '%s không chính xác');
			return FALSE;
		}
		return TRUE;
	}
}