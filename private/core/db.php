<?php
	
/**
 * Database connection
 */
class Db{
	
	private function connect(){
		// code...
		$str = DB_TYPE.":host=".DB_HOST."; dbname=".DB_NAME;

		if (!$con = new PDO($str, DB_USER,DB_PASSWORD)) {
			die("Failed to connect to the database.");
		}

		return $con;
	}

	public function query($query, $data = array(), $data_type = "object"){

		$con = $this->connect();
		$stmt = $con->prepare($query);

		if($stmt){
			$check = $stmt->execute($data);
			if($check){
				if($data_type == "object"){
					$data = $stmt->fetchAll(PDO::FETCH_OBJ);
				}else{
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}

				if(is_array($data) && count($data) > 0){
					return $data;
				}
				//return true;	
			}
		}
		return false;
	}

}