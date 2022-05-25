<?php 
class CategoryService {
    
    private $db;
    
    public function __construct(){
		$conn = new Db();
        $this->db = $conn->_db;
    }

    public function save($category) {
		$query = 'INSERT INTO categories (name) values (:name)';
        $qp = $this->db->prepare($query);
		$qp->bindValue(':name',$category->name());
        try{
            $qp->execute();
            return true;
        }catch (PDOException $e) {
		    return false;
        }
	}

    public function getCategories() {
		$query = 'SELECT * FROM categories';
		
		# Exécution du query
		$result = $this->db->query($query); 

		# Parcours de l'ensemble des résultats et construction d'un tableau d'objet(s) de la classe Category
		$array = array();
		if ($result->rowcount()!=0) {
			while ($row = $result->fetch()) {		
				$array[] = new Category($row->id,$row->name);
			}
		}	
		return $array;
	}
    

}



?>