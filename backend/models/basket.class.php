<?php
class Basket {
	private $_id;
	private $_userId;
	private $_productId;
	public function __construct($id,$userId,$productId){
		$this->_id = $id;
		$this->_userId = $userId;
		$this->_productId = $productId;
	}
	
	public function id(){
		return $this->_id;		
	}	

	public function userId(){
		return $this->_userId;		
	}

	public function productId(){
		return $this->_productId;		
	}

}
?>