<?php

class Item {
	public static PDO $db;
	protected static string $table;

	protected static Array $sqlMap = [];

	public function inDatabase() {
		return false;
	}
	public function toArray() {
		$arr = [];

		foreach ($this as $key => $value) {
			$arr[$key] = $value;
		}

		return $arr;
	}
	public function forSQL() {
		$arr = $this->toArray();

		foreach ($arr as $key => $value) {
			if ($value instanceof self && !$value->inDatabase()) {
				throw new InvalidArgumentException(get_class($value) . " " . $key . " is not part of the database");
			}

			if ($value instanceof DateTime) {
				$arr[$key] = mysql_timestamp($value);
			} elseif ($value instanceof self) {
				$arr[$key] = $value->getDatabaseId();
			}
		}

		foreach (static::$sqlMap as $from => $to) {
			$arr[$to] = $arr[$from];
			unset($arr[$from]);
		}

		return $arr;
	}

	public static function Ready() {
		return self::$db instanceof PDO && is_string(static::$table);
	}

	public static function Find(Array $data = []) {
		if (!static::Ready()) return;

		$request = "SELECT * FROM " . static::$table;
		if (count($data) > 0) {
			$request .= " WHERE\n";
			$i = 0;
			foreach ($data as $key => $_) {
				if (is_string($key)) {
					$request .= "$key = :$key";
					$i++;
					if ($i < count($data)) {
						$request .= " AND \n";
					}
				}
			}
		}

		$stmt = self::$db->prepare($request);
		$stmt->execute($data);
		$result = $stmt->fetchAll();
		if (is_array($result)) {
			foreach ($result as $key => $value) {
				$result[$key] = new static($value);
			}
		}

		return $result;
	}

	public static function Get(Array $data) {
		$result = static::Find($data);
		if ($result) $result = $result[0];

		return $result ?? false;
	}

	public static function Insert(self &$item) {
		if (!static::Ready()) return;

		if (!$item instanceof static) {
			throw new InvalidArgumentException(__METHOD__ . " requires an argument " . get_called_class());
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

	public static function Delete(self &$item) {
		if (!static::Ready()) return;

		if (!$item instanceof static) {
			throw new InvalidArgumentException(__METHOD__ . " requires an argument " . get_called_class());
		}

		if (!$item->getId()) {
			throw new InvalidArgumentException(__METHOD__ . " requires the " . get_called_class() . " to have an ID assigned");
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

	public static function Update(self $item) {
		if (!static::Ready()) return;

		if (!$item instanceof static) {
			throw new InvalidArgumentException(__METHOD__ . " requires an argument " . get_called_class());
		}

		if (!$item->getId()) {
			throw new InvalidArgumentException(__METHOD__ . " requires the " . get_called_class() . " to have an ID assigned");
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
