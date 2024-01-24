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

$page_title="Events";

include 'layout_head.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "1";

// for pages
$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$records_per_page = 6; 
	$from_record_num = ($records_per_page * $page) - $records_per_page;
	$stmt=$event->read($from_record_num, $records_per_page);
	$num = $stmt->rowCount();

if($num>0){
	$page_url="events.php?";
	$total_rows=$event->count();
		include_once "read_events_template.php";
}
else{
	echo "<div class='col-md-12'>";
    	echo "<div class='alert alert-danger'>No events found.</div>";
	echo "</div>";
}

include 'layout_foot.php';
?>
