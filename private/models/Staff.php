<?php

/**
 * Staff Model
 */
class Staff extends Model{
	
	protected $table = "staffinfo";
	#protected $before_insert = ['rename_question_paper'];
	protected $allowed_columns = ['modulecode','DateExam', 'Examtime'];

	public function validate($data){

		$this->errors = array();

		#ensure the date text field is not empty
		if (empty($data['DateExam'])) {
			$this->errors['DateExam'] = "Please enter date exam.";
		}

		#ensure the time text field is not empty
		if (empty($data['Examtime'])) {
			$this->errors['Examtime'] = "Please select the exam time..";
		}

		#check for empty modules selected
		 /*if (empty($data['modulecode'])){
		 	$this->errors['modulecode'] = "Please enter a module.";
		 }*/

		
		if (count($this->errors) == 0) {
			return true;
		}
		return false;
	}

	public function hash_password($data){
		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		return $data;
	}
	
}