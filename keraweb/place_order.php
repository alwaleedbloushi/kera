<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

include_once "config/database.php";
include_once "objects/cart_item.php";

$database = new Database();
$db = $database->getConnection();

	$cart_item = new CartItem($db);
	$cart_item->cust_id_id=1;
	$cart_item->deleteByUser();
	$page_title="Thank You for using KERA!";

include_once 'layout_head.php';

echo "<div class='col-md-12'>";
	echo "<div class='alert alert-success'>";
		echo "For processing order, please transfer to <br><br>
		<strong>Al-Waleed Khalid - Omani Archive</strong><br>
		Bank Dhofar - 01010181352002 <br>
		Mobile Payment - +968 9888 2967<br><br>
		<strong> Thank you very much, your order will be processed after payment! </strong>";
	echo "</div>";
echo "</div>";

include_once 'layout_foot.php';
?>
