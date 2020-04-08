<?php

class Category extends Item {
	protected static string $table = "categories";

	protected int $id;
	protected string $name;
	protected string $description;

	const SQLMap = [];

	function __construct(Array $info = []) {
		$this->setId($info["id"] ?? null);
		$this->setName($info["name"] ?? "");
		$this->setDescription($info["description"] ?? "");
	}

	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }

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
}
