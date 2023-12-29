<?php

/**
 * 
 */
class Upload_file extends Model{
	
	function upload($POST, $FILES, $ModuleCode, $file_name, $page_name){
		// code...

		$db = new Model();
		$_SESSION['error'] = "";
		$file_types = array("application/pdf");
		$_SESSION['msg'] = "";

		if(empty($FILES['upload']) || empty($FILES['upload']['name'])){
			$_SESSION['error'] = "Please select a file to upload.";
		}elseif (isset($FILES['upload'])){
			//upload file
			if ($FILES['upload']['name'] != "" && $FILES['upload']['error'] === 0 && in_array( $FILES['upload']['type'], $file_types)) {
				$folder = "uploads/";
				if (!file_exists($folder)) {
					mkdir($folder, 0777, true);
				}

				$_FILES['upload']['name'] = $file_name;
				$destination = $folder.$_FILES['upload']['name'];
				move_uploaded_file($FILES['upload']['tmp_name'], $destination);
			}else{
				$_SESSION['error'] = "This file could not be uploaded";
			}
			

			if ($_SESSION['error'] == "") {
				//save to database
				$_FILES['upload']['name'] = $file_name;
				$insert = $db->upload_question_paper($ModuleCode, $_FILES['upload']['name']);
				$_SESSION['msg'] = "File was uploaded successfully";
			}
		}else{
			$_SESSION['error'] = "";
		}
	}

	function upload_answer($FILES, $transaction_id, $upload_time, $file_name, $saved_filename){
		// code...

		$db = new Model();
		$_SESSION['error'] = "";
		$file_types = array("application/pdf");

		if(empty($FILES['upload']) || empty($FILES['upload']['name'])){
			$_SESSION['error'] = "Please select a file to upload.";
		}elseif (isset($FILES['upload'])){

			//upload file
			if ($FILES['upload']['name'] != "" && $FILES['upload']['error'] === 0 && in_array( $FILES['upload']['type'], $file_types)) {
				$folder = "scripts/";
				if (!file_exists($folder)) {
					mkdir($folder, 0777, true);
				}

				$FILES['upload']['name'] = $file_name;
				$destination = $folder.$saved_filename;
				if (preg_match("/([a-zA-Z0-9\s_.\-:])+(.pdf)$/i", $file_name)) {
					move_uploaded_file($FILES['upload']['tmp_name'], $destination);
				}else{
					$_SESSION['error'] = 'Invalid file name or name too long.';
				}

			}else{
				$_SESSION['error'] = "This file could not be uploaded";
			}
			

			if ($_SESSION['error'] == "") {
				//save to database
				$FILES['upload']['name'] = $file_name;
				$insert = $db->finish_exam($transaction_id, $upload_time, $FILES['upload']['name']);
				$_SESSION['msg'] = "File was uploaded successfully";
			}
		}
	}
}