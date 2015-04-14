<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_tags {

	private $CI;
	
	public function __construct(){
		$this->CI =& get_instance();
	}

	public function suggest($char = '', $list = ''){
		$st = '<div class="title">';
		foreach (range('a', 'z') as $i) {
			if ($char == $i) {
				$st = $st . '<a href="'.CMS_URL.CMS_BACKEND.'/tag/suggest/'.$i.CMS_SUFFIX.'" title="Chủ đề với ký tự bắt đầu bằng: '.strtoupper($i).'"><strong>['.$i.']</strong></a>, ';
			}
			else{
				$st = $st . '<a href="'.CMS_URL.CMS_BACKEND.'/tag/suggest/'.$i.CMS_SUFFIX.'" title="Chủ đề với ký tự bắt đầu bằng: '.strtoupper($i).'"> ';
			}
		}
	}
}