<?php

class Db{
    public $_db;

    //Le constructeur est la première chose qui est executé quand on fait un 'new' de cette classe
    public function __construct()
    {
        try {
			//permet de charger la base de donnée
            $this->_db = new PDO('mysql:host=localhost;dbname=zad_emerald;port=3316', 'zad_emerald', 'zad_emerald');
            var_dump($this->_db);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
      } 
		catch (PDOException $e) {
		    die('Erreur de connexion à la base de données : '.$e->getMessage());
        }
    }

}

?>