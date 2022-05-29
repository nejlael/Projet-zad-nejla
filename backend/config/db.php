<?php

ini_set('mysql.connect_timeout',300);
ini_set('default_socket_timeout',300);
define('MB', 1048576); //1024 bytes *1024 bytes = 1048576 = 1 MB


class Db{
    public $_db;

    //Le constructeur est la première chose qui est executé quand on fait un 'new' de cette classe
    public function __construct()
    {
        try {
			//permet de charger la base de donnée
            $this->_db = new PDO('mysql:host=localhost;dbname=emerald_boutique;port=3306', 'root', '');
            //var_dump($this->_db);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
      } 
		catch (PDOException $e) {
		    die('Erreur de connexion à la base de données : '.$e->getMessage());
        }
    }

}

?>