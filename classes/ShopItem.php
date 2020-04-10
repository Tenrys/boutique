<?php

class ShopItem extends Item {
	protected ?int $id = null;

	public static function Get($data) {
		$shopItem;
		if ($data instanceof static) {
			$shopItem = $data;
		} elseif (is_numeric($data)) {
			$shopItem = parent::Get(["id" => $data]);
		} elseif (is_array($data)) {
			$shopItem = parent::Get($data);
		}
		if (!isset($shopItem)) {
			$class = get_called_class();
			throw new InvalidArgumentException(__METHOD__ . " requires either a $class, a $class ID or an Array of information to look up");
		}
		return $shopItem;
	}

	public function __construct(Array $data) {
		$this->setId($data["id"] ?? null);
	}

	public function getId() { return $this->id; }
	public function setId($id = null) {
		if ($id) {
			if (!is_numeric($id)) {
				$id = (int)$id;
			}
			$this->id = $id;
		}
	}
	public function inDatabase() {
		return (bool)static::Get(["id" => $this->getId()]);
	}
	public function getDatabaseId() {
		return $this->getId();
	}

}