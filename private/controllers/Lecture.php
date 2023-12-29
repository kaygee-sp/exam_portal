<?php
/**
*
*/
class Lecture extends Controller{
	
	function index(){
		if (!Auth::check_logged_in()) {
			$this->redirect('staff_login');
		}
		
		$_SESSION['page_title'] = "Staff Home";
		$errors = array();
		$staff = new Staff();
		$b = $staff->get_staffNumber_and_moduleCode($_SESSION['USER']->StaffNumber);
		
		$this->view("lecture",[
			"errors"=>$errors,
			"staff"=>$b
		]);
	}

	function set_date(){
		if (!Auth::check_logged_in()) {
			$this->redirect('staff_login');
		}

		$_SESSION['page_title'] = "Set Exam Date";
		$errors = array();
		$modCode = array();
		$staff = new Staff();
		$b = $staff->get_staffNumber_and_moduleCode($_SESSION['USER']->StaffNumber);

		if (count($_POST) > 0) {
			if ($staff->validate($_POST)) {
				$staff->set_exam_date($_POST['modulecode'], $_POST);
				$_SESSION['msg'] = "Exam date was set successfully!";
				#$this->redirect('lecture');
			}else{
				$errors = $staff->errors;
				$_SESSION['msg'] = "";
			}
		}

		$this->view("lecture.add",[
			"errors"=>$errors,
			"modulecode"=>$b,
		]);
	}

	function upload_question_paper(){
		if (!Auth::check_logged_in()) {
			$this->redirect('staff_login');
		}

		$_SESSION['page_title'] = "Upload Question Paper";
		$errors = array();
		$current_module_info = array();
		$staff = new Staff();
		$_SESSION['msg'] = "";
		$msg = "";

		if (isset($_GET['mod']) ) {
			$modulecode = $_GET['mod'];
			$file_name = $modulecode.".pdf";
		}

		$b = $staff->get_staffNumber_and_moduleCode($_SESSION['USER']->StaffNumber);
		foreach ($b as $key) {
			if ($modulecode === $key->ModuleCode) {
				$modCode = $key->ModuleCode;
				$current_module_info = $key;
			}
		}

		if (isset($_POST['upload'])) {
			$upload = new Upload_file();
			$insert = $upload->upload($_POST, $_FILES, $modCode, $file_name, 'lecture');
		}

		$this->view("lecture.upload",[
			"errors"=>$errors,
			"info"=>$current_module_info,
			"msg"=>$msg
		]);
	}
	
}