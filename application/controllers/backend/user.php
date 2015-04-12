<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	private $auth;

	public function __construct()
    {
        parent::__construct();
        $this->my_layout->setLayout("layout/backend");
        $this->auth = $this->my_auth->check();
        if($this->auth == NULL) 
			$this->my_string->php_redirect(HHV_BASE_URL.'backend');

		/***
		* Permission to access of members group
		***/
		$this->my_auth->allow($this->auth, 'backend/user');
    }

    /*
    ******** Members group
    **********************************************/
    public function group($page = 1)
	{
		$this->my_auth->allow($this->auth, 'backend/user/group');

		/***
		* Sort - follow input location
		***/
		if($this->input->post('sort')){
			$_order = $this->input->post('order');
			foreach ($_order as $keyOrder => $valOrder) {
                $_data[] = array(
                  'id' => $keyOrder ,
                  'order' => (int)$valOrder ,
                  'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600 ),
                );
            }
            $this->db->update_batch('user_group', $_data, 'id'); 
            $this->my_string->js_reload('Sắp xếp thành công!');
		}

		$data['seo']['title'] = "Nhóm thành viên";
		$keyword = $this->input->get('keyword');
		$sort = $this->my_common->sort_orderby($this->input->get('sort_field'), $this->input->get('sort_value'));
		$config = $this->my_common->backend_pagination();
		$config['base_url'] = HHV_BASE_URL.'backend/user/group';

		/***
		* Load pagination when search - follow 'title'
		***/
		if(!empty($keyword)){
			$config['total_rows'] = $this->db->from('user_group')->like('title', $keyword)->count_all_results();
		}
		else{
			$config['total_rows'] = $this->db->from('user_group')->count_all_results();
		}
		$config['uri_segment'] = 4; 
		$config['suffix'] = (isset($sort) && count($sort))?'?sort_field='.$sort['field'].'&sort_value='.$sort['value']:'';
		$config['suffix'] = $config['suffix'].(!empty($keyword)?'&keyword='.$keyword:'');
		$config['first_url'] = $config['base_url'].$config['suffix'];
		$this->pagination->initialize($config); 

		/***
		* Create pagination
		***/
		$data['data']['pagination'] = $this->pagination->create_links();

		/***
		* Load data when search - follow 'title'
		***/
		if(!empty($keyword)){
			$data['data']['_list'] = $this->db->from('user_group')->like('title', $keyword)->limit($config['per_page'], ($page-1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
		}
		else{
			$data['data']['_list'] = $this->db->from('user_group')->limit($config['per_page'], ($page-1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
		}

		$data['data']['_config'] = $config;
		$data['data']['_page'] = $page;
		$data['data']['_sort'] = $sort;
		$data['data']['_keyword'] = $keyword;
		$data['data']['auth'] = $this->auth;
		$this->my_layout->view("backend/user/group", isset($data)?$data:NULL);
	}

	/*
    ******** Add new members group
    **********************************************/
	public function addgroup()
	{
		$this->my_auth->allow($this->auth, 'backend/user/addgroup');

		$data['seo']['title'] = "Thêm nhóm thành viên";
		$data['data']['auth'] = $this->auth;

		if($this->input->post('add')){
			$_post = $this->input->post('data');
			$data['data']['_post'] = $_post; 

			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			if ($this->form_validation->run() == TRUE){
				$_post = $this->my_string->allow_post($_post, array('title', 'allow', 'group'));
				$_post['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$_post['userid_created'] = $this->auth['id'];
				$this->db->insert('user_group', $_post); 
				$this->my_string->js_redirect('Thêm nhóm thành viên thành công!', HHV_BASE_URL.'backend/user/group');
			}
		}
		else{
			$_post['allow'] = 0;
			$data['data']['_post'] = $_post; 
		}
		$this->my_layout->view("backend/user/addgroup", isset($data)?$data:NULL);
	}

	/*
    ******** Edit members group
    **********************************************/
	public function editgroup($id)
	{
		$this->my_auth->allow($this->auth, 'backend/user/editgroup');

		$id = (int)$id;
		$group = $this->db->where(array('id' => $id))->from('user_group')->get()->row_array();
		if(!isset($group) || count($group) == 0)
			$this->my_string->php_redirect(HHV_BASE_URL.'backend');

		$data['seo']['title'] = "Sửa đổi nhóm thành viên";
		$data['data']['auth'] = $this->auth;

		if($this->input->post('edit')){
			$_post = $this->input->post('data');
			$data['data']['_post'] = $_post; 

			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required');
			if ($this->form_validation->run() == TRUE){
				$_post = $this->my_string->allow_post($_post, array('title', 'allow', 'group'));
				$_post['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$_post['userid_updated'] = $this->auth['id'];
				$this->db->where(array('id' => $id))->update('user_group', $_post);
				$this->my_string->js_redirect('Sửa nhóm thành viên thành công!', HHV_BASE_URL.'backend/user/group');
			}
		}
		else{
			$data['data']['_post'] = $group; 
		}
		$this->my_layout->view("backend/user/editgroup", isset($data)?$data:NULL);
	}

	/*
    ******** Delete members group
    **********************************************/
	public function delgroup($id)
	{
		$this->my_auth->allow($this->auth, 'backend/user/delgroup');
		
		$id = (int)$id;
		$group = $this->db->where(array('id' => $id))->from('user_group')->get()->row_array();
		if(!isset($group) || count($group) == 0)
			$this->my_string->php_redirect(HHV_BASE_URL.'backend');

		$count = $this->db->where(array('groupid' => $group['id']))->from('user')->count_all_results();
		if ($count > 0) {
			$this->my_string->js_redirect('Nhóm "'.$group['title'].'" vẫn còn thành viên!', HHV_BASE_URL.'backend/user/group');
		}
		$this->db->delete('user_group', array('id' => $id)); 
		$this->my_string->js_redirect('Xóa nhóm thành viên thành công!', HHV_BASE_URL.'backend/user/group');
	}
}