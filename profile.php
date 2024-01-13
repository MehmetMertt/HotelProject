<?php

session_start();
if(isset($_SESSION['id']) == FALSE) {
    header('location: login.php');
    exit();
}


if(isset($_POST['changePb'])) {
        
        $pb = $_FILES["pb"];
        $checkIfError = TRUE;
    
        if($pb["size"] > 5000000) { //5 MB
             $message = "Sorry, your uploaded image is too large!";
             $checkIfError = FALSE;

        }
    
        if(strtolower($pb["type"]) != "image/jpeg" && strtolower($pb["type"]) != "image/png") {
            $message = "Sorry, Please only upload jpeg/png Files!";
            $checkIfError = FALSE;
        } 
    
    
        if($checkIfError == TRUE) {
            $path = 'upload/' . $_SESSION['id'];
            if(file_exists($path) == FALSE) {
                mkdir($path,0777,true);
            }
        
            if(move_uploaded_file($_FILES['pb']['tmp_name'],$path . '/pb.jpg')){
                 $message = "You file was successfully uploaded!";
            } else {
                $message = "There was a error while uploading your file!";
                $checkIfError == FALSE;
            };
        }
          
}

define('SECURE', true);
require_once('inc/connect.php');

$id = $_SESSION['id'];
$query = $db->prepare("SELECT mail,vname,nname,geschlecht,adresse,stadt,plz,passwort FROM users WHERE id = ?");

$query->bind_param('i',$id);


$query->execute();
$query->store_result();


$query->bind_result($mail, $vorname, $nachname,$geschlecht,$adresse,$stadt,$plz,$passwort);

$query->fetch();


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
                    $sessionid = $_SESSION['id'];
                    $query->bind_param('ss',$new_email,$sessionid);
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


    if(empty($new_adresse)) {
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
                    $sessionid = $_SESSION['id'];
                    $query->bind_param('ssi',$new_nachname,$new_vorname,$sessionid);
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
                $sessionid = $_SESSION['id'];
                $query->bind_param('si',$new_adresse,$sessionid);
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
                $sessionid = $_SESSION['id'];
                $query->bind_param('si',$new_city,$sessionid);
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
                $sessionid = $_SESSION['id'];
                $query->bind_param('si',$new_plz,$sessionid);
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
                $sessionid = $_SESSION['id'];
                $query->bind_param('si',$new_plz,$sessionid);
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
                $sessionid = $_SESSION['id'];
                $query->bind_param('si',$hashed_new_pw,$sessionid);
                $query->execute();
                $message = "Your password have been updated!";
                $checkIfError = TRUE;
                $passwort = $new_pw;
            }


        }
    }   
}
?>


<!DOCTYPE html>
<html lang="en">


<?php include 'inc/head.php'; ?>


<body>

    <?php
    include 'inc/navbar.php'
    ?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Persönliche Angaben</h1>
            </div>
            <div class="col-6">
                <img class="pb edit" data-bs-toggle="modal" data-bs-target="#exampleModal" id="picedit"
                    src="<?php echo $pb?>">
            </div>
            <div class="col-12">
                <p>Aktualisieren Sie Ihre Informationen und erfahren Sie, wie sie genutzt werden.</p>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Wählen Sie ein Bild zum Hochladen aus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form enctype="multipart/form-data" method="post" action="">
                        <div class="mb-3">
                            <input class="form-control" name="pb" type="file" id="pb" accept="image/jpeg, image/png">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="changePb" id="changePb" name="changePb"
                                class="btn btn-primary">Hochladen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal END -->

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



    <div class="container profilesection">
        <div class="row profileelem">
            <div class="col-4"><span>Name</span></div>
            <div class="col-4"><span><?php echo $vorname . " " . $nachname; ?></span></div>
            <div class="col-4" onclick="edit(0);"><span class="bearbeiten">Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form action="profile.php" method="post" class="row">
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
            <form action="profile.php" method="post" class="row">
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
            <form action="profile.php" method="post" class="row">
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
            <form action="profile.php" method="post" class="row">
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
            <form action="profile.php" method="post" class="row">
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
            <form action="profile.php" method="post" class="row">
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
    </div>


    <?php 
    include 'inc/footer.php'
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