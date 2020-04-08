<?php

class Product extends Item {
	protected static string $table = "products";

	protected int $id;
	protected string $name;
	protected string $description;
	protected string $imagePath;
	protected int $price;
	protected int $quantity;
	protected int $subcategory;
	protected DateTime $date;

	const SQLMap = [
		"imagePath" => "img",
		"subcategory" => "id_subcategory"
	];

	function __construct(Array $info = []) {
		$this->setId($info["id"] ?? null);
		$this->setName($info["name"] ?? "");
		$this->setDescription($info["description"] ?? "");
		$this->setImagePath($info["img"] ?? "");
		$this->setPrice($info["price"] ?? 0);
		$this->setQuantity($info["quantity"] ?? 1);
		$this->setSubcategory($info["id_subcategory"] ?? null);
		$this->setDate($info["date"] ?? new DateTime());
	}

	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }
	public function getImagePath() { return $this->imagePath; }
	public function getPrice() { return $this->price; }
	public function getQuantity() { return $this->quantity; }
	public function getSubcategory() { return $this->subcategory; }
	public function getDate() { return $this->date; }

	public function forSQL() {
		$arr = parent::forSQL();

		$arr["id_subcategory"] = $arr["id_subcategory"];
		$arr["date"] = mysql_timestamp($arr["date"]->getTimestamp());

		return $arr;
	}

	public function setId($id = null) {
		if ($id) {
			if (!is_numeric($id)) {
				$id = (int)$id;
			}
			$this->id = $id;
		}
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
		$this->subcategory = $id;
		// trigger_error(__METHOD__ . " is not yet implemented", E_USER_WARNING);
	}
	public function setDate($date) {
		if (is_string($date)) {
			$date = new DateTime($date);
		}
		if (!$date instanceof DateTime) {
			return trigger_error(__METHOD__ . " requires either a valid DateTime string or a DateTime object", E_USER_ERROR);
		}
		$this->date = $date;
	}
}
