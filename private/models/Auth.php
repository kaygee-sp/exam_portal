<?php

/**
 * 
 */
class Auth{
	
	public static function authenticate($row){
		$_SESSION['USER'] = $row;
	}

	public static function logout(){
		if (isset($_SESSION['USER'])) {
			unset($_SESSION['USER']);
		}
	}

	public static function check_logged_in(){
		if (isset($_SESSION['USER'])) {
			return true;
			//unset($_SESSION['USER']);
		}else{
			return false;
		}
	}

	public static function user(){
		if (isset($_SESSION['USER'])) {
			return $_SESSION['USER'];
		}else{
			return false;
		}
	}

	public static function __callStatic($method, $params){
		//display($params);
		$property = strtolower(str_replace('get', '' , $method));

		if (isset($_SESSION['USER']->$property)) {
			return $_SESSION['USER']->$property;
		}else{
			return "Unknown";
		}
	}
}