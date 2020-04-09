<?php

// Example MySQL object class deriving ShopItem, DO NOT USE, only copy from.

class Dummy extends ShopItem {
	protected static string $table = "";

	protected static Array $sqlMap = [
		"from" => "to"
	];

	function __construct(Array $info = []) {
		parent::__construct($info);
	}
}

