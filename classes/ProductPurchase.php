<?php

class ProductPurchase extends ShopItem {
	protected static string $table = "purchases_products";

	protected Purchase $purchase;
	protected Product $product;
	protected int $quantity;

	protected static Array $sqlMap = [
		"purchase" => "id_purchase",
		"product" => "id_product"
	];

	function __construct(Array $data = []) {
		parent::__construct($data);

		$this->setPurchase($data["id_user"] ?? null);
		$this->setProduct($data["id_product"] ?? null);
		$this->setQuantity($data["quantity"] ?? 0);
	}

	public function getPurchase() { return $this->purchase; }
	public function getProduct() { return $this->product; }
	public function getQuantity() { return $this->quantity; }

	public function setPurchase($purchase) { $this->purchase = Purchase::Get($purchase); }
	public function setProduct($product) { $this->product = Product::Get($product); }
	public function setQuantity(int $quantity) { $this->quantity = $quantity; }
}
