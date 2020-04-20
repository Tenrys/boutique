<?php

require_once("includes/helpers.php");
require_once("includes/db.php");

require_once("classes/Item.php");
Item::$db = $db;
require_once("classes/ShopItem.php");

require_once("classes/traits/DateProperty.php");

require_once("classes/User.php");
require_once("classes/Address.php");

require_once("classes/Category.php");
require_once("classes/SubCategory.php");
require_once("classes/Product.php");
require_once("classes/Comment.php");

require_once("classes/WishList.php");
require_once("classes/Purchase.php");
require_once("classes/ProductPurchase.php");

if (!isset($_SESSION)) {
	session_start();
}

/* Debug
if (!isset($_SESSION["user"]) || !$_SESSION["user"]) {
	$user = User::Get(["firstname" => "Marceau"]);
	$_SESSION["user"] = $user;
}
*/
