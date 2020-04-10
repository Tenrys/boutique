<?php

class Address extends ShopItem {
	protected static string $table = "addresses";

	protected User $user;
	protected string $name;
	protected string $address;
	protected int $zipCode;
	protected string $city;
	protected string $country;

	protected static Array $sqlMap = [
		"zipCode" => "zip_code",
		"user" => "id_user"
	];

	function __construct(Array $data = []) {
		parent::__construct($data);

		$this->setUser($data["id_user"] ?? null);
		$this->setName($data["name"] ?? "");
		$this->setAddress($data["address"] ?? "");
		$this->setZipCode($data["zip_code"] ?? 0);
		$this->setCity($data["city"] ?? "");
		$this->setCountry($data["country"] ?? "");
	}

	public function getUser() { return $this->user; }
	public function getName() { return $this->name; }
	public function getAddress() { return $this->address; }
	public function getZipCode() { return $this->zipCode; }
	public function getCity() { return $this->city; }
	public function getCountry() { return $this->country; }

	public function setUser($user) { $this->user = User::Get($user); }
	public function setName(string $name) { $this->name = $name; }
	public function setAddress(string $address) { $this->address = $address; }
	public function setZipCode(int $zipCode) { $this->zipCode = $zipCode; }
	public function setCity(string $city) { $this->city = $city; }
	public function setCountry(string $country) { $this->country = $country; }
}
