<?php

/**
 * Student Model
 */
class Students extends Model{
	
	protected $table = "studentinfo";
	#protected $before_insert = ['make_user_id', 'make_school_id', 'hash_password'];
	#protected $allowed_columns = ['firstname', 'lastname', 'email', 'rank', 'gender', 'password', 'date'];

	public function validate($data){

		$this->errors = array();

		//check for student number validity
		if (empty($data['student_number']) || !is_numeric($data['student_number'])) {
			// code...
			$this->errors['student_number'] = "Contact number is not valid.";
		}

		//check for empty password fields
		if (empty($data['password'])) {
			$this->errors['password'] = "Please enter a password.";
		}

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