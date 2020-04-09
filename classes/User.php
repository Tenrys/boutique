<?php

class User extends ShopItem {
	protected static string $table = "users";

	protected string $firstName;
	protected string $lastName;
	protected string $email;
	protected string $password;
	protected int $rank;

	protected static Array $sqlMap = [
		"firstName" => "firstname",
		"lastName" => "lastname"
	];

	function __construct(Array $info = []) {
		parent::__construct($info);

		$this->setFirstName($info["firstname"] ?? "");
		$this->setLastName($info["lastname"] ?? "");
		$this->setEmail($info["email"] ?? "");
		$this->setPassword($info["password"] ?? "", false);
		$this->setRank($info["rank"] ?? "");
	}

	public function getFirstName() { return $this->firstName; }
	public function getLastName() { return $this->lastName; }
	public function getEmail() { return $this->email; }
	public function getPassword() { return $this->password; }
	public function getRank() { return $this->rank; }

	public function setFirstName(string $firstName) { $this->firstName = $firstName; }
	public function setLastName(string $lastName) { $this->lastName = $lastName; }
	public function setEmail(string $email) { $this->email = $email; }
	public function setPassword(string $password, bool $hash = false) {
		if ($hash) {
			$password = password_hash($password, PASSWORD_BCRYPT);
		}
		$this->password = $password;
	}
	public function setRank(int $rank) { $this->rank = $rank; }
}
