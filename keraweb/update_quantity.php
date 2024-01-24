<?php
// refresh cart
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

$event_code = isset($_GET['event_id']) ? $_GET['event_id'] : 1;
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
$quantity=$quantity<=0 ? 1 : $quantity;

include 'config/database.php';
include_once "objects/cart_item.php";

$database = new Database();
$db = $database->getConnection();	
	$cart_item = new CartItem($db);
	$cart_item->cust_id=1;
	$cart_item->event_code=$event_code;
	$cart_item->quantity=$quantity;
if($cart_item->update()){
	header("Location: cart.php?action=updated");
}
else{
	header("Location: cart.php?action=unable_to_update");
}
?>
