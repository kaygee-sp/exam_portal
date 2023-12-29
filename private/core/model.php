<?php

/**
 * 
 */
class Model extends Db{
	
	public $errors = array();
	
	function __construct(){
		//var_dump(property_exists($this, "table"));
		if (!property_exists($this, "table")) {
			$this->table = strtolower(this::class)."s";
		}
	}

	public function staff_login($column, $value){

		$column = addslashes($column);
		$query = "select * from $this->table where $column = :value";
		$data = $this->query($query,[
			'value'=>$value
		]);

		//run functions after select
		/*if(is_array($data)){
			if (property_exists($this, "afterSelect")) {
				foreach ($this->afterSelect as $func) {
					$data = $this->$func($data);
				}
			}
		}*/

		return $data;
	}

	function get_exam_dates(){

		$query = "SELECT DateExam 
				  FROM ExamSetup
			      GROUP BY dateExam";

		$data = $this->query($query);

		return $data;
	}

	function daily_MIS($date){

		$column = 'DateExam';
		$query = "SELECT *
				  from ExamSetup
				  where $column = '$date' ";

		$data = $this->query($query);

		return $data;
	}

	function MIS_1($mc){

		$column = 'e.ModuleCode';
		$query = "SELECT e.ModuleCode, e.DateExam, s.StaffName, s.StaffEmail
				  from ExamSetup AS e
				  JOIN ModuleLeader as m
				  ON e.ModuleCode = m.ModuleCode
				  JOIN StaffInfo as s
				  ON m.StaffNumber = s.StaffNumber
				  where $column LIKE '$mc' LIMIT 5";

		$data = $this->query($query);

		return $data;
	}

	function weekly_MIS($date){

		$column = 'UploadTime';
		$query = "SELECT COUNT(e.AnswerPaperPDF) as 'count', ModuleCode,
				  '$date' - INTERVAL (WEEKDAY('$date') + 1) DAY as 'first_day', '$date' as 'today', 
				  '$date' - INTERVAL (WEEKDAY('$date') - 5) DAY as 'last_day'
				  from ExamOutput e
				  WHERE UploadTime >= '$date' - INTERVAL (WEEKDAY('$date') + 1) DAY AND UploadTime <= '$date'
				  group by ModuleCode";

		$data = $this->query($query);

		return $data;
	}

	function get_ModuleCodes(){
		$query = "SELECT ModuleCode 
				  FROM ModuleInfo";

		$data = $this->query($query);

		return $data;
	}

	public function set_exam_date($id,$data){

		//remove unwanted columns
		if (property_exists($this, "allowed_columns")) {
			foreach ($data as $key => $column) {
				if (!in_array($key, $this->allowed_columns)) {
					unset($data[$key]);
				}
			}
		}

		$str = "";
		
		foreach ($data as $key => $value) {
			$str .= $key. "=:".$key.",";
		}

		$str = trim($str, ',');
		#$id = $data['modulecode'];
		$query = "UPDATE ExamSetup SET $str WHERE modulecode = '$id' ";
		return $this->query($query,$data);
	}

	function get_staffNumber_and_moduleCode($staff_number){

		$column = 's.StaffNumber';
		$query = "SELECT e.ModuleCode, e.DateExam, s.StaffName, s.StaffNumber, e.ExamPaperPDF, e.ExamTime
				  from ExamSetup AS e
				  JOIN ModuleLeader as m
				  ON e.ModuleCode = m.ModuleCode
				  JOIN StaffInfo as s
				  ON m.StaffNumber = s.StaffNumber
				  where $column = '$staff_number' ";

		$data = $this->query($query);

		return $data;
	}

	function upload_question_paper($modulecode, $q_paper){

		$query = "UPDATE ExamSetup SET ExamPaperPDF = '$q_paper'
					WHERE ModuleCode = '$modulecode' ";
		$data = $this->query($query);
		return $data;
	}

	/*******************************************STUDENT*****************************************************/
	function student_login($column, $value){

		$column = addslashes($column);
		$query = "select * from $this->table where $column = :value";
		$data = $this->query($query,[
			'value'=>$value
		]);

		return $data;
	}

	function get_student_details($value){

		$query = "SELECT sm.ModuleCode, es.DateExam, es.ExamTime, si.StaffName, si.StaffEmail
					FROM studentinfo as s
					JOIN studentmodule as sm
					ON s.StudentNumber =sm.StudentNumber
					JOIN moduleinfo as mi
					ON sm.ModuleCode = mi.ModuleCode
					JOIN examsetup as es
					on mi.ModuleCode = es.ModuleCode
					JOIN moduleleader as ml
					ON es.ModuleCode = ml.ModuleCode
					JOIN staffinfo as si
					ON ml.StaffNumber = si.StaffNumber
					WHERE s.StudentNumber = '$value' ";

		$data = $this->query($query);
		return $data;
	}

	function get_staff_name_and_email($sn, $mc){

		$query = "SELECT sm.ModuleCode, es.DateExam, es.ExamTime, si.StaffName, si.StaffEmail,ml.StaffNumber
					FROM studentinfo as s
					JOIN studentmodule as sm
					ON s.StudentNumber =sm.StudentNumber
					JOIN moduleinfo as mi
					ON sm.ModuleCode = mi.ModuleCode
					JOIN examsetup as es
					on mi.ModuleCode = es.ModuleCode
					JOIN moduleleader as ml
					ON es.ModuleCode = ml.ModuleCode
					JOIN staffinfo as si
					ON ml.StaffNumber = si.StaffNumber
					WHERE s.StudentNumber = '$sn'  AND es.ModuleCode = '$mc' ";

		$data = $this->query($query);
		return $data;
	}

	function exam_details($value){

		$query = "SELECT ModuleCode, ExamTime, ExamPaperPDF, DateExam
				  FROM examsetup as e
				  WHERE ModuleCode = '$value'";
		$data = $this->query($query);
		return $data;
	}

	function get_examoutput($sn, $mc){
		$query = "SELECT * FROM ExamOutput
				WHERE StudentNumber = '$sn' AND ModuleCode = '$mc' ";
		$data = $this->query($query);
		return $data;
	}


	function start_exam($t_id, $st, $sn, $mc){

		$query = "INSERT INTO ExamOutput(TransactionID, StartTime, StudentNumber, ModuleCode)
					VALUES('$t_id', '$st', '$sn', '$mc')";
					display($query);
		$data = $this->query($query);
		return $data;
	}

	function update_examinfo($t_id, $st){

		$query = "UPDATE ExamOutput
				SET StartTime = '$st'
					WHERE TransactionID ='$t_id' ";
		$data = $this->query($query);
		return $data;
	}

	function get_tid($sn, $mc){
		$query = "SELECT * FROM ExamOutput 
				WHERE StudentNumber = '$sn' AND ModuleCode = '$mc'";
		$data = $this->query($query);
		return $data;
	}

	function finish_exam($t_id, $ut, $answer){

		$query = "UPDATE ExamOutput 
				  SET UploadTime = '$ut', AnswerPaperPDF = '$answer'
				  WHERE TransactionID = '$t_id' ";
		$data = $this->query($query);
		return $data;
	}

/******************************************** *************************************************************/
}