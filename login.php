<?php
/*
 *    Autor        : Dennis1993
 *    Copyright    : (c) 2011 by Dennis1993
 */
session_start();
define('SECURE', true);
require_once('inc/connect.php');


/**
 *    Abmeldevorgang
 */
if(isset($_SESSION['id']))
{
    header('location: dashboard.php');
    exit();
}

if(isset($_POST['send']))
{
    $user_email = trim(htmlspecialchars($_POST['mail']));
    $user_password = trim(htmlspecialchars($_POST['password']));

    //Benutzereingaben validieren
    if(filter_var($user_email, FILTER_VALIDATE_EMAIL) && !empty($user_password))
    {
        
        $query = $db->prepare('SELECT `id`,`vname`,`nname`,`passwort`,`isAdmin`,`isActive` FROM `users` WHERE mail = ?');
        $query->bind_param('s', $user_email);
        $query->execute();
        $query->store_result();
        $query->bind_result($id, $vorname, $nachname,$dbpassword,$isAdmin,$isActive);
        $query->fetch();
        $hashed_user_password = hash("sha256",$user_password);
        if($hashed_user_password == $dbpassword) {
            if($query->num_rows == 1)
            {
                if((int)$isActive == 1) {
                    $_SESSION['id'] = $id;
                    $_SESSION['isAdmin'] = $isAdmin;
                    $_SESSION['vorname'] = $vorname; 
                    $_SESSION['nachname'] = $nachname;
                    header('location: dashboard.php');
                    exit();
                } else {
                    $error = "Ihr Account wurde von einem Administrator deaktiviert. Melden Sie sich per E-Mail!";
                }

            }
            else
            {
                $error = 'Ihre Anmeldedaten sind nicht korrekt. Bitte wiederholen Sie Ihre Eingabe.';
            }
        } else {
            $error = 'Ihre Anmeldedaten sind nicht korrekt. Bitte wiederholen Sie Ihre Eingabe.';

        }
    }
    else
    {
        $error = 'Ihre Anmeldedaten sind nicht korrekt. Bitte wiederholen Sie Ihre Eingabe.';
    }
}
else
{
    $error = NULL;
    $user_email = NULL;
}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="style/style.css" type="text/css" />
</head>

<body>
    <?php
    include 'inc/navbar.php';
    ?>


    <div class="body">

        <?php if(isset($error)): ?>
        <div class="container">
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>




        <div class="login-container">
            <form class="login-form" action="login.php" method="post">
                <h2>Login</h2>
                <div class="input-group">
                    <label for="mail">E-mail</label>
                    <input type="text" id="mail" name="mail" placeholder="Enter your E-Mail" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <button name="send" type="submit" class="button">Login</button>
            </form>
        </div>
    </div>



    <?php
     include 'inc/footer.php' 
     ?>

</body>

</html>