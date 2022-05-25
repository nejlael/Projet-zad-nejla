<?php 

require 'backend/config/db.php';
include 'layout/header.php'; 

if (!isLogged()) {
    header('location:login.php');
}
require 'backend/models/category.class.php';
require 'backend/services/category.service.php';

$array = [
    'nameError' => '',
    'messageSuccess' => '',
    'messageError' => '',
    'isSuccess' => true
];
$categoryService = new CategoryService();
$categories = $categoryService->getCategories();


if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {

    if(isset($_POST['submit'])){
        $name = verifyInput($_POST['name']);
        if (empty($name)) {
            $array['nameError'] = 'Le nom de la catégorie est requis !';
            $array['isSuccess'] = false;
        }
        if ($array['isSuccess']) {
            $category = new Category(
                null,
                $name,
            );
            
            $isAdded = $categoryService->save($category);
            if($isAdded){
                $array['messageSuccess'] = 'Catégorie ajouté !';
                header("Refresh:0");

            }else{
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
  </tr>
  <?php for ($i=0;$i<count($categories);$i++) { ?>
  <tr>
    <td><?= $categories[$i]->id()?></td>
    <td><?= $categories[$i]->name()?></td>
  </tr>
  <?php } ?>
</table>
        </div>
        <div class="grid-item">
        <h3>Ajouter une catégorie</h3>
            <form action="" method="POST">
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
            <input type="text" name="name" placeholder="Nom de la catégorie">
            <div><small class="errors"><?= $array['nameError'] ?></small></div>
            <br>
            <input class="submit" type="submit" name="submit" value="Ajouter">
            </form>
        </div>
    </div>
    
</main>

<?php include 'layout/footer.php'; ?>

