<?php 

	/**
	 * 	Record getter from database
	 * 	
	 */
	
	//includes
	include 'connection.php';

	Class Record extends Connection {

		public $conn;

		public function __construct() {
			//connect on database
			$this->conn = $this->connect_db('northstar-apps');
		}


	}
?>