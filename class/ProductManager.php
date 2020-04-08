<?php

class ProductManager {
	private PDO $db;

	function __construct(PDO $db) {
		$this->db = $db;
	}

	public function find(Array $info) {
		if (isset($info["date"]) && $info["date"] instanceof DateTime) {
			$info["date"] = mysql_timestamp($info["date"]->getTimestamp());
		}

		$request = "SELECT * FROM products WHERE\n";
		$i = 0;
		foreach ($info as $key => $_) {
			if (is_string($key)) {
				$request .= "$key = :$key";
				$i++;
				if ($i < count($info)) {
					$request .= " AND \n";
				}
			}
		}

		$stmt = $this->db->prepare($request);
		$stmt->execute($info);
		$result = $stmt->fetchAll();
		if (is_array($result)) {
			foreach ($result as $key => $value) {
				$result[$key] = new Product($value);
			}
		}

		return $result;
	}

	public function get(Array $info) {
		$result = $this->find($info);
		if ($result) $result = $result[0];

		return $result;
	}

	public function insert(Product &$product) {
		$productArr = $product->forSQL();

		$request = "INSERT INTO products (" . implode(", ", array_keys($productArr)) . ")\nVALUES (" . implode(", ", array_fill(0, count($productArr), "?")) . ")";

		$stmt = $this->db->prepare($request);
		if ($stmt->execute(array_values($productArr))) {
			if (!isset($productArr["id"])) {
				$product->setId($this->db->lastInsertId());
			}
			return true;
		} else {
			var_dump($stmt->errorInfo());
			return false;
		}
	}

	public function delete(Product &$product) {
		if (!$product->getId()) {
			return trigger_error(__METHOD__ . " requires the product to have an ID assigned", E_USER_ERROR);
		}

		$request = "DELETE FROM products WHERE id = ?";

		$stmt = $this->db->prepare($request);
		if ($stmt->execute([$product->getId()])) {
			$product = null;
			return true;
		} else {
			var_dump($stmt->errorInfo());
			return false;
		}
	}

	public function update(Product $product) {
		if (!$product->getId()) {
			return trigger_error(__METHOD__ . " requires the product to have an ID assigned", E_USER_ERROR);
		}

		$productArr = $product->forSQL();
		$cols = [];
		foreach($productArr as $key => $val) {
			$cols[] = "$key = ?";
		}
		$request = "UPDATE products SET " . implode(", ", $cols) . " WHERE id = ?";

		$stmt = $this->db->prepare($request);
		if ($stmt->execute([...array_values($productArr), $product->getId()])) {
			return true;
		} else {
			var_dump($stmt->errorInfo());
			return false;
		}
	}
}
