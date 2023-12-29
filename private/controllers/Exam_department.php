<?php

/**
 * 
 */
class Exam_department extends Controller{
	
	function index(){

		if (!Auth::check_logged_in()) {
			$this->redirect('staff_login');
		}

		$_SESSION['page_title'] = "Exam Department Home";
		$staff = new Staff();
		$get_exam_date = filter_input(INPUT_POST, 'exam_dates');
		$date = strtotime($get_exam_date);
		$new_format = date('Y-m-d', $date);
		$weekly_mis = filter_input(INPUT_POST, 'weekly_mis');

		$now = date('Y-m-d');

		//returns the dates of the exams
		$exam_dates = $staff->get_exam_dates();
		
		//if date is selected, display the modules for that day along with the module leader contact details
		if(!isset($get_exam_date)){			
			$data = $staff->daily_MIS($now);
			#$mis_1 = $staff->MIS_1($now);
		}else{
			$data = $staff->daily_MIS($new_format);
			#$mis_1 = $staff->MIS_1($new_format);
		}

		//search for module leaders by module code
			if(isset($_POST['search'])){
				$name = "%".trim($_POST['name'])."%";
				$mis_1 = $staff->MIS_1($name);
			}elseif(isset($_POST['search']) || $get_exam_date === ""){
				$mis_1 = $staff->MIS_1("");
			}elseif(isset($get_exam_date)){
				$mis_1 = $staff->MIS_1($data[0]->ModuleCode);
			}else{
				$mis_1 = "";
			}

		//returns the data of the weekly MIS report
		if(!isset($weekly_mis)){			
			$weekly_mis = $staff->weekly_MIS($now);
		}else{
			$weekly_mis = $staff->weekly_MIS($weekly_mis);
		}

		/***********************************************MIS 1 graph********************************************/
		$g = new dashboardbuilder();

		$g->type[0]=  "line";
		$g->legacy = "";
		$g->source =  "Database"; 
		$g->rdbms =  "mysql"; 
		$g->servername =  "127.0.0.1";
		$g->username =  "root";
		$g->password =  "";
		$g->dbname =  "ict3715_online_exam_submission";
		$g->toImage = "Download graph";
		$g->zoomin = "Zoom in";
		$g->zoomout = "Zoom out";
		$g->autoscale = "Reset";
		$g->filterlabel = "Filter";
		$g->forecastlabel = "Forecast";
		$g->filter = "false";
		$g->xaxisSQL[0]=  "select count(distinct studentnumber), modulecode from studentmodule group by modulecode order by count(studentnumber) asc";
		$g->xaxisCol[0]=  "modulecode";
		$g->xsort[0]=  "";
		$g->xmodel[0]=  "";
		$g->forecast[0]=  "";
		$g->yaxisSQL[0]=  "select count(distinct studentnumber), modulecode from studentmodule group by modulecode order by count(studentnumber) asc";
		$g->yaxisCol[0]=  "count(distinct studentnumber)";
		$g->ysort[0]=  "";
		$g->ymodel[0]=  "";
		$g->name = "0";
		$g->title = "Number of Student Writing Exams for Each Module";
		$g->orientation = "v";
		$g->dropdown = "false";
		$g->side = "left";
		$g->toImage = "Download graph";
		$g->zoomin = "Zoom in";
		$g->zoomout = "Zoom out";
		$g->autoscale = "Reset";
		$g->filter = "false";
		$g->forecastlabel = "Forecast";
		$g->legposition = "";
		$g->xaxistitle = "Module Code";
		$g->yaxistitle = "Number of Students";
		$g->datalabel = "false";
		$g->showgrid = "false";
		$g->showline = "true";
		$g->tablefontsize = "9";
		$g->height = "380";
		$g->width = "0";
		$g->col = "0";
		$g->plot = "dynamic";
		$g->tracename[0]=  "Trace 1";
		$result[0] = $g->result();
		
		$this->view("exam_department",[
			"data"=>$data,
			"exam_dates"=>$exam_dates,
			"weekly_mis"=>$weekly_mis,
			"mis_1"=>$mis_1,
			"graph"=>$result[0]
			
		]);
	}

	function set_date(){
		if (!Auth::check_logged_in()) {
			$this->redirect('staff_login');
		}

		$_SESSION['page_title'] = "Set Exam Date";
		$errors = array();
		$staff = new Staff();

		$mod = $staff->get_ModuleCodes();

		if (count($_POST) > 0) {
			if (empty($_POST['DateExam']) || empty($_POST['Examtime']) || empty($_POST['modulecode'])) {
				$errors = "Please make sure all fields are completely filled";
			}else{
				$staff->set_exam_date($_POST['modulecode'], $_POST);
				$this->redirect('exam_department');
			}
		}

		$this->view("exam_department.add",[
			"errors"=>$errors,
			"modules"=>$mod,
		]);
	}

	function upload_question_paper(){
		if (!Auth::check_logged_in()) {
			$this->redirect('staff_login');
		}

		$_SESSION['page_title'] = "Upload Question Paper";
		$errors = array();
		$staff = new Staff();

		$mod = $staff->get_ModuleCodes();

		if (isset($_POST['upload_file'])) {
			$file_name = $_POST['modulecode'].".pdf";

			if (empty($_POST['modulecode']) || empty($_FILES['upload'])) {
				$errors = "Please make sure all fields are completely filled.";
			}else{
				$u = new Upload_file();
				$a = $u->upload($_POST, $_FILES, $_POST['modulecode'], $file_name, 'exam_department');
			}
		}

		$this->view("exam_department.upload",[
			"modules"=>$mod,
			"errors"=>$errors
		]);
	}

}