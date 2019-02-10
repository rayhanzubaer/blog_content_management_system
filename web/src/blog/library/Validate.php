<?php

class Validate {

	private $error = array();
	private $db;

	public function __construct() {
		$this->db = DB::getInstance();
	}

	public function check($params = array()) {
		foreach ($params as $value) {
			if (empty($value)) {
				$this->error[] = $value . ' is required.';
			}
		}

		return $this;
	}

	public function pass() {
		if (empty($this->error)) {
			return true;
		}
		return false;
	}

	public function error() {
		return $this->error;
	}

}

?>
