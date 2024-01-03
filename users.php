<?php

session_start();
define('SECURE', true);
require_once('inc/connect.php');
$admin = $_SESSION['isAdmin'];
if(isset($_SESSION['id']) == FALSE || $_SESSION['isAdmin'] == 0) {
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
    $isAdmin = $user['isAdmin'];

}



if(isset($_POST['update_mail']) && isset($_POST['emailfield'])) {
    
    $new_email = trim(htmlspecialchars($_POST['emailfield']));


    if(empty($new_email)) {
        $message = "E-Mail cannot be empty!";
        $checkIfError = FALSE;
    } else {
        if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            $message = "Please use a real email";
            $checkIfError = FALSE;
        } else {
            if($mail == $new_email) {
                $message = "Thid Email is already associated with your account";
                $checkIfError = FALSE;
            } else {
                $query = $db->prepare("SELECT * FROM users WHERE mail = ?");
                $query->bind_param('s',$new_email);
                $query->execute();
                $query->store_result();
                if($query->num_rows > 0) {
                    $message = "This email is already registered!";
                    $checkIfError = FALSE;
                } else {
                    $query = $db->prepare("UPDATE users SET mail=? WHERE id=?");
                    $query->bind_param('ss',$new_email,$id);
                    $query->execute();
                    $message = "Mail is updated";
                    $checkIfError = TRUE;
                    $mail = $new_email;
                }
            }
        }
    
    }
  
    
}

if(isset($_POST['update_name']) && (isset($_POST['vornamefield']) && isset($_POST['nachnamefield']))) {

    $new_vorname = trim(htmlspecialchars($_POST['vornamefield']));
    $new_nachname = trim(htmlspecialchars($_POST['nachnamefield']));


    if(empty($new_nachname) || empty($new_vorname)) {
        $message = "Surname/Name cannot be empty!";
        $checkIfError = FALSE;
    } else {
        if(preg_match("/^[a-zA-Z\s]+$/",$new_nachname) == false || preg_match("/^[a-zA-Z\s]+$/",$new_vorname) == false) {
            $message = "Please use a real name!";
            $checkIfError = FALSE;
    
        } else {
            if($nachname == $new_nachname && $vorname == $new_vorname) {
                $message = "Please change either your surname or name!";
                $checkIfError = FALSE;
            } else {
                    $query = $db->prepare("UPDATE users SET nname=?,vname=? WHERE id=?");
                    $query->bind_param('ssi',$new_nachname,$new_vorname,$id);
                    $query->execute();
                    $message = "You informations have been updated!";
                    $checkIfError = TRUE;
                    $nachname = $new_nachname;
                    $vorname = $new_vorname;
    
            }
        }
    }
  

    
}

if(isset($_POST['update_adress']) && (isset($_POST['adressfield']))) {

    $new_adresse = trim(htmlspecialchars($_POST['adressfield']));
    if(empty($new_adresse)) {
        $message = "Adress cannot be empty!";
        $checkIfError = FALSE;
    } else {
        if($adresse == $new_adresse) {
            $message = "Please change your adress!";
            $checkIfError = FALSE;
        } else {
                $query = $db->prepare("UPDATE users SET adresse=? WHERE id=?");
                $query->bind_param('si',$new_adresse,$id);
                $query->execute();
                $message = "You Adress have been updated!";
                $checkIfError = TRUE;
                $adresse = $new_adresse;

        }
    }

    
}

if(isset($_POST['update_city']) && (isset($_POST['cityfield']))) {

    $new_city = trim(htmlspecialchars($_POST['cityfield']));

    if(empty($new_city)) {
        $message = "City cannot be empty!";
        $checkIfError = FALSE;

    } else {
        if($stadt == $new_city) {
            $message = "Please change your city!";
            $checkIfError = FALSE;
        } else {
                $query = $db->prepare("UPDATE users SET stadt=? WHERE id=?");
                $query->bind_param('si',$new_city,$id);
                $query->execute();
                $message = "You Adress have been updated!";
                $checkIfError = TRUE;
                $stadt = $new_city;

        }
    }   
}

