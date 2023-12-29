<?php

/**
 * 
 */
class Student_login extends Controller{
	
	function index(){

		$_SESSION['page_title'] = "Student Login";
		$errors = array();

		if (count($_POST) > 0) {
			$staff = new Students();
			if (empty($_POST['student_number']) || !preg_match("/^[0-9]*$/", $_POST['student_number'])) {
				$errors['student_number'] = "Please enter your student number";
			}elseif(empty($_POST['password'])){
				$errors['password'] = "Please enter your password";
			}else{
				if ($row = $staff->staff_login('StudentNumber', $_POST['student_number'])) {
					$row = $row[0];
					if ($row->StudentPassword === $_POST['password']) {
						Auth::authenticate($row);
						$this->redirect('student');
					}
				}
				$errors['student_number'] = "Wrong student number or password";
				
			}
		}



		$this->view("student_login",[
			"errors"=>$errors
		]);
	}

	
}