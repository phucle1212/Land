<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_district extends CI_Model{
	private $CI;
	public function __contruct(){
		$this->CI =& get_instance();
	}

	public function loadbyprovinceID($provinceid){
		return $this->db->where(array('provinceid' => ,$provinceid ))->from('district')->get()->result_array();
	}
}