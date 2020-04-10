<?php

// Example MySQL object class deriving ShopItem, DO NOT USE, only copy from.

class WishList extends ShopItem {
	protected static string $table = "wishlist";

	protected User $user;
	protected Product $product;

	protected static Array $sqlMap = [
		"user" => "id_user",
		"product" => "id_product"
	];

	function __construct(Array $data = []) {
		parent::__construct($data);

		$this->setUser($data["id_user"] ?? null);
		$this->setProduct($data["id_product"] ?? null);
	}

	public function getUser() { return $this->user; }
	public function getProduct() { return $this->product; }

	public function setUser($user) { $this->user = User::Get($user); }
	public function setProduct($product) { $this->product = Product::Get($product); }
}

