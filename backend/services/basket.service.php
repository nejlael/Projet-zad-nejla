<?php 
class BasketService {
    
    private $db;
    
    public function __construct(){
		$conn = new Db();
        $this->db = $conn->_db;
    }

    public function save($userId, $productId) {
		$query = 'INSERT INTO baskets (user_id, product_id) values (:user_id, :product_id)';
        $qp = $this->db->prepare($query);
		$qp->bindValue(':user_id',$userId);
		$qp->bindValue(':product_id',$productId);
        try{
            $qp->execute();
            return true;
        }catch (PDOException $e) {
		    return false;
        }
	}

	public function getBasketsOfUser($userId) {
		$query = 'SELECT * FROM baskets WHERE user_id="'.$userId.'"';
		# Exécution du query
		$result = $this->db->query($query); 
		$array = array();
		if ($result->rowcount()!=0) {
			while ($row = $result->fetch()) {		
				$array[] = new Basket($row->id,$row->user_id, $row->product_id);
			}
		}	
		return $array;
	}

	public function getSumBasketsOfUser($userId) {
		$query = 'SELECT SUM(pr.price) as total FROM baskets ba INNER JOIN products pr ON ba.product_id =  pr.id WHERE ba.user_id="'.$userId.'"';
		$qp = $this->db->prepare($query);
		$qp->execute();
		$row = $qp->fetch(PDO::FETCH_ASSOC);
		return $row['total'];
	}


	public function removeProductFromBaskets($userId, $productId){
		$query = 'DELETE FROM baskets WHERE user_id="'.$userId.'" AND product_id="'.$productId.'"';
		$qp = $this->db->prepare($query);
		$qp->execute();
		return true;
	}

	public function deleteBasketsByProductId($productId){
		$query = 'DELETE FROM baskets WHERE product_id="'.$productId . '"';
		$qp = $this->db->prepare($query);
		$qp->execute();
		return true;
	}

}



?>