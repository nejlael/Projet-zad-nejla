<?php
    require 'backend/config/db.php';
    include 'layout/header.php';
    if (!isAdmin()) {
        header('location:login.php');
    }
    require 'backend/models/product.class.php';
    require 'backend/models/category.class.php';
    require 'backend/models/basket.class.php';
    
    require 'backend/services/category.service.php';
    require 'backend/services/product.service.php';
    require 'backend/services/basket.service.php';
    $array = [
        'nameError' => '',
        'catIdError' => '',
        'priceError' => '',
        'descriptionError' => '',
        'imageError' => '',
        'messageSuccess' => '',
        'messageError' => '',
        'isSuccess' => true,
    ];
    $productService = new ProductService();
    $basketService = new BasketService();
    
    $productToEdit = null;
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        if ($_GET['action'] == 'delete') {
            if (!empty($_GET['id'])) {
                //Supprimer si le produit est dans le panier
                $basketService->deleteBasketsByProductId($_GET['id']);
                //Ensuite supprimer le produit
                $productService->deleteProduct($_GET['id']);
    
                header('location:products.php');
            }
        }
        if ($_GET['action'] == 'edit') {
            $productToEdit = $productService->getProduct($_GET['id']);
        }
    }
    
    
    $products = $productService->getProducts();
    $fileType = '';
    $categoryService = new CategoryService();
    $categories = $categoryService->getCategories();
    if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
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
        if (empty($_FILES['image']['name'])) {
            $array['imageError'] = 'L\'image est requise !';
            $array['isSuccess'] = false;
        } else {
            $fileName = basename($_FILES['image']['name']);
            $fileType = addslashes(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
            if (!in_array($fileType, $allowTypes)) {
                $array['imageError'] =
                    'Les formats autorisés sont : JPG, JPEG, PNG, & GIF !';
                $array['isSuccess'] = false;
            } elseif ($_FILES['image']['size'] > 2 * MB) {
                $array['imageError'] = 'Votre image est volumineuse. 2MB max.';
                $array['isSuccess'] = false;
            }
        }
    
        if (isset($_POST['editSubmit'])) {
            if ($array['isSuccess']) {
                $catId = $_POST['category'];
                $image = $_FILES['image']['tmp_name'];
                $data = file_get_contents($image);
    
                $base64 =
                    'data:image/' . $fileType . ';base64,' . base64_encode($data);
                $product = new Product(
                    $_GET['id'],
                    $name,
                    $catId,
                    $price,
                    $description,
                    $base64
                );
    
                $isEdit = $productService->editProduct($product);
                if ($isEdit) {
                    $array['messageSuccess'] = 'Produit edité !';
                    header('location:products.php');
                } else {
                    $array['messageError'] = 'Le produit existe déjà !';
                }
            }
        }
    
        if (isset($_POST['addSubmit'])) {
            if ($array['isSuccess']) {
                $catId = $_POST['category'];
                $image = $_FILES['image']['tmp_name'];
                $data = file_get_contents($image);
    
                $base64 =
                    'data:image/' . $fileType . ';base64,' . base64_encode($data);
                $product = new Product(
                    null,
                    $name,
                    $catId,
                    $price,
                    $description,
                    $base64
                );
    
                $isAdded = $productService->save($product);
                if ($isAdded) {
                    $array['messageSuccess'] = 'Produit ajouté !';
                    header('Refresh:0');
                } else {
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
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <?php for ($i = 0; $i < count($products); $i++) { ?>
                <tr>
                    <td><?= $products[$i]->id() ?></td>
                    <td><?= $products[$i]->name() ?></td>
                    <td><?= $categoryService
                        ->getCategory($products[$i]->catId())
                        ->name() ?></td>
                    <td><?= $products[$i]->price() ?> €</td>
                    <td><?= $products[$i]->description() ?></td>
                    <td><img src="<?= $products[
                        $i
                        ]->image() ?>" alt="Image produit" height="100px"/></td>
                    <td onclick="return confirm('Voulez-vous vraiment supprimer ce produit?')"><a href="products.php?action=delete&id=<?= $products[
                        $i
                        ]->id() ?>" class="deleteBtn">Supprimer</a></td>
                    <td><a href="products.php?action=edit&id=<?= $products[$i]->id() ?>" class="editBtn">Editer</a></td>
                    <td><a href="product.php?id=<?= $products[$i]->id() ?>" class="voirBtn">Voir</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="grid-item">
            <h3>Ajouter un produit</h3>
            <form method="POST" enctype="multipart/form-data">
                <?php if ($array['messageSuccess']) { ?>
                <div class="alert-success">
                    <?= $array['messageSuccess'] ?>
                </div>
                <?php } ?>
                <?php if ($array['messageError']) { ?>
                <div class="alert-error">
                    <?= $array['messageError'] ?>
                </div>
                <?php } ?>
                <input type="text" name="name" placeholder="Titre du produit" value="<?= $productToEdit != null ? $productToEdit->name(): '' ?>">
                <div><small class="errors"><?= $array['nameError'] ?></small></div>
                <br>
                <input type="text" name="price" placeholder="Prix du produit" value="<?= $productToEdit != null ? $productToEdit->price(): '' ?>">
                <div><small class="errors"><?= $array['priceError'] ?></small></div>
                <br>
                <textarea name="description" id="description" cols="45" rows="5" placeholder="Une description du produit"><?= $productToEdit != null ? $productToEdit->description(): '' ?></textarea>
                <div><small class="errors"><?= $array[
                    'descriptionError'
                    ] ?></small></div>
                <br>
                <select class="select-category" name="category">
                    <option value="" disabled selected>Choisissez une catégorie</option>
                    <?php for ($i = 0; $i < count($categories); $i++) { ?>
                    <option <?= $productToEdit != null && $productToEdit->catId() == $categories[$i]->id() ? 'selected': '' ?> value="<?= $categories[$i]->id() ?>"><?= $categories[$i]->name() ?></option>
                    <?php } ?>
                </select>
                <div><small class="errors"><?= $array['catIdError'] ?></small></div>
                <br>
                <label style="color:white;">Selectionner une image :</label>
                <input type="file" name="image">
                <div><small class="errors"><?= $array['imageError'] ?></small></div>
                <br>
                <?php if (isset($_GET['action']) && $_GET['action'] == 'edit') { ?>
                <input class="submit" type="submit" name="editSubmit" value="Editer">
                <?php } else { ?>
                <input class="submit" type="submit" name="addSubmit" value="Ajouter">
                <?php } ?>
            </form>
        </div>
    </div>
</main>
<?php include 'layout/footer.php'; ?>