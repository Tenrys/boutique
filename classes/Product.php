<?php

class Product extends ShopItem {
	protected static string $table = "products";

	protected string $name;
	protected string $description;
	protected string $imagePath;
	protected int $price;
	protected int $quantity;
	protected SubCategory $subcategory;
	use DateProperty;

	protected static Array $sqlMap = [
		"imagePath" => "img",
		"subcategory" => "id_subcategory"
	];

	function __construct(Array $info = []) {
		parent::__construct($info);

		$this->setName($info["name"] ?? "");
		$this->setDescription($info["description"] ?? "");
		$this->setImagePath($info["img"] ?? "");
		$this->setPrice($info["price"] ?? 0);
		$this->setQuantity($info["quantity"] ?? 1);
		$this->setSubcategory($info["id_subcategory"] ?? null);
		$this->setDate($info["date"] ?? new DateTime());
	}

	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }
	public function getImagePath() { return $this->imagePath; }
	public function getPrice() { return $this->price; }
	public function getQuantity() { return $this->quantity; }
	public function getSubcategory() { return $this->subcategory; }

	public function setName(string $name) { $this->name = $name; }
	public function setDescription(string $description) { $this->description = $description; }
	public function setImagePath(string $imagePath) { $this->imagePath = $imagePath; }
	public function setPrice(int $price) { $this->price = $price; }
	public function setQuantity(int $quantity) { $this->quantity = $quantity; }
	public function setSubcategory($subcategory) { $this->subcategory = SubCategory::Get($subcategory); }
}
