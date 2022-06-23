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
    $products = $productService->getLastProducts(4);

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
    <img src="<?= $product->image() ?>" alt="Image du produit" height="200px">
        <div class="description">
            <h1><?= $product->name() ?></h1>
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
            <h2><?= $product->price() ?>€</h2>
            <p>
            Description :
            <?= $product->description() ?></p>
            <form method="post">
                <input id="ajoutPanier" type="submit" name="addBasket" class="addBasket" value="Ajouter au panier">

                <input id="acheter" type="submit" name="buyProduct" class="buyProduct" value="Acheter maintenant">
                <input id="wish" type="submit" name="wishlist" class="wishlist" value="Ajouter à la wishlist">
            </form>
        </div>
</div>
<div class="the-latest">
            <h2 class="title-nouveautes">You may also like them !</h2>
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

<?php include 'layout/footer.php'; ?>