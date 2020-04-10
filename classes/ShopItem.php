<?php

class ShopItem extends Item {
	protected ?int $id = null;

	public static function Get($data) {
		$shopItem = false;
		if ($data instanceof static) {
			$shopItem = $data;
		} elseif (is_numeric($data)) {
			$shopItem = parent::Get(["id" => $data]);
		} elseif (is_array($data)) {
			$shopItem = parent::Get($data);
		}
		if ($shopItem === false) {
			$class = get_called_class();
			throw new InvalidArgumentException(__METHOD__ . " requires either a $class, a $class ID or an Array of information to look up");
		}
		return $shopItem;
	}
	/*
	public static function Find($data = null) {
		$shopItem;
		if ($data instanceof static) {
			$shopItem = $data;
		} elseif (is_numeric($data)) {
			$shopItem = parent::Find(["id" => $data]);
		} elseif (is_array($data)) {
			$shopItem = parent::Find($data);
		} else {
			$shopItem = parent::Find();
		}
		if (!isset($shopItem)) {
			$class = get_called_class();
			throw new InvalidArgumentException(__METHOD__ . " requires either a $class, a $class ID or an Array of information to look up");
		}
		return $shopItem;
	}
	*/

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