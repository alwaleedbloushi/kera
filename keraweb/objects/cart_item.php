<?php
class CartItem{
    private $conn;
    private $table_name = "cart_items";
        public $cart_id;
        public $event_code;
        public $quantity;
        public $cust_id;
        public $cart_created;
        public $cart_modified;
        public function __construct($db){
            $this->conn = $db;
    }
    
    public function deleteByUser(){
        $query = "DELETE FROM " . $this->table_name . " WHERE cust_id=:cust_id";
    	$stmt = $this->conn->prepare($query);
        $this->cust_id=htmlspecialchars(strip_tags($this->cust_id));
        $stmt->bindParam(":cust_id", $this->cust_id);
    	if($stmt->execute()){
    		return true;
    	}
        return false;
    }
    
    function update(){
        $query = "UPDATE " . $this->table_name . "
                SET quantity=:quantity
                WHERE event_code=:event_code AND cust_id=:cust_id";

        $stmt = $this->conn->prepare($query);
        $this->quantity=htmlspecialchars(strip_tags($this->quantity));
        $this->event_code=htmlspecialchars(strip_tags($this->event_code));
        $this->cust_id=htmlspecialchars(strip_tags($this->cust_id));
            $stmt->bindParam(":quantity", $this->quantity);
            $stmt->bindParam(":event_code", $this->event_code);
            $stmt->bindParam(":cust_id", $this->cust_id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE event_code=:event_code AND cust_id=:cust_id";
    	    $stmt = $this->conn->prepare($query);
    	    $this->event_code=htmlspecialchars(strip_tags($this->event_code));
            $this->cust_id=htmlspecialchars(strip_tags($this->cust_id));
    	    $stmt->bindParam(":event_code", $this->event_code);
            $stmt->bindParam(":cust_id", $this->cust_id);
    	        if($stmt->execute()){
    		return true;
    	}
        return false;
    }

    public function read(){
        $query="SELECT e.event_id, e.event_name, e.event_price, ci.quantity, ci.quantity * e.event_price AS subtotal
    			FROM " . $this->table_name . " ci
    				LEFT JOIN events e  
    					ON ci.event_code = e.event_id
                WHERE ci.cust_id=:cust_id";
		    $stmt = $this->conn->prepare($query);
            $this->cust_id=htmlspecialchars(strip_tags($this->cust_id));
		    $stmt->bindParam(":cust_id", $this->cust_id, PDO::PARAM_INT);
		    $stmt->execute();
		return $stmt;
    }

    function create(){
        $this->cart_created=date('Y-m-d H:i:s');
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
    				event_code = :event_code,
    				quantity = :quantity,
    				cust_id = :cust_id,
    				cart_created = :cart_created";
            $stmt = $this->conn->prepare($query);
    	    $this->event_code=htmlspecialchars(strip_tags($this->event_code));
    	    $this->quantity=htmlspecialchars(strip_tags($this->quantity));
    	    $this->cust_id=htmlspecialchars(strip_tags($this->cust_id));
                $stmt->bindParam(":event_code", $this->event_code);
                $stmt->bindParam(":quantity", $this->quantity);
                $stmt->bindParam(":cust_id", $this->cust_id);
    	        $stmt->bindParam(":cart_created", $this->cart_created);
                    if($stmt->execute()){
                         return true;
        }
        return false;
    }

    public function exists(){
        $query = "SELECT count(*) FROM " . $this->table_name . " WHERE event_code=:event_code AND cust_id=:cust_id";
            $stmt = $this->conn->prepare( $query );
    	    $this->event_code=htmlspecialchars(strip_tags($this->event_code));
            $this->cust_id=htmlspecialchars(strip_tags($this->cust_id));
    	    $stmt->bindParam(":event_code", $this->event_code);
            $stmt->bindParam(":cust_id", $this->cust_id);
            $stmt->execute();
            $rows = $stmt->fetch(PDO::FETCH_NUM);
        if($rows[0]>0){
            return true;
        }
        return false;
    }
    public function count(){ //count
        $query = "SELECT count(*) FROM " . $this->table_name . " WHERE cust_id=:cust_id";
            $stmt = $this->conn->prepare( $query );
            $this->cust_id=htmlspecialchars(strip_tags($this->cust_id));
            $stmt->bindParam(":cust_id", $this->cust_id);
            $stmt->execute();
                $rows = $stmt->fetch(PDO::FETCH_NUM);
                    return $rows[0];
    }
}
?>
