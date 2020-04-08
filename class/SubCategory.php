<?php

class SubCategory extends Item {
	protected static string $table = "subcategories";

	protected int $id;
	protected string $name;
	protected string $description;
	protected int $category;

	const SQLMap = [
		"category" => "id_category"
	];

	function __construct(Array $info = []) {
		$this->setId($info["id"] ?? null);
		$this->setName($info["name"] ?? "");
		$this->setDescription($info["description"] ?? "");
		$this->setCategory($info["id_category"] ?? null);
	}

	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }
	public function getCategory() { return $this->category; }

	public function forSQL() {
		$arr = parent::forSQL();

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
	public function setCategory(int $id) {
		$this->category = $id;
		// trigger_error(__METHOD__ . " is not yet implemented", E_USER_WARNING);
	}
}
