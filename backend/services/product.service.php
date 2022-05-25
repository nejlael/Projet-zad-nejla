<?php 
class ProductService {
    
    private $db;
    
    public function __construct(){
        $conn = new Db();
        $this->db = $conn->_db;
    }

    public function save($product) {
		$query = 'INSERT INTO products (name, cat_id, price, description, image) values (:name, :cat_id, :price, :description, :image)';
		
        $qp = $this->db->prepare($query);
		$qp->bindValue(':name',$product->name());
		$qp->bindValue(':cat_id',$product->catId());
        $qp->bindValue(':price',$product->price());
        $qp->bindValue(':description',$product->description());
        $qp->bindValue(':image',$product->image());
        try{
            $qp->execute();
            return true;
        }catch (PDOException $e) {
		    return false;
        }
	}

    public function getProducts() {
		$query = 'SELECT * FROM products';
		
		$result = $this->db->query($query); 

		$array = array();
		if ($result->rowcount()!=0) {
			while ($row = $result->fetch()) {		
				$array[] = new Product($row->id,$row->name, $row->cat_id,$row->price,$row->description, $row->image);
			}
		}	
		return $array;
	}
    

}



?>