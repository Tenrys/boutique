<?php

class Comment extends ShopItem {
	protected static string $table = "comments";

	protected User $user;
	protected Product $product;
	protected string $message;
	protected int $rating;
	use DateProperty;

	protected static Array $sqlMap = [
		"product" => "id_product",
		"user" => "id_user"
	];

	function __construct(Array $info = []) {
		parent::__construct($info);

		$this->setUser($info["id_user"] ?? null);
		$this->setProduct($info["id_product"] ?? null);
		$this->setMessage($info["message"] ?? "");
		$this->setRating($info["rating"] ?? 0);
		$this->setDate($info["date"] ?? new DateTime());
	}

	public function getUser() { return $this->user; }
	public function getProduct() { return $this->product; }
	public function getMessage() { return $this->message; }
	public function getRating() { return $this->rating; }

	public function setUser($user) { $this->user = User::Get($user); }
	public function setProduct($product) { $this->product = Product::Get($product); }
	public function setMessage(string $message) { $this->message = $message; }
	public function setRating(int $rating) { $this->rating = $rating; }
}
