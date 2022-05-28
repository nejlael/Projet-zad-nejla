<?php
    include 'layout/header.php';
    require 'backend/config/db.php';
    require 'backend/models/product.class.php';
    require 'backend/services/product.service.php';
    
    $productService = new ProductService();
    $products = $productService->getLastProducts(4);
     ?>
<main class="home">
    <!---------------------BANNER IMAGE--------------------------------->
    <img id="banner" src="./images/banner.png">
    <!---------------------NOUVEAUX PRODUITS--------------------------------->
    <div class="catalogue">
        <h2>Nouveautés :</h2>
        <?php for ($i=0;$i<count($products);$i++) { ?>
        <a href="product.php?id=<?= $products[$i]->id() ?>">
            <div class="card">
                <img src="<?= $products[$i]->image() ?>" alt="produit" >
                <h4><?= $products[$i]->name() ?> <strong><?= $products[$i]->price() ?> €</strong></h4>
            </div>
        </a>
        <?php } ?>
    </div>
    <!---------------------ARTICLE--------------------------------->
    <div class="article">
        <p> <strong>Aussi bien dehors que dedans</strong><br><br>ipsum dolor sit amet consectetur adipisicing elit. Quidem eos nesciunt cupiditate! Saepe similique sed pariatur quae sit, atque cumque reiciendis? Molestias, dolorem. Minus odio dolore, omnis impedit odit ad. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi, vel et necessitatibus, iste cum omnis ad eligendi minus voluptatem, repellendus facere? Autem libero aspernatur placeat nostrum dolore recusandae rem veritatis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt quam minus in nobis reprehenderit rerum, eum ut nemo perspiciatis fugiat qui iusto deserunt quod quas. Sapiente, temporibus? Sunt, a nobis.</p>
    </div>
    <!---------------------INFO_3COLS--------------------------------->
    <div class="info-cols">
        <div class="info">
            <img src="./images/icones/icones_cadeau.png" alt="cadeau">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis sint corrupti cumque tenetur quod, ab voluptas porro natus officia, aspernatur mollitia adipisci nesciunt beatae totam nisi tempora voluptatum, assumenda doloribus.</p>
        </div>
        <div class="info">
            <img src="./images/icones/icones_Livraison.png" alt="livraison">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis sint corrupti cumque tenetur quod, ab voluptas porro natus officia, aspernatur mollitia adipisci nesciunt beatae totam nisi tempora voluptatum, assumenda doloribus.</p>
        </div>
        <div class="info">
            <img src="./images/icones/icones_SAV.png" alt="SAV">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis sint corrupti cumque tenetur quod, ab voluptas porro natus officia, aspernatur mollitia adipisci nesciunt beatae totam nisi tempora voluptatum, assumenda doloribus.</p>
        </div>
    </div>
</main>
<?php include 'layout/footer.php'; ?>