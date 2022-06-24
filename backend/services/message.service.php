<?php 

class messageService {
    
    private $db;
    
    public function __construct(){
        $conn = new Db();
        $this->db = $conn->_db;
    }

    public function register($message) {
		$query = 'INSERT INTO messages (messageEmail, messageFirstname, message) values (:messageEmail, :messageFirstname :message)';
		
        $qp = $this->db->prepare($query);
		$qp->bindValue(':messageEmail',$message->messageEmail());
		$qp->bindValue(':lastname',$message->lastname());
        $qp->bindValue(':email',$message->email());
        $qp->bindValue(':password',$message->password());
        try{
            $qp->execute();
            return true;
        }catch (PDOException $e) {
		    return false;
        }
	}

    public function login($email, $password) {
        $passwordHash = md5($password);
		$query = 'SELECT * FROM users WHERE email="'.$email.'" AND password="'.$passwordHash.'"';
		$result = $this->db->query($query); 
		$row = $result->fetch();
		if ($result->rowcount()!=0) {
			return new User($row->id,$row->firstname,$row->lastname,$row->email,null, $row->is_admin);
		}
		return null;
	}

    public function getUsers() {
		$query = 'SELECT * FROM users ORDER BY id';
		$result = $this->db->query($query); 
		$array = array();
		if ($result->rowcount()!=0) {
			while ($row = $result->fetch()) {		
				$array[] = new User($row->id,$row->firstname,$row->lastname,$row->email,null, $row->is_admin);
			}
		}	
		return $array;
	}

    

}



?>