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
		$query = 'SELECT * FROM categories ORDER BY id';
		
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

	public function getCategory($id) {
		$query = 'SELECT * FROM categories WHERE id="'.$id.'"';
		$result = $this->db->query($query); 
		$row = $result->fetch();
		if ($result->rowcount()!=0) {
			return new Category($row->id,$row->name);
		}
		return null;
	}

	public function deleteCategory($categoryId){
		$query = 'DELETE FROM categories WHERE id="'.$categoryId . '"';
		$qp = $this->db->prepare($query);
		$qp->execute();
		return true;
	}
    

	public function editCategory($category){
		$query = 'UPDATE categories SET name=' . $this->db->quote($category->name()) . 'WHERE id=' . $category->id();
		$qp = $this->db->prepare($query);
		try{
            $qp->execute();
            return true;
        }catch (PDOException $e) {
		    return false;
        }
	}

}



?>