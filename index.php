<?php
    include 'layout/header.php';
    require 'backend/config/db.php';
    require 'backend/models/product.class.php';
    require 'backend/services/product.service.php';

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
    

    
    $productService = new ProductService();
    $products = $productService->getLastProducts(4);
     ?>
<main class="home">
    <!---------------------BANNER IMAGE--------------------------------->
    <div class="banner">
        <img src="./images/bannerscript.png">
        
        <A href="catalog.php"> shop now </A>
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
<div class="article kids">
        <div class="text">
            <h2 class="title">A classy decoration.<br>For kids too !</h2>
            <p>
            Le saviez-vous ? de nombreuses études ont démontré que les couleurs avaient un impact sur les émotions et que les enfants y sont globalement plus sensibles!<br>
            Nous avons les couleur neutres et naturelles qui développe la confiance et la sécurité, l'enfant en à besoin pour se sentir rassuré et serein. Les couleurs qui aideront à atteindre cet etat d'esprit sont le gris, les tons sienne ocre et marron , le blanc et le noir.<br>
            Ensuite , il y a les couleur qui favorisent la joie et l'optimisme. Le jaune , le vert et le bleu-vert ont un effet positif sur la concentration dans l'apprentissage au delà de la bonne humeur!<br>
            Pour reduire le stress, l'anxieté et les inhibitions, les tons bleu froid et de violet vifs permettent de creer une atmosphère paisible, propice au lâcher prise. Le bleu apporte calme de douceur et le violet permet de s'ouvrir à la créativité.<br>
            Le rouge, couleur flamboyante, très dynamique, elle ne passe pas inaperçue et est a utilisé avec prudence car peut générer des émotiosn fortes de colères, voir d'agressivité. Bien employée elle peut être un atout dans un espace dédié au jeu.
            </p>
        </div>
        <img src="./images/kids.png">
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