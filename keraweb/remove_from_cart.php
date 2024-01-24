<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

$event_id = isset($_GET['id']) ? $_GET['id'] : "";

include 'config/database.php';
include_once "objects/cart_item.php";

$database = new Database();
$db = $database->getConnection();
    $cart_item = new CartItem($db);
    $cart_item->cust_id=1;  
    $cart_item->event_code=$event_id;
    $cart_item->delete();

header('Location: cart.php?action=removed&id=' . $cart_id);
    die();
?>
