<?php

require_once "includes/helpers.php";
require_once "includes/db.php";

/*
require_once "class/CategoryManager.php";
require_once "class/Category.php";
require_once "class/SubCategory.php";
*/

require_once "class/Item.php";

Item::$db = $db;

require_once "class/Category.php";
require_once "class/SubCategory.php";
require_once "class/Product.php";
