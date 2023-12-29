<?php

class Logout extends Controller{


	function index(){

		Auth::logout();
		
		if ($_SESSION['page_title'] === "Student Home") {
			$this->redirect('student_login');
		}

		if ($_SESSION['page_title'] === "Staff Home") {
			$this->redirect('staff_login');
		}else{
			$this->redirect('staff_login');
		}

		/*if ($_SESSION['page_title'] === "exam_department") {
			$this->redirect('staff_login');
		}*/

		$this->view("student_login");
	}
}