<?php
    require 'backend/config/db.php';
    include 'layout/header.php'; 
    if (isLogged()) {
        header('location:catalog.php');
    }
    require 'backend/models/user.class.php';
    require 'backend/services/user.service.php';
    
    require 'backend/models/category.class.php';
    require 'backend/services/category.service.php';
    
    $categoryService = new CategoryService();
    $categories = $categoryService->getCategories();
    
   
    
    
    
    $array = [
        'firstnameError' => '',
        'lastnameError' => '',
        'emailError' => '',
        'passwordError' => '',
        'messageSuccess' => '',
        'messageError' => '',
        'isSuccess' => true,
        'isLogin' => false,
        'isRegister' => false
    ];
    
    if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
    
        if(isset($_POST['submitLogin'])){
            $array['isLogin'] = true;
            if(isset($_POST['submitLogin'])){
                $email = verifyInput($_POST['email']);
                $password = verifyInput($_POST['password']);
                if (empty($email)) {
                    $array['emailError'] = 'Votre email est requis !';
                    $array['isSuccess'] = false;
                }
                if (!isEmail($email)) {
                    $array['emailError'] = 'Votre email n\'est pas correcte !';
                    $array['isSuccess'] = false;
                }
                if (empty($password)) {
                    $array['passwordError'] = 'Votre mot de passe est requis !';
                    $array['isSuccess'] = false;
                }
                if ($array['isSuccess']) {
                    $userService = new UserService();
                    $user = $userService->login($email, $password);
                    if($user){
                        $_SESSION["user"] = $user->id();
                        $_SESSION["isAdmin"] = $user->isAdmin();
                        $array['messageSuccess'] = 'Connexion réussie !';
                        header('location:catalog.php');
                    }else{
                        $array['messageError'] = 'Utilisateur/Mot de passe incorrecte !';
                    }
                }
            }
        }
    
        if(isset($_POST['submitRegister'])){
            $firstname = verifyInput($_POST['firstname']);
            $lastname = verifyInput($_POST['lastname']);
            $email = verifyInput($_POST['email']);
            $password = verifyInput($_POST['password']);
    
            $array['isRegister'] = true;
            
            if (empty($firstname)) {
                $array['firstnameError'] = 'Votre prénom est requis !';
                $array['isSuccess'] = false;
            }
            if (empty($lastname)) {
                $array['lastnameError'] = 'Votre nom est requis !';
                $array['isSuccess'] = false;
            }
            if (empty($email)) {
                $array['emailError'] = 'Votre email est requis !';
                $array['isSuccess'] = false;
            }
            if (!isEmail($email)) {
                $array['emailError'] = 'Votre email n\'est pas correcte !';
                $array['isSuccess'] = false;
            }
            if (empty($password)) {
                $array['passwordError'] = 'Votre mot de passe est requis !';
                $array['isSuccess'] = false;
            }
        
            if ($array['isSuccess']) {
    
                //Je crée une instance/un objet de type User
                $user = new User(
                    null,
                    $firstname,
                    $lastname,
                    $email,
                    $password
                );
                //Je crée une instance/un objet de type UserService
                $userService = new UserService();
                
                $isAdded = $userService->register($user);
                if($isAdded){
                    $array['messageSuccess'] = 'Inscription réussie !';
                }else{
                    $array['messageError'] = 'Utilisateur existant !';
                }
            }
        }
        
    }
    
    ?>
<main class="login">
    <div class="switch">
        <Div class="buttons-connexion">
            <button id="btninscription">Inscription</button>
            <button id="btnconnexion">Connexion</button>
        </Div>
        <div class="connexion">
            <form method="post">
                <?php
                    if($array['isLogin'] && $array['messageSuccess']){ ?>
                <div class="alert-success">
                    <?= $array['messageSuccess'] ?>
                </div>
                <?php } ?>
                <?php
                    if($array['isLogin'] && $array['messageError']){ ?>
                <div class="alert-error">
                    <?= $array['messageError'] ?>
                </div>
                <?php } ?>
                <input type="email" name="email" placeholder="Entrez votre adresse e-mail">
                <div><small class="errors"><?= $array['isLogin'] ? $array['emailError']: '' ?></small></div>
                <br>
                <input type="password" name="password" placeholder="Entrez votre mot de passe">
                <div><small class="errors"><?= $array['isLogin'] ? $array['passwordError'] : ''?></small></div>
                <br>
                <input id="submit-connexion" type="submit" name="submitLogin" class="submit" value="Se connecter">
            </form>
        </div>
        
        <div class="inscription">
            
            <form method="post" >
                <?php
                    if($array['isRegister'] && $array['messageSuccess']){ ?>
                <div class="alert-success">
                    <?= $array['messageSuccess'] ?>
                </div>
                <?php } ?>
                <?php
                    if($array['isRegister'] && $array['messageError']){ ?>
                <div class="alert-error">
                    <?= $array['messageError'] ?>
                </div>
                <?php } ?>
                <input type="text" name="firstname" placeholder="Entrez votre prénom" >
                <div><small class="errors"><?= $array['isRegister'] ? $array['firstnameError'] : '' ?></small></div>
                <br>
                <input type="text" name="lastname" placeholder="Entrez votre nom">
                <div><small class="errors"><?= $array['isRegister'] ? $array['lastnameError'] : ''?></small></div>
                <br>
                <input type="email" name="email" placeholder="Entrez votre adresse e-mail">
                <div><small class="errors"><?= $array['isRegister'] ? $array['emailError']: '' ?></small></div>
                <br>
                <input type="password" name="password" placeholder="choisissez un mot de passe">
                <div><small class="errors"><?= $array['isRegister'] ? $array['passwordError'] : ''?></small></div>
                <br>
                <input id="submit-inscription"  type="submit" name="submitRegister" class="submit" value="S'inscrire">
            </form>
        </div>
    </div>
    <div class="info-cols">
        <h2 class="avantages">Vos avantages</h2>
        <div class="info">
            <img src="./images/icones/birthday.png" alt="cadeau">
            <p>C'est votre anniversaire ? et vous êtes inscrit chez nous ? Alors c'est votre jour de chance ! Les anniversaires, ça n'arrive qu'une fois dans l'année, alors nous voulons que ce jour soit spécial ! Nous nous engageons à ne jamais vous oublier et à vous offrir une petite surpise différente chaque année !
                Alors, qu'attendez vous ? Inscrivez-vous vite !
            </p>
        </div>
        <div class="info">
            <img src="./images/icones/target.png" alt="livraison">
            <p>C'est toujours mieux quand vous n'êtes pas encombré par des publicités qui ne vous interesse pas, n'est ce pas ? Vous souhaiteriez peut-être des suggestions sur mesure rien que pour vous, et vous le méritez ! Pour ce faire, inscrivez-vous et nous nous chargeons du reste !</p>
        </div>
        <div class="info">
            <img src="./images/icones/mail.jpg" alt="SAV">
            <p>Parce que nous aimons être proche de nos clients et que nous voulons lui offrir le meilleur service, nous avons mis en place une newsletter dans la quelle vous trouverez plein d'astuces et de cadeaux ! Vous n'allez quand meme pas manquer ça ? Inscrivez vous pour recevoir votre tout premier avantage !</p>
        </div>
    </div>
</main>
<?php include 'layout/footer.php'; ?>