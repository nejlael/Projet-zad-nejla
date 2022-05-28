<?php
    session_start();
    
    require 'backend/helpers/helpers.php';
    
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EmeraldBoutique</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
            <!-------------------barre d'annonce----------------------->
            <div class="announcementBar">
                Bienvenue dans notre e-shop
            </div>
            <!-------------------barre de navigation----------------------->
            <div class="navigation">
                <a href="index.php" ><img  id="logo" src="./images/icones/logo_emerald.png" alt="logo" height="60px"></a>
                <img id="menu" src="./images/icones/menu.png" alt="menu" height="25px">
                <br><br>
            </div>
            <!-------------------POP UP MENU----------------------->
            <div class="popup">
                <ul id="menu">
                    <li><a href="catalog.php">Catalogue</a></li>
                    <?php if (isLogged()) { ?>
                    <li><a href="baskets.php">Voir mon panier</a></li>
                    <?php } ?>
                    <?php if(isAdmin()) {?>
                    <li><a href="categories.php">Les catégories</a></li>
                    <li><a href="products.php">Les produits</a></li>
                    <li><a href="users.php">Les utilisateurs</a></li>
                    <?php } ?>
                    <?php if (!isLogged()) { ?>
                    <li><a href="login.php">Connexion/Inscription</a></li>
                    <?php } ?>
                    <?php if (isLogged()) { ?>
                    <li><a href="logout.php">Se déconnecter</a></li>
                    <?php } ?>
                </ul>
                <form mehtod="POST">
                    <input type="text" name="" id="search">
                    <input type="submit" name="search" value="Rechercher">
                </form>
                <br>
            </div>
        </header>