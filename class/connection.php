<?php

/**
 * 	Database connections on Noble using ODBC DNS
 * 	
 */


Class Connection {

	/**
	 * create connection link
	 * @param  string $dns 
	 * @return odbc link
	 */
	public function connect_db($dns) {
		$connect = odbc_connect($dns,'','');

		return $connect;
	}

	/**
	 * close current connection
	 * @return bool
	 */
	public function close_db() {
		odbc_close();

		return TRUE;
	}

}

?>