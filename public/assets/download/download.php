<?php

		/*$path = 'download/';
		$full_path = $path.basename($_REQUEST['file']);

		if (isset($_POST['download'])) {
			if (is_readable($full_path)) {
				$size = filesize($full_path);
				$path_parts = pathinfo($full_path);
				$ext = strtolower($path_parts["extension"]);

				display($size);
				display($path_parts);
				display($ext);

				switch ($ext) {
					case 'pdf':
						header("Content-Type: application/pdf");
						header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
						break;
					
					default:
					header("Content-Type: application/octet-stream");
						header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
						break;
				}
				header("Content-Length: $size");
				header("Cache-Control: private");
				readfile("$full_path");
				exit;
			}else{
				die("Invalid request");
			}	
		}*/

if(isset($_REQUEST["code"])){
    // Get parameters
    
    $file = basename($_GET["code"]); // Decode URL-encoded string
    $path = getcwd();

    /* Check if the file name includes illegal characters
    like "../" using the regular expression */
    if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
        $filepath = "../uploads/" . $file;
        #print_r($filepath);
        // Process download
        if(!file_exists($filepath)) {
        	#header("Cache-Control: public");
            #header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file");
            #header("Content-Type: application/pdf");
            #header("Content-Transfer-Encoding: binary");
            #header('Expires: 0');
            #header('Cache-Control: must-revalidate');
            
            $fb = fopen($file, "r");
            while (!feof($fb)) {
            	// code...
            	echo fread($fb, 8192);
            	flush();
            }
            fclose($fb);
            #header('Pragma: public');
            #ob_clean();
            #flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
	        die();
        }
    } else {
        die("Invalid file name!");
    }

     #href="<?=ASSETS;##?#>download/download.php?code=<?=$row->ExamPaperPDF;?#>" 
}
