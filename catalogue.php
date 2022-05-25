<?php 

include 'layout/header.php'; 
require 'backend/config/db.php';
require 'backend/models/product.class.php';
require 'backend/services/product.service.php';


$productService = new ProductService();
$products = $productService->getProducts();


?>
    
    
    <main class="produits">
        
            <ul class="categories">
                <li>scandinave</li>
                <li>industriel</li>
                <li>minimaliste</li>
                <li>ethniques</li>
            </ul>

        <div class="catalogue">
        <?php for ($i=0;$i<count($products);$i++) { ?>
            <a href="product.php">
            <div class="card">
                <img src="./images/produits/produit1.jpg" alt="produit" height="200px">
                <h4><?= $products[$i]->name() ?> <strong><?= $products[$i]->price() ?> €</strong></h4>
            </div>
            </a>
        <?php } ?>
        </div>

    </main>
    
<?php include 'layout/footer.php'; ?>
