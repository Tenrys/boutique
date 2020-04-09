<?php

class Purchase extends ShopItem {
	protected static string $table = "purchases";

	protected int $id;
	protected User $user;
	protected Address $address;
	protected int $price;
	protected string $method;
	use DateProperty;

	protected static Array $sqlMap = [
		"user" => "id_user",
		"address" => "id_address"
	];

	function __construct(Array $info = []) {
		parent::__construct($info);

		$this->setUser($info["id_user"] ?? null);
		$this->setAddress($info["id_address"] ?? null);
		$this->setPrice($info["price"] ?? 0);
		$this->setDate($info["date"] ?? new DateTime());
		$this->setMethod($info["method"] ?? "");
	}

	public function getUser() { return $this->user; }
	public function getAddress() { return $this->address; }
	public function getPrice() { return $this->price; }
	public function getMethod() { return $this->method; }

	public function setUser($user) { $this->user = User::Get($user); }
	public function setAddress($address) { $this->address = Address::Get($address); }
	public function setPrice(int $price) { $this->price = $price; }
	public function setMethod(string $method) { $this->method = $method; }
}
