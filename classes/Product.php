<?php

class Product extends ShopItem {
	protected static Array $cache = [];
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

	function __construct(Array $data = []) {
		parent::__construct($data);

		$this->setName($data["name"] ?? "");
		$this->setDescription($data["description"] ?? "");
		$this->setImagePath($data["img"] ?? "");
		$this->setPrice($data["price"] ?? 0);
		$this->setQuantity($data["quantity"] ?? 1);
		$this->setSubcategory($data["id_subcategory"] ?? null);
		$this->setDate($data["date"] ?? new DateTime());
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

	public function getRating() {
		$ratings = array_map(fn($comment) => $comment->getRating(), Comment::Find(["id_product" => $this->getId()]));
		$total = count($ratings);
		return $total == 0 ? 0 : array_sum($ratings) / $total;
	}
}
