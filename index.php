<?php

require "includes/init.php";

$productManager = new ProductManager($db);

$testProduct = new Product([
	"name" => "Test",
	"description" => "Test",
	"price" => 1,
	"id_subcategory" => 4
]);

var_dump($productManager->insert($testProduct));

?>