if(isset($_POST['update_plz']) && (isset($_POST['plzfield']))) {

    $new_plz = trim(htmlspecialchars($_POST['plzfield']));

    if(empty($new_plz)) {
        $message = "City cannot be empty!";
        $checkIfError = FALSE;

    } else {
        if($plz == $new_plz) {
            $message = "Please change your city!";
            $checkIfError = FALSE;
        } else {
                $query = $db->prepare("UPDATE users SET plz=? WHERE id=?");
                $query->bind_param('si',$new_plz,$id);
                $query->execute();
                $message = "You PLZ have been updated!";
                $checkIfError = TRUE;
                $plz = $new_plz;

        }
    }   
}

if(isset($_POST['update_plz']) && (isset($_POST['plzfield']))) {

    $new_plz = trim(htmlspecialchars($_POST['plzfield']));

    if(empty($new_plz)) {
        $message = "City cannot be empty!";
        $checkIfError = FALSE;

    } else {
        if($plz == $new_plz) {
            $message = "Please change your city!";
            $checkIfError = FALSE;
        } else {
                $query = $db->prepare("UPDATE users SET plz=? WHERE id=?");
                $query->bind_param('si',$new_plz,$id);
                $query->execute();
                $message = "You PLZ have been updated!";
                $checkIfError = TRUE;
                $plz = $new_plz;

        }
    }   
}

if(isset($_POST['update_pw']) && isset($_POST['pwfield']) && isset($_POST['pwfield2']) ) {

    $new_pw = trim(htmlspecialchars($_POST['pwfield']));
    $new_pw2 = trim(htmlspecialchars($_POST['pwfield2']));

    if(empty($new_pw) || empty($new_pw2)) {
        $message = "Your password cannot be empty!";
        $checkIfError = FALSE;

    } else {
        if($new_pw != $new_pw2) {
            $message = "The passwords are not the same!";
            $checkIfError = FALSE;
        } else {
            $hashed_new_pw = hash("sha256",$new_pw);
            
            if($passwort == $hashed_new_pw) {
                $message = "You did not change your password!";
            } else {
                $query = $db->prepare("UPDATE users SET passwort=? WHERE id=?");
                $query->bind_param('si',$hashed_new_pw,$id);
                $query->execute();
                $message = "Your password have been updated!";
                $checkIfError = TRUE;
                $passwort = $new_pw;
            }


        }
    }   
}


if(isset($_POST['update_isAdmin']) && (isset($_POST['isAdminField']))) {

    $new_isAdmin = trim(htmlspecialchars($_POST['isAdminField']));

        //0 is considered empty!

        if($isAdmin != 1 && $isAdmin != 0) {
            $message = "isAdmin can only be 0 (is not Admin) or 1 (is Admin)";
            $checkIfError = FALSE;
        } else {
            if($isAdmin == $new_isAdmin) {
                $message = "You did not change isAdmin";
                $checkIfError = FALSE;
            } else {
                    $query = $db->prepare("UPDATE users SET isAdmin=? WHERE id=?");
                    $query->bind_param('ii',$new_isAdmin,$id);
                    $query->execute();
                    $message = "isAdmin is updated";
                    $checkIfError = TRUE;
                    $isAdmin = $new_isAdmin;
                    $_SESSION['isAdmin'] = (int)$isAdmin;
            }
        }

    
}

?>




<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style/style.css" type="text/css" />
    <title>Continental</title>
</head>

