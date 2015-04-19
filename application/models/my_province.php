<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_province extends CI_Model{
	private $CI;
	public function __contruct(){
		$this->CI =& get_instance();
	}

	public function loadall(){
		return $this->db->get('province');
	}
}