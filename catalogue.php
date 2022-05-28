<?php 
include 'layout/header.php'; 
require 'backend/config/db.php';
require 'backend/models/product.class.php';
require 'backend/services/product.service.php';

require 'backend/models/product.class.php';
require 'backend/services/product.service.php';


$productService = new ProductService();

$categoryService = new CategoryService();
$categories = $categoryService->getCategories();

    
if(empty($_GET['category_id'])){
    $products = $productService->getProducts();
}else{
    $products = $productService->getProductsByCategory($_GET['category_id']);
}


?>
    <main>
    <div class="sidebar">
        <a href="index.php" ><img  id="logo" src="./images/icones/logo_emerald.png" alt="logo" height="60px"></a>
        <h2>Catégories</h2>
        <p><a href="catalog.php">Tout afficher</a></p>
        <?php for ($i=0;$i<count($categories);$i++) { ?>
        <p><a href="catalog.php?category_id=<?= $categories[$i]->id() ?>"><?= $categories[$i]->name() ?></a></p>
        <?php } ?>
    </div>
    <div class="catalogue body-text">
        <?php if (count($products) == 0) { ?>
        <div class="empty" >
            <h2>Cette catégorie n'a aucun produit<br>
                <a href="catalog.php">Tout afficher</a>
            </h2>
        </div>
        <?php } ?>
        <?php for ($i=0;$i<count($products);$i++) { ?>
        <a href="product.php?id=<?= $products[$i]->id() ?>">
            <div class="card">
                <img src="<?= $products[$i]->image() ?>" alt="produit" >
                <h4><?= $products[$i]->name() ?> <strong><?= $products[$i]->price() ?> €</strong></h4>
            </div>
        </a>
        <?php } ?>
    </div>
</main>
    
<?php include 'layout/footer.php'; ?>
