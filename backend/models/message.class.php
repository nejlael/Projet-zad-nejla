<?php
class message {
	private $_messageID;
	private $_messageFirstname;
	private $_messageEmail;
    private $_message;
	
	public function __construct($messageID, $messageFirstname, $messageEmail, $message){
		$this->_messsageID = $messsageID;
		$this->_messageFirstname = $messageFirstname;
		$this->_messageEmail = $messageEmail;
        $this->_lastname = $lastname;
        $this->_message = $message;
	}

	
	public function messageID(){
		return $this->_messageID;		
	}
	
	public function messageFirstname(){
		return $this->_messageFirstname;		
	}

	public function messageEmail(){
		return $this->_messageEmail;		
	}

    public function message(){
		return $this->_message;		
	}
}
?>