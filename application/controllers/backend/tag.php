<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag extends MY_Controller 
{
	private $auth;

	public function __construct()
    {
        parent::__construct();
        $this->my_layout->setLayout("layout/backend");
        $this->auth = $this->my_auth->check();
        if($this->auth == NULL) 
			$this->my_string->php_redirect(base_url().'backend');

		/***
		* Permission to access
		***/
		$this->my_auth->allow($this->auth, 'backend/tag');
    }

    /*
    ******** tagertise
    **********************************************/
    public function index($page = 1)
	{
		$this->my_auth->allow($this->auth, 'backend/tag/index');

		$keyword = $this->input->get('keyword');
		$sort = $this->my_common->sort_orderby($this->input->get('sort_field'), $this->input->get('sort_value'));
		$config = $this->my_common->backend_pagination();
		$config['base_url'] = base_url().'backend/tag/index';

		/***
		* Load pagination when search
		***/
		if(!empty($keyword)){
			$config['total_rows'] = $this->db->from('tag')->like('title', $keyword)->count_all_results();
		}
		else{
			$config['total_rows'] = $this->db->from('tag')->count_all_results();
		}

		// Trang này ko có data. Load trang trước của nó
        $_totalpage = ceil($config['total_rows']/$config['per_page']);
        $page = ($page > $_totalpage)?$_totalpage:$page;

		$config['uri_segment'] = 4; 
		$config['suffix'] = (isset($sort) && count($sort))?'?sort_field='.$sort['field'].'&sort_value='.$sort['value']:'';
		$config['suffix'] = $config['suffix'].(!empty($keyword)?'&keyword='.$keyword:'');
		$config['first_url'] = $config['base_url'].$config['suffix'];
		if ($config['total_rows'] > 0) {
			$this->pagination->initialize($config); 

			/***
			* Create pagination
			***/
			$data['data']['pagination'] = $this->pagination->create_links();

			/***
			* Load data when search - follow 'title'
			***/
			if(!empty($keyword)){
				$data['data']['_list'] = $this->db->from('tag')->like('title', $keyword)->limit($config['per_page'], ($page-1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
			else{
				$data['data']['_list'] = $this->db->from('tag')->limit($config['per_page'], ($page-1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
		}
		$data['data']['_config'] = $config;
		$data['data']['_page'] = $page;
		$data['data']['_sort'] = $sort;
		$data['data']['_keyword'] = $keyword;
		$data['seo']['title'] = "chủ đề";
		$data['data']['auth'] = $this->auth;
		$this->my_layout->view("backend/tag/index", isset($data)?$data:NULL);
	}

	/*
    ******** Add new tagertise
    **********************************************/
	public function add()
	{
		$this->my_auth->allow($this->auth, 'backend/tag/add');

		if($this->input->post('add')){
			$_post = $this->input->post('data');
			$data['data']['_post'] = $_post; 

			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required|callback__alias');
			if ($this->form_validation->run() == TRUE){
				$_post = $this->my_string->allow_post($_post, array('title', 'publish', 'description', 'meta_title', 'meta_keywords', 'meta_description'));
				$_post['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$_post['userid_created'] = $this->auth['id'];
				$_post['alias'] = $this->my_string->alias($_post['title']);
				$this->db->insert('tag', $_post); 
				$this->my_string->js_redirect('Thêm chủ đề thành công!', base_url().'backend/tag/index');
			}
		}
		else{
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post; 
		}
		$data['seo']['title'] = "Thêm chủ đề";
		$data['data']['auth'] = $this->auth;
		$this->my_layout->view("backend/tag/add", isset($data)?$data:NULL);
	}

	/*
    ******** Edit tagertise
    **********************************************/
	public function edit($id)
	{
		$this->my_auth->allow($this->auth, 'backend/tag/edit');

		$id = (int)$id;
		$continue = $this->input->get('continue');
		$tag = $this->db->where(array('id' => $id))->from('tag')->get()->row_array();
		if(!isset($tag) || count($tag) == 0)
			$this->my_string->php_redirect(base_url().'backend');

		if($this->input->post('edit')){
			$_post = $this->input->post('data');
			$data['data']['_post'] = $_post; 

			$this->form_validation->set_error_delimiters('<li>', '</li>');
			$this->form_validation->set_rules('data[title]', 'Tiêu đề', 'trim|required|callback__alias['.$tag['title'].']');
			if ($this->form_validation->run() == TRUE){
				$_post = $this->my_string->allow_post($_post, array('title', 'publish', 'description', 'meta_title', 'meta_keywords', 'meta_description'));
				$_post['updated'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$_post['userid_updated'] = $this->auth['id'];
				$_post['alias'] = $this->my_string->alias($_post['title']);
				$this->db->where(array('id' => $id))->update('tag', $_post);
				$this->my_string->js_redirect('Sửa chủ đề thành công!', !empty($continue)?base64_decode($continue):base_url().'backend/tag/index');
			}
		}
		else{
			$data['data']['_post'] = $tag; 
		}
		$data['seo']['title'] = "Sửa chủ đề";
		$data['data']['auth'] = $this->auth;
		$this->my_layout->view("backend/tag/edit", isset($data)?$data:NULL);
	}

	/*
    ******** Delete tagertise
    **********************************************/
	public function del($id)
	{
		$this->my_auth->allow($this->auth, 'backend/tag/del');
		
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$tag = $this->db->where(array('id' => $id))->from('tag')->get()->row_array();
		if(!isset($tag) || count($tag) == 0)
			$this->my_string->php_redirect(base_url().'backend');
		$this->db->delete('tag', array('id' => $id)); 
		$this->my_string->js_redirect('Xóa chủ đề thành công!', !empty($continue)?base64_decode($continue):base_url().'backend/tag/index');
	}

	/***
	* Set validate to date
	***/
	public function _alias($title, $old_title){
		if (empty($old_title)) {
			$count = $this->db->from('tag')->where(array('alias' => $this->my_string->alias($title)))->count_all_results();
		}
		else{
			$count = $this->db->from('tag')->where(array('alias' => $this->my_string->alias($title), 'alias !=' => $this->my_string->alias($old_title)))->count_all_results();
		}
		if ($count > 0) {
			$this->form_validation->set_message('_alias', 'Chủ đề đã tồn tại!');
			return FALSE;
		}
		return TRUE;
	}

	/*
    ******** Set display status
    **********************************************/
	public function set($field, $id)
	{
		$this->my_auth->allow($this->auth, 'backend/tag/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$tag = $this->db->where(array('id' => $id))->from('tag')->get()->row_array();
		if(!isset($tag) || count($tag) == 0)
			$this->my_string->php_redirect(base_url().'backend/tag/index');
		if(!isset($tag[$field]))
			$this->my_string->php_redirect(base_url().'backend/tag/index');
		$this->db->where(array('id' => $id))->update('tag', array($field => (($tag[$field] == 1)?0:1)));
		$this->my_string->js_redirect('Thay đổi trạng thái thành công!', !empty($continue)?base64_decode($continue):base_url().'backend/tag/index');
	}
}