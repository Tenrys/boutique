<?php

class Product {
	private string $name;
	private string $description;
	private string $imagePath;
	private int $price;
	private int $quantity;
	private int $subcategory;

	function __construct(Array $info) {
		$this->setName($info["name"]);
		$this->setDescription($info["description"]);
		$this->setImagePath($info["img"]);
		$this->setPrice($info["price"]);
		$this->setQuantity($info["quantity"]);
		$this->setSubcategory($info["id_subcategory"]);
	}

	public function setName(string $name) {
		$this->name = $name;
	}
	public function setDescription(string $description) {
		$this->description = $description;
	}
	public function setImagePath(string $imagePath) {
		$this->imagePath = $imagePath;
	}
	public function setPrice(int $price) {
		$this->price = $price;
	}
	public function setQuantity(int $quantity) {
		$this->quantity = $quantity;
	}
	public function setSubcategory(int $id) {
		trigger_error("Product->setSubcategory is not yet implemented", E_USER_WARNING);
	}
}
