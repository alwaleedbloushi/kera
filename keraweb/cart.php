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
$event_image = new EventImage($db);
$cart_item = new CartItem($db);
$page_title="Cart";

include 'layout_head.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";

echo "<div class='col-md-12'>"; //alerts
	if($action=='removed'){
		echo "<div class='alert alert-info'>";
			echo "Product was removed from your cart!";
		echo "</div>";
	}
	else if($action=='quantity_updated'){
		echo "<div class='alert alert-info'>";
			echo "Product quantity was updated!";
		echo "</div>";
	}
	else if($action=='exists'){
		echo "<div class='alert alert-info'>";
			echo "Product already exists in your cart!";
		echo "</div>";
	}
	else if($action=='cart_emptied'){
		echo "<div class='alert alert-info'>";
			echo "Cart was emptied.";
		echo "</div>";
	}
	else if($action=='updated'){
		echo "<div class='alert alert-info'>";
			echo "Quantity was updated.";
		echo "</div>";
	}
	else if($action=='unable_to_update'){
		echo "<div class='alert alert-danger'>";
			echo "Unable to update quantity.";
		echo "</div>";
	}
echo "</div>";

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
				echo "<div class='product-name m-b-10px'>";
					echo "<h4>{$event_name}</h4>";
				echo "</div>";

				echo "<form class='update-quantity-form'>";
					echo "<div class='event_code' style='display:none;'>{$event_id}</div>";
					echo "<div class='input-group'>";
						echo "<input type='number' name='quantity' value='{$quantity}' class='form-control cart-quantity' min='1' />";
							echo "<span class='input-group-btn'>";
								echo "<button class='btn btn-default update-quantity' type='submit'>Update</button>";
							echo "</span>";
					echo "</div>";
				echo "</form>";

				// delete from cart
				echo "<a href='remove_from_cart.php?id={$event_id}' class='btn btn-default'>";
					echo "Delete";
				echo "</a>";
			echo "</div>";

			echo "<div class='col-md-4'>";
				echo "<h4>&#36;" . number_format($event_price, 2, '.', ',') . "</h4>";
			echo "</div>";
		echo "</div>";
		$item_count += $quantity;
		$total+=$sub_total;
	}
	echo "<div class='col-md-8'></div>";
	echo "<div class='col-md-4'>";
		echo "<div class='cart-row'>";
			echo "<h4 class='m-b-10px'>Total ({$item_count} items)</h4>";
			echo "<h4>&#36;" . number_format($total, 2, '.', ',') . "</h4>";
	        echo "<a href='checkout.php' class='btn btn-success m-b-10px'>";
	        	echo "<span class='glyphicon glyphicon-shopping-cart'></span> Proceed to Checkout";
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
