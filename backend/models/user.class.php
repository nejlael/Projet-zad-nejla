<?php
class User {
	private $_id;
	private $_firstname;
    private $_lastname;
    private $_email;
    private $_password;
    private $_isAdmin;
	
	public function __construct($id,$firstname, $lastname, $email, $password = null, $isAdmin = false){
		$this->_id = $id;
		$this->_firstname = $firstname;
        $this->_lastname = $lastname;
        $this->_email = $email;
		if($password != null){
			$this->_password = md5($password);
		}

        $this->_isAdmin = $isAdmin;
	}

	
	public function id(){
		return $this->_id;		
	}	

	public function firstname(){
		return $this->_firstname;		
	}

    public function lastname(){
		return $this->_lastname;		
	}

    public function email(){
		return $this->_email;		
	}

    public function password(){
		return $this->_password;		
	}
    public function isAdmin(){
		return $this->_isAdmin;		
	}
}
?>