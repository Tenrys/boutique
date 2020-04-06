<?php

$db = new PDO("mysql:host=127.0.0.1;dbname=boutique", "root", "root");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION["user"]) || !$_SESSION["user"]) {
	$stmt = $db->prepare("SELECT * FROM users WHERE firstname = 'Marceau'");
	$stmt->execute();
	$result = $stmt->fetch();
	unset($result["password"]);
	$_SESSION["user"] = $result;
}
?>