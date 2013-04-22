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
			//$this->conn = $this->connect_db('singtel_helix', );
			$this->conn = odbc_connect("Driver={SQL Server};Server=HELIX;Database=NSI_SINGTEL_FLIPSWITCH_A1", "sa", "1nfin1ty");
		}

	}
?>