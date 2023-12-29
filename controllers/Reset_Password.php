<?php
/**
*
*/
class Reset_Password extends Controller{

	function index(){
		/*if (!Auth::check_logged_in()) {
			$this->redirect('staff_login');
		}*/
		
		$_SESSION['page_title'] = "Reset Password";

		echo "<h1> Not available yet. </h1>";
		
		$this->view("reset_password",[
		]);
	}
}