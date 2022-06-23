<?php 
    require 'backend/models/category.class.php';
    require 'backend/services/category.service.php';
    
    $productService = new ProductService();
    
    $categoryService = new CategoryService();
    $categories = $categoryService->getCategories();
    
    
    if(empty($_GET['category_id'])){
        $products = $productService->getProducts();
    }else{
        $products = $productService->getProductsByCategory($_GET['category_id']);
    }
    
    ?>
<footer>
<span class="get-in-touch">
    <p>Let's get <br><strong>in touch</strong></p>
    <form class="contact">
        <input type="email" name="email-contact" placeholder="Entrez votre adresse e-mail">

        <input type="text" name="firstname-contact" placeholder="Entrez votre prénom">
        <label for="message">Ecrivez votre message...</label>
        <textarea id="message" name="message" rows="5">
        </textarea>

        <input id="submit-contact" type="submit" name="submit-contact" value="Envoyer ! ">
    </form>
</span>
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
<p>ZAD | Emerald Boutique | Nejla El Morabet</p>
</footer>
<script src="./js/jquery-3.6.0.js"></script>
<script src="./js/script.js"></script>
</body>
</html>