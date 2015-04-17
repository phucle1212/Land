<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_route {

	private $CI;
	private $auth;
	
	public function __construct(){
		$this->CI =& get_instance();
		$this->auth = $this->CI->my_auth->check(); // lấy data của account đã login vào
	}

	public function insert($param){
		if(isset($param) && count($param) >= 2){
			$this->CI->db->insert('route', $param);
		}
	}

	public function update($param, $url){
		if (isset($url) && !empty($url)) {
			$count = $this->CI->db->where(array('param' => $param))->from('route')->count_all_results();
			if ($count >= 1) {
				$this->CI->db->where(array('param' => $param))->update('route', array(
					'url' => $url,
					'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600)
				));
			}
			else{
				 $this->insert(array(
	                'url' => $url,
	                'param' => $param,
	                'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
	            ));
			}
		}
		else{
			$this->CI->db->delete('route', array('param' => $param));
		}
	}

	public function check_route($route, $old_route){
		$route = $this->CI->my_string->alias($route);
        if (isset($old_route) && !empty($old_route)) {
            $count = $this->CI->db->where(array('url' => $route, 'url !=' => $old_route))->from('route')->count_all_results();
        }
        else {
           $count = $this->CI->db->where(array('url' => $route))->from('route')->count_all_results();
        }
        if($count > 0){
            $this->CI->form_validation->set_message('_route', 'Url '.$route.' đã tồn tại.');
            return FALSE;
        }
        return TRUE;
	}
}