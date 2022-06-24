
<footer>
<span class="get-in-touch">
    <p>Let's get <br><strong>in touch</strong></p>
    <form class="contact">
        <input type="email" name="messageEmail" placeholder="Entrez votre adresse e-mail">

        <input type="text" name="messageFirstname" placeholder="Entrez votre prénom">
        <label for="message">Ecrivez votre message...</label>
        <textarea id="message" name="message" rows="5">
        </textarea>

        <input id="submit-contact" type="submit" name="submit-contact" value="Envoyer ! ">
    </form>
</span>
<div class="footer-info">
    <ul><!--PLAN DU SITE-->
        <li><a href="index.php" >Home</a></li>
        <li><a href="catalog.php">Catalogue</a></li>
                <?php for ($i=0;$i<count($categories);$i++) { ?>
                <li><a href="catalog.php?category_id=<?= $categories[$i]->id() ?>"><?= $categories[$i]->name() ?></a></li>
                <?php } ?>
    </ul>
    <ul><!--LIENS LEGAUX-->
        <li>Jobs et stages</li>
        <li>Mentions légales</li>
        <li>Conditions de vente</li>
        <li>expeditions et Livraison</li>
    </ul>
    <ul><!--RESEAUX SOCIAUX-->
        <li>Facebook</li>
        <li>Instagram</li>
        <li>Tiktok</li>
        <li>Twitter</li>
    </ul>
</div>
<ul class="payments-method">
    <li><img src="./images/icones/bancontact.png"></li>
    <li><img src="./images/icones/klarna.png"></li>
    <li><img src="./images/icones/paypal.png"></li>
    <li><img src="./images/icones/visa.png"></li>
</ul>
<p>ZAD | Emerald Boutique | Nejla El Morabet</p>

</footer>
<script src="./js/jquery-3.6.0.js"></script>
<script src="./js/script.js"></script>
</body>
</html>