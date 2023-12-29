<?php

/**
 *main controller class 
 */
class Controller{
	
	protected function view($view, $data = array()){

		extract($data);
		#echo "../private/views/" .$view. ".view.php";
		if (file_exists("../private/views/" .$view. ".view.php")){
		 	require ("../private/views/" .$view. ".view.php");
		}else{
		 	require ("../private/views/404.view.php");
		}
	}

	public function loadModel($model){
		if (file_exists("../private/models/".ucfirst($model).".php")) {
			require ("../private/models/".ucfirst($model).".php");
			return $model = new $model();
		}
		return false;
	}

	public function redirect($link){
		header("Location: ".ROOT."".trim($link, "/"));
		die;
	}
}