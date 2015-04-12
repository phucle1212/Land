<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_string {
	private $CI;
	public function __construct(){
		$this->CI =& get_instance();
	}

	public function random($leng = 10, $char = FALSE){
		if($char = FALSE) $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
		else $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		mt_srand((double)microtime() * 1000000);
		$salt = '';
		for ($i=0; $i < $leng; $i++) { 
			$salt = $salt . substr($s, (mt_rand()%(strlen($s))), 1);
		}
		return $salt;
	}

	public function encode_password($username, $password = '', $salt = ''){
		return md5($salt.$username.md5($salt.$username.md5($password).$username.$salt).$salt);
	}

	public function encode_cookie($cookie){
		return $this->random(10).base64_encode($cookie);
	}

	public function decode_cookie($cookie){
		return base64_decode(substr($cookie, 10));
	}

	public function encode_folder($cookie){
		return $this->random(10).base64_encode($cookie);
	}

	public function decode_folder($cookie){
		return base64_decode(substr($cookie, 10));
	}
	
	public function allow_post($param, $allow){
		$_temp = NULL;
		if(isset($param) && count($param) && isset($allow) && count($allow)){
			foreach ($param as $key => $val) {
				if (in_array($key, $allow) ==TRUE) {
					$_temp[$key] = trim($val);
				}
			}
			return $_temp;
		}
		return $param;
	}

	public function php_redirect($url){
		header('Location: '.$url); 
		die;
	}

	public function js_redirect($alert, $url){
		die('<meta charset="UTF-8"><script type="text/javascript">alert(\'' .$alert. '\'); location.href = \'' .$url. '\';</script>');
	}

	public function js_reload($alert){
		die('<meta charset="UTF-8"><script type="text/javascript">alert(\'' .$alert. '\'); location.reload();</script>');
	}

	public function trim_array($arr){
		if (isset($arr) && count($arr)) {
			$_arr = NULL;
			foreach ($arr as $key => $val) {
				$val = trim($val);
				if (empty($val)) {
					continue;
				}
				$_arr[] = $val;
			}
		}
		return $_arr;
	}
}