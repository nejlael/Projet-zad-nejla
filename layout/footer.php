<?php 

$array = [
    'firstname' => '',
    'lastname' => '',
    'email' => '',
    'message' => '',
    'firstnameError' => '',
    'lastnameError' => '',
    'emailError' => '',
    'messageError' => '',
    'isSuccess' => false,
    'messageSuccess' => ''
];

$emailTo = 'elmorabet.n@hotmail.com';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['contactSubmit'])){
        $array['firstname'] = verifyInput($_POST['firstname']);
        $array['lastname'] = verifyInput($_POST['lastname']);
        $array['email'] = verifyInput($_POST['email']);
        $array['message'] = verifyInput($_POST['message']);
        $array['isSuccess'] = true;

        if(empty($array['firstname'])){
            $array['firstnameError'] = 'Votre prénom est requis !';
            $array['isSuccess'] = false;
        }

        if(empty($array['lastname'])){
            $array['lastnameError'] = 'Votre nom est requis !';
            $array['isSuccess'] = false;
        }

        if(empty($array['email'])){
            $array['emailError'] = 'Votre adresse email est requise !';
            $array['isSuccess'] = false;
        }
        if(!isEmail($array['email'])){
            $array['emailError'] = 'Votre adresse email n\'est pas valide !';
            $array['isSuccess'] = false;
        }
        if(empty($array['message'])){
            $array['messageError'] = 'Votre message est requis !';
            $array['isSuccess'] = false;
        }

        if($array['isSuccess'] == true){
            $headers = "From: {$array['firstname']} {$array['lastname']} <{$array['email']}>\r\nReply-To:{$array['email']}";
            mail($emailTo, 'Emerald Boutique', $array['message'], $headers);
            $array['messageSuccess'] = 'Votre message a bien été envoyé !';
        }
    }
}

?>
<footer>
    <form class="contact"  method="post">
        <?php if ($array['messageSuccess']) { ?>
                <div class="alert-success">
                    <?= $array['messageSuccess'] ?>
                </div>
                <?php } ?>
        <h3>Contactez nous</h3>
        <input type="text" name="firstname" placeholder="Entrez votre prénom">
        <div><small class="errors"><?= $array['firstnameError'] ?></small></div>
        <br>
        <input type="text" name="lastname" placeholder="Entrez votre nom">
        <div><small class="errors"><?= $array['lastnameError'] ?></small></div>
        <br>
        <input type="email" name="email" placeholder="Entrez votre adresse e-mail">
        <div><small class="errors"><?= $array['emailError'] ?></small></div>
        <br>
        <label for="message">Ecrivez votre message</label>
        <br>
        <textarea name="message" cols="30" rows="10"></textarea>
        <div><small class="errors"><?= $array['messageError'] ?></small></div>
        <br>
        <input type="submit" name="contactSubmit" class="submit" value="Envoyer">
    </form>
    <div class="socialmedia">
        <h3>
        Suivez nous sur les reseaux !</h1>
        <img src="./images/icones/instagram.png" alt="IG" height="35px">
        <img src="./images/icones/facebook.png" alt="FB" height="35px">
        <img src="./images/icones/twitter.png" alt="TW" height="35px">
        <img src="./images/icones/tiktok.png" alt="TT" height="35px">
    </div>
    <div class="payements">
        <h3>
        Nous acceptons :</h1>
        <img src="./images/icones/bancontact.png" alt="bancontact" height="75px">
        <img src="./images/icones/paypal.png" alt="paypal" height="75px">
        <img src="./images/icones/klarna.png" alt="klarna" height="75px">
        <img src="./images/icones/visa.png" alt="visa" height="75px">
    </div>
</footer>
<script src="./js/jquery-3.6.0.js"></script>
<script src="./js/script.js"></script>
</body>
</html>