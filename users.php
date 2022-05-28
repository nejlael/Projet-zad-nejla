<?php
    require 'backend/config/db.php';
    include 'layout/header.php';
    
    if (!isLogged()) {
        header('location:login.php');
    }
    require 'backend/models/user.class.php';
    require 'backend/services/user.service.php';
    
    $userService = new UserService();
    $users = $userService->getUsers();
    ?>
<main class="admin grid-container">
    <div  class="grid-item">
        <h3>Listes des utilisateurs</h3>
        <table id="table">
            <tr>
                <th>ID#</th>
                <th>Prénom & Nom</th>
                <th>Email</th>
                <th>Administrateur</th>
            </tr>
            <?php for ($i = 0; $i < count($users); $i++) { ?>
            <tr>
                <td><?= $users[$i]->id() ?></td>
                <td><?= $users[$i]->firstname() . ' ' . $users[$i]->lastname() ?></td>
                <td><?= $users[$i]->email() ?></td>
                <td><?= $users[$i]->isAdmin() ? 'Oui' : 'Non' ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</main>
<?php include 'layout/footer.php'; ?>