<?php
    require 'backend/config/db.php';
    include 'layout/header.php';
    
    if (!isLogged()) {
        header('location:login.php');
    }
    require 'backend/models/product.class.php';
    require 'backend/services/product.service.php';
    require 'backend/models/basket.class.php';
    require 'backend/services/basket.service.php';
    
    $basketService = new BasketService();
    $productService = new ProductService();
    if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
        if (isset($_POST['removeBasket'])) {
            $productId = $_POST['productId'];
            $basketService->removeProductFromBaskets($_SESSION['user'], $productId);
        }
    
    
    }
    
    $baskets = $basketService->getBasketsOfUser($_SESSION['user']);
    $map = function($v) {return $v->productId();};
    $basketsMap = array_count_values(array_map($map, $baskets));
    $sumBaskets = $basketService->getSumBasketsOfUser($_SESSION['user']);
    
    ?>
<main class="panier">
    <!----------------------SI UN ARTICLE DANS LE PANIER CACHER CETTE DIV----------------------------->
    <?php if (count($baskets) == 0) { ?>
    <div class="empty" >
        <h2>Votre panier est vide<br>
            <a href="catalog.php">Continuer mes achats</a>
        </h2>
    </div>
    <?php } ?>
    <div class="full-panier">
        <?php foreach ($basketsMap as $key => $value) { 
            $product = $productService->getProduct($key); ?>
        <a class="card-panier" href="product.php?id=<?= $product->id() ?>">
                <img src="<?= $product->image() ?>" alt="produit" >
                <h4><?= $product->name() ?><br><br><strong><?= $product->price() ?> €</strong></h4>
                <h4><?= $value ?>x article(s)</h4>
                <form class="retirer-panier-form"  method="post">
                    <input id="productId" name="productId" type="hidden" value="<?= $product->id()  ?>">
                    <input onclick="return confirm('Voulez-vous vraiment supprimer ces articles?')" class="retirer-panier" type="submit" name="removeBasket" value="X">
                </form>
        </a>
        <?php
            } ?>
    </div>
    <?php if (count($baskets) != 0) { ?>
        <form class="total-panier" method="post">
            <p>
                Prix total des produits : <span><?= $sumBaskets ?> €</span>
            </p>
            <input class="checkout" type="submit" value="Acheter les produits">
        </form>
    <?php } ?>
</main>
<?php include 'layout/footer.php'; ?>