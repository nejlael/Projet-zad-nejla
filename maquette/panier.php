<?php include './layout/header.php' ?>

<main class="panier">

    <!----------------------SI UN ARTICLE DANS LE PANIER CACHER CETTE DIV----------------------------->

    <div class="empty">
        <h2>Votre panier est vide<br>
        <a href="catalogue.php">Continuer mes achats</a>
        </h2>
    </div>

    <div class="full">
        <!----------------------SELECT ARTICLES----------------------------->
    </div>

    <div class="catalogue">
        <h2>Nouveautés</h2>

        <a href="produit.php">
            <div class="card">
                <img src="./images/produits/produit1.jpg" alt="produit">
                <h4>Miroir de table <strong>19,99€</strong></h4>
            </div>
        </a>

        <a href="produit.php">
            <div class="card">
                <img src="./images/produits/produit2.jpg" alt="produit">
                <h4>Miroir de table <strong>19,99€</strong></h4>
            </div>
        </a>

        <a href="produit.php">
            <div class="card">
                <img src="./images/produits/produit3.jpg" alt="produit">
                <h4>Miroir de table <strong>19,99€</strong></h4>
            </div>
        </a>

        <a href="produit.php">
            <div class="card">
                <img src="./images/produits/produit4.jpg" alt="produit">
                <h4>Miroir de table <strong>19,99€</strong></h4>
            </div>
        </a>

    </div>
</main>

<?php include './layout/footer.php' ?>