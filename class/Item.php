<?php

class Item {
	public static PDO $db;
	protected static string $table;

	const SQLMap = [];

	public function toArray() {
		$arr = [];

		foreach ($this as $key => $value) {
			$arr[$key] = $value;
		}

		return $arr;
	}
	public function forSQL() {
		$arr = $this->toArray();

		foreach (static::SQLMap as $from => $to) {
			$arr[$to] = $arr[$from];
			unset($arr[$from]);
		}

		return $arr;
	}

	public static function Find(Array $info) {
		$request = "SELECT * FROM " . static::$table . " WHERE\n";
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

		$stmt = self::$db->prepare($request);
		$stmt->execute($info);
		$result = $stmt->fetchAll();
		if (is_array($result)) {
			foreach ($result as $key => $value) {
				$result[$key] = new static($value);
			}
		}

		return $result;
	}

	public static function Get(Array $info) {
		$result = static::Find($info);
		if ($result) $result = $result[0];

		return $result;
	}

	public static function Insert(Item &$item) {
		if (!$item instanceof static) {
			return trigger_error(__METHOD__ . " requires an argument " . get_called_class(), E_USER_ERROR);
		}

		$sqlArr = $item->forSQL();

		$request = "INSERT INTO " . static::$table . " (" . implode(", ", array_keys($sqlArr)) . ")
		VALUES (" . implode(", ", array_map(function($key) { return ":$key"; }, array_keys($sqlArr)))  . ")";

		$stmt = self::$db->prepare($request);
		if ($stmt->execute($sqlArr)) {
			if (!$item->getId()) {
				$item->setId(self::$db->lastInsertId());
			}
			return true;
		} else {
			var_dump($stmt->errorInfo());
			return false;
		}
	}

	public static function Delete(Item &$item) {
		if (!$item instanceof static) {
			return trigger_error(__METHOD__ . " requires an argument " . get_called_class(), E_USER_ERROR);
		}

		if (!$item->getId()) {
			return trigger_error(__METHOD__ . " requires the " . get_called_class() . " to have an ID assigned", E_USER_ERROR);
		}

		$request = "DELETE FROM " . static::$table . " WHERE id = ?";

		$stmt = self::$db->prepare($request);
		if ($stmt->execute([$item->getId()])) {
			$item = null;
			return true;
		} else {
			var_dump($stmt->errorInfo());
			return false;
		}
	}

	public static function Update(Item $item) {
		if (!$item instanceof static) {
			return trigger_error(__METHOD__ . " requires an argument " . get_called_class(), E_USER_ERROR);
		}

		if (!$item->getId()) {
			return trigger_error(__METHOD__ . " requires the " . get_called_class() . " to have an ID assigned", E_USER_ERROR);
		}

		$sqlArr = $item->forSQL();
		$cols = [];
		foreach($sqlArr as $key => $val) {
			$cols[] = "$key = :key";
		}
		$request = "UPDATE " . static::$table . " SET " . implode(", ", $cols) . " WHERE id = :id";

		$stmt = self::$db->prepare($request);
		if ($stmt->execute($sqlArr)) {
			return true;
		} else {
			var_dump($stmt->errorInfo());
			return false;
		}
	}
}
