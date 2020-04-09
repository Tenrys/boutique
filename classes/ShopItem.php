<?php

class ShopItem extends Item {
	protected int $id;

	public static function Get($info) {
		$shopItem;
		if ($info instanceof static) {
			$shopItem = $info;
		} elseif (is_numeric($info)) {
			$shopItem = parent::Get(["id" => $info]);
		} elseif (is_array($info)) {
			$shopItem = parent::Get($info);
		}
		if (!$shopItem) {
			$class = get_called_class();
			throw new InvalidArgumentException(__METHOD__ . " requires either a $class, a $class ID or an Array of information to look up");
		}
		return $shopItem;
	}

	public function __construct(Array $info) {
		$this->setId($info["id"] ?? null);
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