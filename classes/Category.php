<?php

class Category extends ShopItem {
	protected static string $table = "categories";

	protected string $name;
	protected string $description;

	function __construct(Array $info = []) {
		parent::__construct($info);

		$this->setName($info["name"] ?? "");
		$this->setDescription($info["description"] ?? "");
	}

	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }

	public function setName(string $name) { $this->name = $name; }
	public function setDescription(string $description) { $this->description = $description; }
}
