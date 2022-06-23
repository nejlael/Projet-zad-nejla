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
    <div class="banner">
        <img src="./images/bannerscript.png">
        
        <A> shop now </A>
    </div>

 <!---------------------MOST WANTED LINK--------------------------------->

 <div class="most-wanted">
        <div id="most-wanted-link">
            <span id="most">The most</span>
            <span id="wanted">WANTED</span>
            <a href="catalog.php">SHOP NOW</a>
        </div>
        <img src="./images/most-wanted.png" alt="">
    </div>


    <!---------------------NOUVEAUX PRODUITS--------------------------------->
    <div class="the-latest">
        <h2 class="title-nouveautes">The latest are the dopest !</h2>
        <div class="nouveautes">
            <?php for ($i=0;$i<count($products);$i++) { ?>
                <a class="card" href="product.php?id=<?= $products[$i]->id() ?>">
                    <img src="<?= $products[$i]->image() ?>" alt="produit" >
                    <h4>
                        <?= $products[$i]->name() ?>
                        <strong><?= $products[$i]->price() ?> &euro;</strong>
                    </h4>
                </a>
            <?php } ?>
        </div>
        </div>



    <!---------------------ARTICLE--------------->
    <div class="article">
        <img src="./images/article.png">
        <div class="text">
            <h2 class="title">Find your inner & outer peace</h2>
            <p>
            ipsum dolor sit amet consectetur adipisicing elit. Quidem eos nesciunt cupiditate! Saepe similique sed pariatur quae sit, atque cumque reiciendis? Molestias, dolorem. Minus odio dolore, omnis impedit odit ad. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi, vel et necessitatibus, iste cum omnis ad eligendi minus voluptatem, repellendus facere? Autem libero aspernatur placeat nostrum dolore recusandae rem veritatis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt quam minus in nobis reprehenderit rerum, eum ut nemo perspiciatis fugiat qui iusto deserunt quod quas. Sapiente, temporibus? Sunt, a nobis.
            </p>
        </div>
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