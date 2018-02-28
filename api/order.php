<?php
Class Order {
	
	public function __construct(){
		$this->db = $this->getDB();
	}

	private function getDB() {
		$dbhost="127.0.0.1";
		$dbuser="root";
		$dbpass="";
		$dbname="flyspaces";
		$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass); 
		$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbConnection;
	}
	public function getAllOrder(){
        $sql = "SELECT * FROM orderlist ORDER BY id ASC";
        $stmt = $this->db->query($sql); 
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
	}
	public function getOrder($id){
        $sql = "SELECT * FROM orderlist WHERE id=?";
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        return $data;
	}
	public function insertOrder($name,$email,$order){
        $sql = "INSERT INTO orderlist (name, email, orders) VALUES (?,?,?)";
        $stmt = $this->db->prepare($sql); 
        $status = $stmt->execute([$name, $email, $order]);
        return $status;
	}
	public function updateOrder($id,$name,$email,$order){
        $sql = "UPDATE orderlist SET name=?, email=?, orders=? WHERE id=?";
        $stmt = $this->db->prepare($sql); 
        $status = $stmt->execute([$name,$email,$order,$id]);
        return $status;
	}
	public function deleteOrder($id){
        $sql = "DELETE FROM orderlist WHERE id=?";
        $stmt = $this->db->prepare($sql); 
        $status = $stmt->execute([$id]);
        return $status;
	}
}
?>