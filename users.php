<?php

session_start();
define('SECURE', true);
require_once('inc/connect.php');
$admin = $_SESSION['isAdmin'];
if(isset($_SESSION['id']) == FALSE || $admin == 0) {
    header('location: login.php');
    exit();
}


$query = $db->prepare('SELECT * FROM `users`');
$query->execute();
$alleusers = $query->get_result()->fetch_all(MYSQLI_ASSOC);


if(empty($alleusers)) {
    $message = "There are no users";
} 

if(isset($_GET['userID'])) {
    
    
    $userID = trim(htmlspecialchars($_GET['userID']));
    
    if($userID != $_SESSION['id']) {
        if($admin == 0) {
            header("location: profile.php");
            exit();
        }
    }
    
    foreach($alleusers as $user) {
        if($user['id'] == $userID) {
            $currentuser = $user;
            break;
        }
    }

    $id = $user['id'];
    $mail = $user['mail'];
    $vorname = $user['vname'];
    $nachname = $user['nname'];
    $geschlecht = $user['geschlecht'];
    $passwort = $user['passwort'];
    $adresse = $user['adresse'];
    $stadt = $user['stadt'];
    $plz = $user['plz'];
    $isActive = $user['isActive'];
    $isAdmin = $user['isAdmin'];


}


include 'inc/profile_edit_requests.php';

?>




<!DOCTYPE html>
<html lang="en">


<?php include 'inc/head.php'; ?>

<body>

    <?php
    include 'inc/navbar.php';
    ?>

    <?php if(!isset($message) && !isset($_GET['userID']) && $admin == 1) : ?>
    <?php
      $count = 0;  
    ?>
    <div class="container main" style="overflow-x:auto;">
        <table class=" table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">userID</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Name</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Adress</th>
                    <th scope="col">City</th>
                    <th scope="col">PLZ</th>
                    <th scope="col">isAdmin</th>
                    <th scope="col">isActive</th>
                    <th scope="col"><i class="bi bi-pencil"></i></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($alleusers as $user) : ?>
                <?php
                $count = $count + 1;
                ?>
                <tr>
                    <th scope="row"><?php echo $count ?></th>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['mail']; ?></td>
                    <td><?php echo $user['vname']; ?></td>
                    <td><?php echo $user['nname']; ?></td>
                    <td><?php echo $user['geschlecht']; ?></td>
                    <td><?php echo $user['adresse']; ?></td>
                    <td><?php echo $user['stadt']; ?></td>
                    <td><?php echo $user['plz']; ?></td>
                    <td><?php echo $user['isAdmin'] == '1' ? '✔️' : '❌'; ?></td>
                    <td><?php echo $user['isActive']; ?></td>
                    <td><a href="users.php?userID=<?php echo $user['id']?>">Bearbeiten</a></td>
                    </td>

                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>

    <?php include 'inc/errorhandler.php' ?>


    <?php if(isset($_GET['userID'])) :?>

    <?php include 'inc/table_profileinfo.php';?>

    <?php endif;?>

    <?php
    include 'inc/footer.php';
    ?>

</body>

<script>
function edit(n) {
    var x = document.getElementsByClassName('editdata')[n]
    if (x.classList.contains("block")) {
        x.classList.remove("block");
    } else {
        x.classList.add("block");
    }
}
</script>

</html>