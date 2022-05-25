<?php
// var_dump(new pdo("mysql:host=localhost;dbname=.......;charset=utf8","root", ""));die;

try{
    $connexion = new pdo("mysql:host=localhost;dbname=.........;charset=utf8","root", "");

    $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

} catch (Exception $e) {
    $e->getmessage();
}

?>