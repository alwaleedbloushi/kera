<?php
class EventImage{
	private $conn;
	private $table_name = "event_images";
		public $img_id;
		public $event_id;
		public $img_name;
		public $timestamp;
		public function __construct($db){
			$this->conn = $db;
	}
	function readByEventId(){
		$query = "SELECT img_id, event_id, img_name
				FROM " . $this->table_name . "
				WHERE event_id = ?
				ORDER BY img_name ASC";

			$stmt = $this->conn->prepare( $query );
			$this->event_id=htmlspecialchars(strip_tags($this->event_id));
			$stmt->bindParam(1, $this->event_id);
			$stmt->execute();
		return $stmt;
	}
	function readFirst(){
		$query = "SELECT img_id, event_id, img_name
				FROM " . $this->table_name . "
				WHERE event_id = ?
				ORDER BY img_name DESC
				LIMIT 0, 1";
			$stmt = $this->conn->prepare( $query );
			$this->event_id=htmlspecialchars(strip_tags($this->event_id));
			$stmt->bindParam(1, $this->event_id);
			$stmt->execute();
		return $stmt;
	}
}
?>
