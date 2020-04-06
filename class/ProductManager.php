<?php

class ProductManager {
	private $db;

	function __construct(PDO $db) {
		$this->db = $db;
	}

	function get(Array $info) {
		$request = "SELECT * FROM products WHERE\n";
		$i = 0;
		foreach ($info as $key => $_) {
			if (is_string($key)) {
				$request .= "{$key} = :{$key}";
				$i++;
				if ($i < count($info)) {
					$request .= " AND \n";
				}
			}
		}
		$request .= "\n LIMIT 1";

		$stmt = $this->db->prepare($request);
		$stmt->execute($info);
		$result = $stmt->fetch();
		if ($result) {
			$result = new Product($result);
		}

		return $result;
	}

	function find(Array $info) {
		$request = "SELECT * FROM products WHERE\n";
		$i = 0;
		foreach ($info as $key => $_) {
			if (is_string($key)) {
				$request .= "{$key} = :{$key}";
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
}
