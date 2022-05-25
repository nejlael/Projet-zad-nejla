<?php 
require 'backend/config/db.php';
include 'layout/header.php'; 
if (!isLogged()) {
    header('location:login.php');
}
require 'backend/models/product.class.php';
require 'backend/models/category.class.php';

require 'backend/services/category.service.php';
require 'backend/services/product.service.php';

$array = [
    'nameError' => '',
    'catIdError' => '',
    'priceError' => '',
    'descriptionError' => '',
    'imageError' => '',
    'messageSuccess' => '',
    'messageError' => '',
    'isSuccess' => true
];
$productService = new ProductService();
$products = $productService->getProducts();

$categoryService = new CategoryService();
$categories = $categoryService->getCategories();
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {

    if(isset($_POST['submit'])){
        $name = verifyInput($_POST['name']);
      
        $price = verifyInput($_POST['price']);
        $description = verifyInput($_POST['description']);
        
        if (empty($name)) {
            $array['nameError'] = 'Le nom du produit est requis !';
            $array['isSuccess'] = false;
        }
        if (empty($_POST['category'])) {
            $array['catIdError'] = 'La catégorie est requise !';
            $array['isSuccess'] = false;
        }
        if (empty($price)) {
            $array['priceError'] = 'Le prix est requis !';
            $array['isSuccess'] = false;
        }
        if (empty($description)) {
            $array['descriptionError'] = 'La description est requise !';
            $array['isSuccess'] = false;
        }
        if(empty($_FILES["image"]["name"])) {
            $array['imageError'] = 'L\'image est requise !';
            $array['isSuccess'] = false;
        }else{
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(!in_array($fileType, $allowTypes)){ 
                $array['imageError'] = 'Les formats autorisés sont : JPG, JPEG, PNG, & GIF !';
                $array['isSuccess'] = false;
            }
        }

        
        

        if ($array['isSuccess']) {
            $catId = $_POST['category'];
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $product = new Product(null,$name, $catId,$price,$description, $imgContent);
            
            $isAdded = $productService->save($product);
            if($isAdded){
                $array['messageSuccess'] = 'Produit ajouté !';
                header("Refresh:0");

            }else{
                $array['messageError'] = 'Le produit existe déjà !';
            }
        }
    }
}


?>

<main class="admin">
<div class="grid-container">
        <div class="grid-item">
        <h3>Listes des produits</h3>
        
<table id="table">
  <tr>
    <th>ID#</th>
    <th>Nom du produit</th>
    <th>Catégorie</th>
    <th>Prix</th>
    <th>Description</th>
    <th>Image</th>
  </tr>
  <?php for ($i=0;$i<count($products);$i++) { ?>
  <tr>
    <td><?= $products[$i]->id()?></td>
    <td><?= $products[$i]->name()?></td>
    <td><?= $products[$i]->catId()?></td>
    <td><?= $products[$i]->price()?></td>
    <td><?= $products[$i]->description()?></td>
    <td><img src="data::image/jpg;charset=utf8;base64,<?= base64_encode($products[$i]->image()) ?>" /></td>
  </tr>
  <?php } ?>
 
</table>
        </div>
        <div class="grid-item">
        <h3>Ajouter un produit</h3>
            <form method="POST" enctype="multipart/form-data">
            <?php
             if($array['messageSuccess']){ ?>
            <div class="alert-success">
                <?= $array['messageSuccess'] ?>
            </div>
            <?php } ?>

            <?php
             if($array['messageError']){ ?>
            <div class="alert-error">
                <?= $array['messageError'] ?>
            </div>
            <?php } ?>
            <input type="text" name="name" placeholder="Titre du produit">
            <div><small class="errors"><?= $array['nameError'] ?></small></div>
            <br>
            <input type="text" name="price" placeholder="Prix du produit">
            <div><small class="errors"><?= $array['priceError'] ?></small></div>
            <br>
            <input type="text" name="description" placeholder="descripion">
            <div><small class="errors"><?= $array['descriptionError'] ?></small></div>
            <br>
            <select class="select-category" name="category">
            <option value="" disabled selected>Choisissez une catégorie</option>
            <?php for ($i=0;$i<count($categories);$i++) { ?>
                <option value="<?= $categories[$i]->id()?>"><?= $categories[$i]->name()?></option>
            <?php } ?>
            </select>
            <div><small class="errors"><?= $array['catIdError'] ?></small></div>
                        
            <br>
            <label style="color:white;">Selectionner une image :</label>
            <input type="file" name="image">
            <div><small class="errors"><?= $array['imageError'] ?></small></div>
            <br>
   
            <input class="submit" type="submit" name="submit" value="Ajouter">
            </form>
        </div>
    </div>
</main>

<?php include 'layout/footer.php'; ?>
