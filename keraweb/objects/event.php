<?php
class Event{
	private $conn;
	private $table_name="events";
		public $event_id;
		public $event_name;
		public $event_price;
		public $event_desc;
		public $timestamp;
		public function __construct($db){
			$this->conn = $db;
	}
	function readOne(){
		$query = "SELECT
					event_name, event_desc, event_price
				FROM
					" . $this->table_name . "
				WHERE
					event_id = ?
				LIMIT
					0,1";

		$stmt = $this->conn->prepare( $query );
		$this->event_id=htmlspecialchars(strip_tags($this->event_id));
		$stmt->bindParam(1, $this->event_id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->event_name = $row['event_name'];
		$this->event_desc = $row['event_desc'];
		$this->event_price = $row['event_price'];
	}
	// reference http://stackoverflow.com/a/10722827/827418
	public function readByIds($event_ids){
		$event_ids_arr = str_repeat('?,', count($event_ids) - 1) . '?';
		$query = "SELECT event_id, event_name, event_price FROM " . $this->table_name . " WHERE event_id IN ({$event_ids_arr}) ORDER BY event_name";
		$stmt = $this->conn->prepare($query);
		$stmt->execute($event_ids);
		return $stmt;
	}

	function read($from_record_num, $records_per_page){
		$query = "SELECT
					event_id, event_name, event_desc, event_price
				FROM
					" . $this->table_name . "
				ORDER BY
					event_created DESC
				LIMIT
					?, ?";

			$stmt = $this->conn->prepare( $query );
			$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
			$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
			$stmt->execute();
		return $stmt;
	}

	public function count(){
		$query = "SELECT count(*) FROM " . $this->table_name;
			$stmt = $this->conn->prepare( $query );
			$stmt->execute();
			$rows = $stmt->fetch(PDO::FETCH_NUM);
		return $rows[0];
	}

}
?>
