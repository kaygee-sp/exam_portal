<?php
/**
*
*/
class Student extends Controller{
	function index(){
		if (!Auth::check_logged_in()) {
			$this->redirect('staff_login');
		}
		$_SESSION['page_title'] = "Student Home";
		$errors = array();
		$student = new Students();
		$data = $student->get_student_details($_SESSION['USER']->StudentNumber);
		$this->view("students",[
			"errors"=>$errors,
			"data"=>$data
		]);
	}
	
	function download(){
		if (!Auth::check_logged_in()) {
			$this->redirect('staff_login');
		}
		$_SESSION['page_title'] = "Exam Room";
		$errors = array();
		date_default_timezone_set('Africa/Cairo');
		$student = new Students();
		$sub = "";
		$msg = "";
		$time = filter_input(INPUT_POST, "time_remaining");

		if (isset($_GET['mod']) ) {
			$modulecode = $_GET['mod'];
			$exam = $student->exam_details($modulecode);
			$exam_output = $student->get_examoutput($_SESSION['USER']->StudentNumber, $modulecode);
			$d = $student->get_staff_name_and_email($_SESSION['USER']->StudentNumber, $modulecode);
		}
		//DOWNLOAD QUESTION PAPER
		if (isset($_POST['download'])) {
			#if (isset($_GET['mod'])) {
				$download = new Download_file();
				$start_time = date('Y-m-j H:i:s');
				$modulecode = $_GET['mod'];
				$student_no = $_SESSION['USER']->StudentNumber;
				$id = generate_transactionID($_SESSION['USER']->StudentNumber);
				//check first if whether the student has already submitted and get the transactionID
				//if not, create a new session
				$a = $student->get_tid($_SESSION['USER']->StudentNumber, $modulecode);
				if (!empty($a)) {
					$id = $a[0]->TransactionID;
					$student->update_examinfo($id, $start_time);
					$download->download_question_paper($_POST);
				}else{
					$download->start_exam($id, $start_time, $student_no, $modulecode);
					$download->download_question_paper($_POST);
				}
			#}
		}
		//UPLOAD ANSWER PAPER
		if (isset($_POST["upload"]) && !empty($_FILES['upload'])) {
			$upload_paper = new Upload_file();
			$a = $student->get_tid($_SESSION['USER']->StudentNumber, $modulecode);
			$upload_time = date('Y-m-j H:i:s');
			$filename_for_database = rename_answerPDF($_SESSION['USER']->StudentNumber, $modulecode);
			$filename_for_upload = rename_answer_for_saving($_SESSION['USER']->StudentNumber, $modulecode);
			$insert_answer = $upload_paper->upload_answer($_FILES, $id = $a[0]->TransactionID, $upload_time, $filename_for_database, $filename_for_upload);
			$sub = "File submission success";

			//code for sending an email
			$mail = new PHPMailer(true);
			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'kayg69639@gmail.com';
				$mail->Password = 'ctdtmkqjhrutidki';
				$mail->SMTPSecure = 'ssl';
				$mail->Port = 465;
				$mail->setFrom('no-reply@examinfo.ac.za', 'exam@department.ac.za', 0);
				$mail->addAddress('10825592@mylife.unisa.ac.za'/*$_SESSION['USER']->StudentEmail*/);
				$mail->isHTML(true);
				$mail->Subject = 'Exam File Submission';
				$mail->Body = "This is to confirm your file was submitted successfully.
				\n\n Reference number: ".$exam_output[0]->TransactionID.
				"\n Upload Time: ".$exam_output[0]->UploadTime.
				"\n Filename: ".$exam_output[0]->AnswerPaperPDF.
				"\n\n Please keep this email as proof of submission.";
				$mail->AltBody = 'Plain text for non-html clients';
				$mail->send();
				$msg  = 'Confirmation email was sent successfully with the reference number.';
					
			} catch (Exception $e) {
				$msg = "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
			}
		}
		
		$this->view("students.upload",[
			"errors"=>$errors,
			"exam"=>$exam,
			"output"=>$exam_output,
			"sub"=>$sub,
			"staff_details"=>$d,
			"msg"=>$msg,
			"time"=>$time
		]);
	}
	
}