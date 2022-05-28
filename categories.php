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
        'messageSuccess' => '',
        'messageError' => '',
        'isSuccess' => true,
    ];
    $productService = new ProductService();
    $categoryService = new CategoryService();
    $categoryToEdit = null;
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        if ($_GET['action'] == 'delete') {
            if (!empty($_GET['id'])) {
                //Supprimer les produits liés à la catégorie
                $productService->deleteProductByCategoryId($_GET['id']);
                //Ensuite supprimer la catégorie
                $categoryService->deleteCategory($_GET['id']);
    
                header('location:categories.php');
            }
        }
        if ($_GET['action'] == 'edit') {
            $categoryToEdit = $categoryService->getCategory($_GET['id']);
        }
    }
    $categories = $categoryService->getCategories();
    
    if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
        $name = verifyInput($_POST['name']);
        //Cette instruction est commune selon si on souhaite ajouter ou editer une catégorie
        if (empty($name)) {
            $array['nameError'] = 'Le nom de la catégorie est requis !';
            $array['isSuccess'] = false;
        }
    
        if (isset($_POST['editSubmit'])) {
            if ($array['isSuccess']) {
                $category = new Category($_GET['id'], $name);
    
                $isEdit= $categoryService->editCategory($category);
                if ($isEdit) {
                    $array['messageSuccess'] = 'Catégorie éditée !';
                    header('location:categories.php');
                } else {
                    $array['messageError'] = 'La catégorie existe déjà !';
                }
            }
        }
    
        if (isset($_POST['addSubmit'])) {
            if ($array['isSuccess']) {
                $category = new Category(null, $name);
    
                $isAdded = $categoryService->save($category);
                if ($isAdded) {
                    $array['messageSuccess'] = 'Catégorie ajouté !';
                    header('Refresh:0');
                } else {
                    $array['messageError'] = 'La catégorie existe déjà !';
                }
            }
        }
    }
    ?>
<main class="admin">
    <div class="grid-container">
        <div class="grid-item">
            <h3>Listes des catégories</h3>
            <table id="table">
                <tr>
                    <th>ID#</th>
                    <th>Nom de la catégorie</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php for ($i = 0; $i < count($categories); $i++) { ?>
                <tr>
                    <td><?= $categories[$i]->id() ?></td>
                    <td><?= $categories[$i]->name() ?></td>
                    <td onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')"><a href="categories.php?action=delete&id=<?= $categories[
                        $i
                        ]->id() ?>" class="deleteBtn">Supprimer</a></td>
                    <td><a href="categories.php?action=edit&id=<?= $categories[$i]->id() ?>" class="editBtn">Editer</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="grid-item">
            <h3>Ajouter une catégorie</h3>
            <form action="" method="POST">
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
                <input type="text" name="name" placeholder="Nom de la catégorie" value="<?= $categoryToEdit != null ? $categoryToEdit->name(): '' ?>">
                <div><small class="errors"><?= $array['nameError'] ?></small></div>
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