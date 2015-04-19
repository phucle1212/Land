<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_ward extends CI_Model{
	private $CI;
	public function __contruct(){
		$this->CI =& get_instance();
	}

	public function loadbyprovinceID($districtid){
		return $this->db->where(array('districtid' => ,$districtid ))->from('ward')->get()->result_array();
	}
}