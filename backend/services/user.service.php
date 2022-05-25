<?php 

class UserService {
    
    private $db;
    
    public function __construct(){
        $conn = new Db();
        $this->db = $conn->_db;
    }

    public function register($user) {
		$query = 'INSERT INTO users (firstname, lastname, email, password) values (:firstname, :lastname, :email, :password)';
		
        $qp = $this->db->prepare($query);
		$qp->bindValue(':firstname',$user->firstname());
		$qp->bindValue(':lastname',$user->lastname());
        $qp->bindValue(':email',$user->email());
        $qp->bindValue(':password',$user->password());
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
			return new User($row->id,$row->firstname,$row->lastname,$row->email,null, $row->is_admin) ;
		}
		return null;
	}
    

}



?>