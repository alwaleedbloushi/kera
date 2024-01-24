<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

include 'config/database.php';
include_once "objects/event.php";
include_once "objects/event_image.php";
include_once "objects/cart_item.php";

$database = new Database();
$db = $database->getConnection();
$event = new Event($db);
$product_image = new EventImage($db);
$cart_item = new CartItem($db);
$page_title="Checkout";

include 'layout_head.php';

if($cart_count>0){
	$cart_item->cust_id="1";
	$stmt=$cart_item->read();
	$total=0;
	$item_count=0;
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
			$sub_total=$event_price*$quantity;
		echo "<div class='cart-row'>";
			echo "<div class='col-md-8'>";
				echo "<div class='product-name m-b-10px'><h4>{$event_name}</h4></div>";
                echo $quantity>1 ? "<div>{$quantity} items</div>" : "<div>{$quantity} item</div>";
			echo "</div>";
			echo "<div class='col-md-4'>";
				echo "<h4>&#36;" . number_format($event_price, 2, '.', ',') . "</h4>";
			echo "</div>";
		echo "</div>";
		$item_count += $quantity;
		$total+=$sub_total;
	}

	echo "<div class='col-md-12 text-align-center'>";
		echo "<div class='cart-row'>";
            if($item_count>1){
    			echo "<h4 class='m-b-10px'>Total ({$item_count} items)</h4>";
            }else{
                echo "<h4 class='m-b-10px'>Total ({$item_count} item)</h4>";
            }
			echo "<h4>&#36;" . number_format($total, 2, '.', ',') . "</h4>";

	        echo "<a href='place_order.php' class='btn btn-lg btn-success m-b-10px'>";
	        	echo "<span class='glyphicon glyphicon-shopping-cart'></span> Place Order";
	        echo "</a>";
		echo "</div>";
	echo "</div>";

}

else{
	echo "<div class='col-md-12'>";
		echo "<div class='alert alert-danger'>";
			echo "No products found in your cart!";
		echo "</div>";
	echo "</div>";
}

include 'layout_foot.php';
?>
