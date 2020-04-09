<?php

$db = new PDO("mysql:host=127.0.0.1;dbname=boutique", "root", "");
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (!isset($_SESSION)) {
	session_start();
}

?>