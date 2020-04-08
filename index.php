<?php

require "includes/init.php";

var_dump(Category::Get([ "name" => "Equipement" ]));
var_dump(SubCategory::Get([ "name" => "Poisson" ]));
var_dump(Product::Get([ "name" => "Baie" ]));

?>