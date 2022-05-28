<?php
    require 'backend/config/db.php';
    include 'layout/header.php';
    require 'backend/models/product.class.php';
    require 'backend/services/product.service.php';
    require 'backend/models/basket.class.php';
    require 'backend/services/basket.service.php';
    if (!isLogged()) {
        header('location:login.php');
    }
    $productId = $_GET['id'];
    if (empty($productId)) {
        header('location:products.php');
    }
    $productService = new ProductService();
    $product = $productService->getProduct($productId);
    $array = [
        'messageSuccess' => '',
        'messageError' => '',
        'isBasket' => false
    ];
    if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
        if (isset($_POST['addBasket'])) {
            $array['isBasket'] = true;
            $basketService = new BasketService();
            $isAdded = $basketService->save($_SESSION['user'], $productId);
            if($isAdded){
                $array['messageSuccess'] = 'Le produit a été ajouté au panier';
            }else{
                $array['messageError'] = 'Le produit n\'a pas été ajouté au panier';
            }
        }
    }
    ?>
<div class="produit">
    <?php
        if($array['isBasket'] && $array['messageSuccess']){ ?>
    <div class="alert-success">
        <?= $array['messageSuccess'] ?>
    </div>
    <?php } ?>
    <?php
        if($array['isBasket'] && $array['messageError']){ ?>
    <div class="alert-error">
        <?= $array['messageError'] ?>
    </div>
    <?php } ?>
    <br/>
    <img src="<?= $product->image() ?>" alt="Image du produit" height="200px">
    <div class="description">
        <h1><?= $product->name() ?></h1>
        <h2><?= $product->price() ?>€</h2>
        <p>
        <div>Description :</div>
        <?= $product->description() ?></p>
        <form method="post">
            <input id="ajoutPanier" type="submit" name="addBasket" class="addBasket" value="Ajouter au panier">
            <input id="acheter" type="submit" name="buyProduct" class="buyProduct" value="Acheter maintenant">
        </form>
    </div>
</div>
</div>
<br>
<?php include 'layout/footer.php'; ?>