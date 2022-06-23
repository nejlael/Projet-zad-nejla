<?php 
    include 'layout/header.php'; 
    require 'backend/config/db.php';
    require 'backend/models/category.class.php';
    require 'backend/services/category.service.php';
    
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
    <main class="catalog">
        <div class="categories-sidebar">
            <!------MENU DES CATEGORIES------>
            <h2>Catégories</h2>
            <ul>
                <li><a href="catalog.php">Tout afficher</a></li>
                <?php for ($i=0;$i<count($categories);$i++) { ?>
                <li><a href="catalog.php?category_id=<?= $categories[$i]->id() ?>"><?= $categories[$i]->name() ?></a></li>
                <?php } ?>
            </ul>
        </div>

        <div class="catalogue">
            <!-----------SI PAS DE PRODUITS DANS LA CATEGORIE--------->
                <?php if (count($products) == 0) { ?>
                    <div class="empty" >
                        <h2>Cette catégorie n'a aucun produit<br>
                            <a href="catalog.php">Tout afficher</a>
                        </h2>
                    </div>
                <?php } ?>
            <!-----------AFFICHAGE DES PRODUITS--------->
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
    </main>
    <?php include 'layout/footer.php'; ?>
    