<body>

    <?php
    include 'inc/navbar.php';
    ?>

    <?php if(!isset($message) && !isset($_GET['userID'])) : ?>
    <?php
      $count = 0;  
    ?>
    <table class="table">
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
                <td>x</td>
                <td><a href="users.php?userID=<?php echo $user['id']?>">Bearbeiten</a></td>
                </td>

            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <?php if(isset($message) && $checkIfError == FALSE): ?>
    <div class=" container">
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php endif; ?>

    <?php if(isset($message) && $checkIfError == TRUE): ?>
    <div class="container">
        <div class="alert alert-success  alert-dismissible fade show">
            <strong>Success!</strong> <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php endif; ?>


    <?php if(isset($_GET['userID'])) :?>

    <div class="container profilesection">
        <div class="row profileelem">
            <div class="col-4"><span>Name</span></div>
            <div class="col-4"><span><?php echo $vorname . " " . $nachname; ?></span></div>
            <div class="col-4" onclick="edit(0);"><span class="bearbeiten">Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form action="users.php?userID=<?php echo $id;?>" method="post" class="row">
                <div class="col-sm-6 col-md-auto">
                    <label for="vornamefield" class="form-label">Vorname</label>
                </div>
                <div class="col-sm-6 col-md-3">
                    <input type="text" name="vornamefield" class=" form-control" value="<?php echo $vorname;?>"
                        id="vornamefield">
                </div>
                <div class="col-sm-6 col-md-auto">
                    <label for="nachnamefield" class="form-label">Nachname</label>
                </div>
                <div class="col-sm-6 col-md-3 ">
                    <input type="text" name="nachnamefield" class="form-control" value="<?php echo $nachname;?>"
                        id="nachnamefield">
                </div>
                <div class="col-md-auto">
                    <button type="submit" name="update_name" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>

        </div>

        <div class="row profileelem">
            <div class="col-4"><span>E-Mail</span></div>
            <div class="col-4"><span><?php echo $mail;?></span></div>
            <div class="col-4" onclick="edit(1);"><span class="bearbeiten">Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form action="users.php?userID=<?php echo $id;?>" method="post" class="row">
                <div class="col-auto">
                    <label for="emailfield" class="form-label">E-Mail</label>
                </div>
                <div class="col-3">
                    <input type="text" name="emailfield" value="<?php echo $mail;?>" class="form-control"
                        id="emailfield">
                </div>
                <div class="col-auto">
                    <button type="submit" name="update_mail" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Passwort</span></div>
            <div class="col-4"><span>*********</span></div>
            <div class="col-4" onclick="edit(2);"><span class="bearbeiten">Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form action="users.php?userID=<?php echo $id;?>" method="post" class="row">
                <div class="col-lg-auto col-md-6">
                    <label for="passwordfield" class="form-label">Password</label>
                </div>
                <div class="col-lg-3 col-md-6">
                    <input name="pwfield" type="password" class="form-control" id="passwordfield">
                </div>
                <div class="col-lg-auto col-md-6">
                    <label for="passwordfield2" class="form-label">Password again</label>
                </div>
                <div class="col-lg-3 col-md-6">
                    <input name="pwfield2" type="password" class="form-control" id="passwordfield2">
                </div>
                <div class="col-lg-auto col-md-6">
                    <button type="submit" name="update_pw" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Adresse</span></div>
            <div class="col-4"><span><?php echo $adresse;?></span></div>
            <div class="col-4" onclick="edit(3);"><span class="bearbeiten">Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form action="users.php?userID=<?php echo $id;?>" method="post" class="row">
                <div class="col-auto">
                    <label for="adressefield" class="form-label">Adresse</label>
                </div>
                <div class="col-3">
                    <input type="text" name="adressfield" value="<?php echo $adresse;?>" class="form-control"
                        id="adressefield">
                </div>
                <div class="col-auto">
                    <button type="submit" name="update_adress" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Stadt</span></div>
            <div class="col-4"><span><?php echo $stadt;?></span></div>
            <div class="col-4" onclick="edit(4);"><span class="bearbeiten">Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form action="users.php?userID=<?php echo $id;?>" method="post" class="row">
                <div class="col-auto">
                    <label for="cityfield" class="form-label">City</label>
                </div>
                <div class="col-3">
                    <input type="text" name="cityfield" class="form-control" value="<?php echo $stadt;?>"
                        id="cityfield">
                </div>
                <div class="col-auto">
                    <button type="submit" name="update_city" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Postleitzahl</span></div>
            <div class="col-4"><span><?php echo $plz;?></span></div>
            <div class="col-4" onclick="edit(5);"><span class="bearbeiten">Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form action="users.php?userID=<?php echo $id;?>" method="post" class="row">
                <div class="col-auto">
                    <label for="plzfield" class="form-label">PLZ</label>
                </div>
                <div class="col-3">
                    <input type="text" name="plzfield" class="form-control" value="<?php echo $plz;?>" id="plzfield">
                </div>
                <div class="col-auto">
                    <button type="submit" name="update_plz" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>isAdmin</span></div>
            <div class="col-4"><span><?php echo $isAdmin;?></span></div>
            <div class="col-4" onclick="edit(6);"><span class="bearbeiten">Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form action="users.php?userID=<?php echo $id;?>" method="post" class="row">
                <div class="col-auto">
                    <label for="isAdminField" class="form-label">IsAdmin</label>
                </div>
                <div class="col-3">
                    <input type="text" name="isAdminField" class="form-control" value="<?php echo $isAdmin;?>"
                        id="isAdminField">
                </div>
                <div class="col-auto">
                    <button type="submit" name="update_isAdmin" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
        </div>

    </div>
    <?php endif ?>

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