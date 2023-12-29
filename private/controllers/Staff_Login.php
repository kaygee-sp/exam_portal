<?php

/**
 * 
 */
class Staff_Login extends Controller{
	
	function index(){

		$_SESSION['page_title'] = "Staff Login";
		$errors = array();

		if (count($_POST) > 0) {
			$staff = new Staff();
			if (empty($_POST['staff_number']) || !preg_match("/^[0-9]*$/", $_POST['staff_number'])) {
				$errors['staff_number'] = "Please enter your staff number";
			}elseif(empty($_POST['password'])){
				$errors['password'] = "Please enter your password";
			}else{
				if ($row = $staff->staff_login('StaffNumber', $_POST['staff_number'])) {
					$row = $row[0];
					if ($row->StaffPassword === $_POST['password'] && $row->Rank != 'Admin') {
						Auth::authenticate($row);
						$this->redirect('lecture');
					}elseif($row->StaffPassword === $_POST['password'] && $row->Rank = 'Admin'){
						Auth::authenticate($row);
						$this->redirect('exam_department');
					}
				}
				$errors['staff_number'] = "Wrong staff number or password";
				
			}
		}
			

		$this->view("staff_login",[
			'errors'=>$errors
		]);
	}

	
}