<?php

require "init.php";

$productManager = new ProductManager($db);

var_dump($productManager->find([
	"name" => "Baie",
]))

?>