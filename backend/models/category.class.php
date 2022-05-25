<?php
class Category {
	private $_id;
	private $_name;
	
	public function __construct($id,$name){
		$this->_id = $id;
		$this->_name = $name;
	}
	
	public function id(){
		return $this->_id;		
	}	

	public function name(){
		return $this->_name;		
	}

}
?>