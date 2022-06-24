<?php

require 'backend/config/db.php';
    include 'layout/header.php';
    require 'backend/models/product.class.php';
    require 'backend/services/product.service.php';
    require 'backend/models/basket.class.php';
    require 'backend/services/basket.service.php';

    require 'backend/models/category.class.php';
    require 'backend/services/category.service.php';
    
    $categoryService = new CategoryService();
    $categories = $categoryService->getCategories();
    

    if (!isLogged()) {
        header('location:login.php');
    }
?>
<main class="admin">
    <ul class="admin-links">
        <li><a href="users.php">Liste des utilisateurs</a></li>
        <li><a href="products.php"> liste des produits</a></li>
        <li><a href="categories.php">liste des catégories</a></li>
        <li><a href="messages.php">messages reçcus</a></li>
    </ul>
</main>
<footer class="admin-footer">
<div class="footer-info">
    <ul><!--PLAN DU SITE-->
        <li><a href="index.php" >Home</a></li>
        <li><a href="catalog.php">Catalogue</a></li>
                <?php for ($i=0;$i<count($categories);$i++) { ?>
                <li><a href="catalog.php?category_id=<?= $categories[$i]->id() ?>"><?= $categories[$i]->name() ?></a></li>
                <?php } ?>
    </ul>
    <ul><!--LIENS LEGAUX-->
        <li>Jobs et stages</li>
        <li>Mentions légales</li>
        <li>Conditions de vente</li>
        <li>expeditions et Livraison</li>
    </ul>
    <ul><!--RESEAUX SOCIAUX-->
        <li>Facebook</li>
        <li>Instagram</li>
        <li>Tiktok</li>
        <li>Twitter</li>
    </ul>
</div>
<ul class="payments-method">
    <li><img src="./images/icones/bancontact.png"></li>
    <li><img src="./images/icones/klarna.png"></li>
    <li><img src="./images/icones/paypal.png"></li>
    <li><img src="./images/icones/visa.png"></li>
</ul>
<p>ZAD | Emerald Boutique | Nejla El Morabet</p>

</footer>
<script src="./js/jquery-3.6.0.js"></script>
<script src="./js/script.js"></script>
</body>
</html>