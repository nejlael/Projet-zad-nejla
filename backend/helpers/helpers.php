<?php

function isEmail($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function verifyInput($var)
{
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}


function isLogged(){
    return isset($_SESSION["user"]) && !empty($_SESSION["user"]);
}

function isAdmin(){
    if(isLogged()){
        return $_SESSION["isAdmin"];
    }
    return false;
}


?>