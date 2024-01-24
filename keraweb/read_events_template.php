<?php
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	extract($row);

	// creating box
	echo "<div class='col-md-4 m-b-20px'>";

		echo "<a href='event.php?id={$event_id}' class='product-link'>";
			$event_image->event_id=$event_id;
			$stmt_event_image=$event_image->readFirst();
			while ($row_event_image = $stmt_event_image->fetch(PDO::FETCH_ASSOC)){
				echo "<div class='m-b-10px'>";
					echo "<img src='uploads/images/{$row_event_image['img_name']}' class='w-100-pct' />";
				echo "</div>";
			}
			echo "<div class='event-name m-b-10px'>{$event_name}</div>";
		echo "</a>";
			echo "<div class='m-b-10px'>";
				echo "&#36;" . number_format($event_price, 2, '.', ',');
			echo "</div>";
			echo "<div class='m-b-10px'>";
				$cart_item->cust_id=1; 
				$cart_item->event_code=$event_id;

				if($cart_item->exists()){
					echo "<a href='cart.php' class='btn btn-success w-100-pct'>";
						echo "Update Cart";
					echo "</a>";
				}else{
					echo "<a href='add_to_cart.php?id={$event_id}&page={$page}' class='btn btn-primary w-100-pct'>Add to Cart</a>";
				}
			echo "</div>";
	echo "</div>";
}
include_once "paging.php";
