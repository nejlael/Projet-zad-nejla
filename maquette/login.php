<?php include './layout/header.php' ?>

<main class="login">

        <div class="switch">
                <button id="btnconnexion">CONNEXION</button>
                <button id="btninscription">INSCRIPTION</button>
            
            <form id="inscription" action="" method="post">
                <input type="text" name="firstname" placeholder="Entrez votre prénom">
                <br>
                <input type="text" name="lastname" placeholder="Entrez votre nom">
                <br>
                <input type="email" name="email" placeholder="Entrez votre adresse e-mail">
                <br>
                <input type="password" name="password" placeholder="choisissez un mot de passe">
                <br>
                <input type="submit" name="submitInscription" class="submit" value="Envoyer">
            </form>

            <form id="connexion" action="" method="post">
                <input type="email" name="email" placeholder="Entrez votre adresse e-mail">
                <br>
                <input type="password" name="password" placeholder="choisissez un mot de passe">
                <br>
                <input type="submit" name="submitConnexion" class="submit" value="Envoyer">
            </form>
        </div>

        <div class="info-cols">
            <div class="info">
                <img src="./images/icones/icones_cadeau.png" alt="cadeau">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis sint corrupti cumque tenetur quod, ab voluptas porro natus officia, aspernatur mollitia adipisci nesciunt beatae totam nisi tempora voluptatum, assumenda doloribus.</p>
            </div>
            <div class="info">
                <img src="./images/icones/icones_Livraison.png" alt="livraison">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis sint corrupti cumque tenetur quod, ab voluptas porro natus officia, aspernatur mollitia adipisci nesciunt beatae totam nisi tempora voluptatum, assumenda doloribus.</p>
            </div>
            <div class="info">
                <img src="./images/icones/icones_SAV.png" alt="SAV">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis sint corrupti cumque tenetur quod, ab voluptas porro natus officia, aspernatur mollitia adipisci nesciunt beatae totam nisi tempora voluptatum, assumenda doloribus.</p>
            </div>
        </div>

    </main>    

<?php include './layout/footer.php' ?>