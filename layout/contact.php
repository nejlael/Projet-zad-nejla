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