<?php

class DB {
	
	private static $instance = null;
	private $db;

	private function __construct() {
		$this->db = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if (mysqli_connect_error()) {
			die("Sorry, We are having some trouble");
		}
	}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new DB();
		}
		return self::$instance;
	}

	public function select($sql) {
		$result = $this->db->query($sql);

		if ($result->num_rows > 0) {
			return $result;
		}
		return false;
	}

	public function insert($sql) {
		$result = $this->db->query($sql);

		if ($result === true) {
			return $result;
		}
		return false;
	}

	public function update($sql) {
		$result = $this->db->query($sql);

		if ($result === true) {
			return $result;
		}
		return false;
	}

	public function delete($sql) {
		$result = $this->db->query($sql);

		if ($this->db->affected_rows > 0) {
			return $result;
		}
		return false;
	}
}

?>