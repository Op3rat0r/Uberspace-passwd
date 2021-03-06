<?php

/**
 * Class Vuser
 *
 * handles user authentication and password changing
 */
class Vuser {
	private $passwordHash;
	private $companyID;
	private $isValidUser;

	/**
	 * Constructor
	 *
	 * @param $companyID
	 */
	public function __construct($companyID) {
		$this->companyID     = $companyID;
		$this->isValidUser = $this->getUserInfo();
	}

	/**
	 * scrape Vuser info from shell command "dumpvuser"
	 *
	 * @return bool
	 */
	private function getUserInfo() {
		$info = shell_exec("dumpvuser " . escapeshellarg($this->companyID));
		$info = explode("\n", $info);
		if ($info == "")
			return false;
		$passwordHash       = explode(": ", $info[1]);
		$this->passwordHash = $passwordHash[1];

		return true;
	}

	/**
	 * check if submitted password equals existing password, scraped vom "dumpvuser"
	 *
	 * @param $password
	 *
	 * @return bool
	 */
	public function validPassword($password) {
		if ($this->passwordHash == crypt($password, $this->passwordHash))
			return true;

		return false;
	}

	/**
	 * getter for attribute $isValidUser
	 *
	 * @return bool
	 */
	public function validUser() {
		return $this->isValidUser;
	}

	/**
	 * Set Vusers password to the new password
	 *
	 * @param $password
	 *
	 * @return string
	 */
	public function setPassword($password) {
		shell_exec("echo -e " . escapeshellarg($password . "\n" . $password) . " | vpasswd " . escapeshellarg($this->companyID));

		return "1";
	}
}
