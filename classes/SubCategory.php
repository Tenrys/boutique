<?php

class SubCategory extends ShopItem {
	protected static string $table = "subcategories";

	protected string $name;
	protected string $description;
	protected Category $category;

	protected static Array $sqlMap = [
		"category" => "id_category",
	];

	function __construct(Array $data = []) {
		parent::__construct($data);

		$this->setName($data["name"] ?? "");
		$this->setDescription($data["description"] ?? "");
		$this->setCategory($data["id_category"] ?? null);
	}

	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }
	public function getCategory() { return $this->category; }

	public function setCategory($category) { $this->category = Category::Get($category); }
	public function setName(string $name) { $this->name = $name; }
	public function setDescription(string $description) { $this->description = $description; }
}
