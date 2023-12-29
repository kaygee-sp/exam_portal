<?php

/**
 * 
 */
class Download_file extends Model{
	
	function download_question_paper($POST){

		$_SESSION['error'] = "";
		$file_types = array("application/pdf");

		if (isset($POST['download'])) {
			$file = urldecode($_REQUEST["code"]);

			$path = "uploads/";
			if (!file_exists($path)) {
				mkdir($path, 0777, true);
			}

			#isset($POST['code']) && $_SESSION['error'] === ""
			$full_path = $path.basename($_REQUEST['code']);
			if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
				
				if (file_exists($full_path)) {
					$size = filesize($full_path);
					$path_parts = pathinfo($full_path);
					$ext = strtolower($path_parts["extension"]);

					
					#display($path_parts['basename']);
					/*display($size);
					display($ext);
					display($POST);*/

					ob_clean();
					header("Pragma: public");
					header("Expires: 0");
					header("Content-Description: File Transfer");
					header("Content-Type: application/octet-stream");
					header("Cache-Control: must-revalidate");
					header("Content-Transfer-Encoding: binary");
					header("Content-Disposition: attachment; filename=".$path_parts['basename']);
					header("Content-Length: ".$size);
					#header("Cache-Control: public");
					flush();
					readfile($full_path);
					die();
				}
				
			}else{
				die("Invalid request");
			}
		}

		/*if (isset($FILES['upload'])){

			//upload file
			if ($FILES['upload']['name'] != "" && $FILES['upload']['error'] === 0 && in_array( $FILES['upload']['type'], $file_types)) {
				$folder = "downloads/";
				if (!file_exists($folder)) {
					mkdir($folder, 0777, true);
				}

				$destination = $folder.$FILES['upload']['name'];
				move_uploaded_file($FILES['upload']['tmp_name'], $destination);
			}else{
				$_SESSION['error'] = "This file could not be uploaded";
			}
			

			if ($_SESSION['error'] == "") {
				//save to database

				$insert = $db->upload_question_paper($ModuleCode, $file_name);

				/*if ($data){
					header("location:". ROOT. "home");
					die;
				}
			}
		}*/
	
	}
}