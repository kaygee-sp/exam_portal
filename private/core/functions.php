<?php
	function display($a){
echo "<pre>";
	print_r($a);
			echo "</pre>";
	}
	function get_var($key, $default = ""){
		if (isset($_POST[$key])) {
			return $_POST[$key];
		}
		return $default;
	}
	function get_select($key, $value){
		if (isset($_POST[$key])) {
			if ($_POST[$key]  == $value){
				return "selected";
			}
		}
		return "";
	}
	function escape($var){
		return htmlspecialchars($var);
	}
	function get_random_string_max($length) {
		$array = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$text = "";
		$length = rand(4,$length);
		for($i=0;$i<$length;$i++) {
			$random = rand(0,51);
			$text .= $array[$random];
		}
		return $text;
	}
	function get_date($date, $format = ""){
		return date("j M Y ", strtotime($date));
	}
	function get_time($time){
		return date("H:i", strtotime($time));
	}
	function duration($time){
			return date("H:i", strtotime($time.'+2 hours'));
	}
	function display_date(){
		$now = date('l m F Y H:i:s');
		#$date = time();
		return $now;
	}
	function js_date($t){
		return date("M j Y", strtotime($t));
	}
	function generate_transactionID($student_no){
		#$first_4 = get_random_string_max(4);
		#$second_4 = substr($student_no, 0, 4);
		$random_no = rand(100, 999);
		$remainder = fmod($random_no, 7);
		#$transaction_ID = $first_4.$second_4."-".$random_no.$remainder;
		#$transaction_ID = get_random_string_max(4) . substr($student_no, 0, 4) . random_no . fmod($random_no, 7);
		return get_random_string_max(4) . substr($student_no, 0, 4) . $random_no . fmod($random_no, 7);
	}
	function rename_answer_for_saving($student_no, $modCode){
		$date = date('Y-m-j');
		$time = date('H:i:s');
		$name = $student_no. "_" .$modCode. "_EXAM_" .$date. ".pdf";
		return $name;
	}
	function rename_answerPDF($student_no, $modCode){
		#$date = date('Y-m-j');
		#$time = date('H:i:s');
		#$name = $student_no. "_" .$modCode. "_EXAM_" .$date. "_". $time .".pdf";
		#return $name;
		return $student_no. "_" . $modCode . "_EXAM_" . date('H:i:s') . "_" . date('Y-m-j') . ".pdf";
	}
	function time_remaining($y, $m, $d, $ExamDate){
		$result = "";
		$now = new DateTime();
		$date = new DateTime();
		$date->setDate($y, $m, $d);
		$ed = date('Y', strtotime($ExamDate));

		$current_year = $now->format('Y');
		$current_month =$now->format('m');
		$current_day =$now->format('j');
		$current_hour =$now->format('H');
		$current_min =$now->format('i');
		$current_time = date('H:i');

		$exam_year = date('Y', strtotime($ExamDate));
		$exam_month = date('m', strtotime($ExamDate));
		$exam_day = date('j', strtotime($ExamDate));
		$exam_hour = date('H', strtotime($ExamDate));
		$exam_min = date('i', strtotime($ExamDate));
		$exam_time = date('H:i', strtotime($ExamDate. '+2 hours'));


		if ($now->format('Y') > date('Y', strtotime($ExamDate))) {
			$result = "Exam date has passed";
		}

		if ($current_month === $exam_month) {
			if($current_day === $exam_day){
				if($current_time >= $exam_time){
					$result = "00";
				}

			}elseif($exam_day < $current_day){
				$result = "Exam is still coming";
			}elseif($exam_day > $exam_day){
				$result = "It has passed";
			}
		}else{
			$result = "Exam is not today";
		}

		if ($now->format('m') <= date('m', strtotime($ExamDate))) {
		}

		return $result ;
	}
	
	function views_path($view){
		
		if (file_exists("../private/views/" .$view. ".inc.php")){
			return ("../private/views/" .$view. ".inc.php");
		}else{
			return ("../private/views/404.view.php");
		}
	}