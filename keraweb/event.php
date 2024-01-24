<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

include_once "config/database.php";
include_once "objects/event.php";
include_once "objects/event_image.php";
include_once "objects/cart_item.php";

$database = new Database();
$db = $database->getConnection();

$event = new Event($db);
$event_image = new EventImage($db);
$cart_item = new CartItem($db);

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$action = isset($_GET['action']) ? $_GET['action'] : "";
$event->event_id = $id;
$event->readOne();
$page_title = $event->event_name;

include_once 'layout_head.php';

echo "<div class='col-md-12'>";
	if($action=='added'){
		echo "<div class='alert alert-info'>";
			echo "Product was added to your cart!";
		echo "</div>";
	}
	else if($action=='unable_to_add'){
		echo "<div class='alert alert-info'>";
			echo "Unable to add product to cart. Please contact Admin.";
		echo "</div>";
	}
echo "</div>";

$event_image->event_id=$id;
	$stmt_event_image = $event_image->readByEventId();
	$num_product_image = $stmt_event_image->rowCount();

echo "<div class='col-md-1'>";
	if($num_product_image>0){
		while ($row = $stmt_event_image->fetch(PDO::FETCH_ASSOC)){
			$event_image_name = $row['img_name'];
			$source="uploads/images/{$event_image_name}";
			echo "<img src='{$source}' class='product-img-thumb' data-img-id='{$row['img_id']}' />";
		}
	}else{ echo "No images."; }
echo "</div>";
echo "<div class='col-md-4' id='product-img'>";
	$stmt_event_image = $event_image->readByEventId();
	$num_product_image = $stmt_event_image->rowCount();
	if($num_product_image>0){
		$x=0;
		while ($row = $stmt_event_image->fetch(PDO::FETCH_ASSOC)){
			$event_image_name = $row['img_name'];
			$source="uploads/images/{$event_image_name}";
			$show_product_img=$x==0 ? "display-block" : "display-none";
			echo "<a href='{$source}' id='product-img-{$row['img_id']}' class='product-img {$show_product_img}' data-gallery>";
				echo "<img src='{$source}' style='width:100%;' />";
			echo "</a>";
			$x++;
		}
	}else{ echo "No images."; }
echo "</div>";

echo "<div class='col-md-5'>";
	echo "<div class='product-detail'>Price:</div>";
	echo "<h4 class='m-b-10px price-description'>&#36;" . number_format($event->event_price, 2, '.', ',') . "</h4>";
	echo "<div class='product-detail'>Product description:</div>";
	echo "<div class='m-b-10px'>";
		$page_description = htmlspecialchars_decode(htmlspecialchars_decode($event->event_desc));
		// show to user
		echo $page_description;
	echo "</div>";

echo "</div>";

echo "<div class='col-md-2'>";
	$cart_item->cust_id=1; 
	$cart_item->event_id=$id;
	if($cart_item->exists()){
		echo "<div class='m-b-10px'>This product is already in your cart.</div>";
		echo "<a href='cart.php' class='btn btn-success w-100-pct'>";
			echo "Update Cart";
		echo "</a>";
	}	else{
		echo "<form class='add-to-cart-form'>";
			echo "<div class='product-id display-none'>{$id}</div>";
			echo "<div class='m-b-10px f-w-b'>Quantity:</div>";
			echo "<input type='number' class='form-control m-b-10px cart-quantity' value='1' min='1' />";
			echo "<button style='width:100%;' type='submit' class='btn btn-primary add-to-cart m-b-10px'>";
				echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
			echo "</button>";

		echo "</form>";
	}
echo "</div>";
?>


	<!-- bootstrap reference-->
	<div id="blueimp-gallery" class="blueimp-gallery">
		<!-- The container for the modal slides -->
		<div class="slides"></div>
		<!-- Controls for the borderless lightbox -->
		<h3 class="title"></h3>
		<a class="prev">&#9668;</a>
		<a class="next">&#9658;</a>
		<a class="close">X</a>
		<a class="play-pause"></a>
		<ol class="indicator"></ol>
		<!-- The modal dialog, which will be used to wrap the lightbox content -->
		<div class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" aria-hidden="true">&times;</button>
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body next"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left prev">
							<i class="glyphicon glyphicon-chevron-left"></i>
							Previous
						</button>
						<button type="button" class="btn btn-primary next">
							Next
							<i class="glyphicon glyphicon-chevron-right"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
echo "</div>";
include_once 'layout_foot.php';
?>


