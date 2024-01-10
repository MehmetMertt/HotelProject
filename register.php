<?php

if(isset($_SESSION['id'])) {
    header("location: dashboard.php");
    exit();
}

if(isset($_POST['register'])) {
        //https://stackoverflow.com/questions/53889927/easiest-way-to-check-if-multiple-post-parameters-are-set
        $params_needed = ["vorname", "nachname", "geschlecht",
        "email", "pw","pw2", "adress", "city", "plz", "nutz", "username"];
        $given_params = array_keys($_POST);
    
        $missing_params = array_diff($params_needed, $given_params);
    
        if(!empty($missing_params)) {
            $message = "Bitte füllen Sie alle Fehler aus!";
        } else {
            $username = trim(htmlspecialchars($_POST['username']));
            $vorname = trim(htmlspecialchars($_POST['vorname'])); //
            $nachname = trim(htmlspecialchars($_POST['nachname'])); //
            $geschlecht = trim(htmlspecialchars($_POST['geschlecht']));
            $email = trim(htmlspecialchars($_POST['email'])); //
            $pw = trim(htmlspecialchars($_POST['pw'])); //
            $pw2 = trim(htmlspecialchars($_POST['pw2'])); //
            $adress = trim(htmlspecialchars($_POST['adress']));
            $city = trim(htmlspecialchars($_POST['city']));
            $plz = trim(htmlspecialchars($_POST['plz']));
            $nutz = trim(htmlspecialchars($_POST['nutz']));

            if(empty($username) == TRUE || empty($vorname) == TRUE || empty($nachname) == TRUE || empty($geschlecht) == TRUE || empty($email) == TRUE || empty($pw) == TRUE || empty($pw2) == TRUE || empty($adress) == TRUE || empty($city) == TRUE || empty($plz) == TRUE || empty($nutz) == TRUE) {
                $message = "Please will every field!";
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $message = "Please use a real email";
                  } else {
                        if(preg_match("/^[a-zA-Z\s]+$/",$nachname) == false || preg_match("/^[a-zA-Z\s]+$/",$vorname) == false) {
                            $message = "Please use a real name!";
                        } else {
                            if($pw != $pw2) {
                                $message = "The passwords are not equal!";
                            } else {
                                $geschlecht_array = array("m","f","d");
                                if(!in_array($geschlecht,$geschlecht_array)) {
                                    $message = "Please choose Male, Female or Divers";
                                } else {
                                    if(preg_match("/^[A-Za-z][A-Za-z0-9]{3,20}$/",$username) == false) {
                                        $message = "Your Username did not meet the requirements";
                                    } else {
                                        define('SECURE', true);
                                        require_once('inc/connect.php');
            
                                        if($query = $db->prepare('SELECT id, mail from users WHERE mail = ?;')) {
                                            $query->bind_param('s', $email);
                                            $query->execute();
                                            $query->store_result();
                                            
                                            if ($query->num_rows > 0) {
                                                $message = "A account with this email already exists. Please login <a href=\"login.php\">here</a>!";
                                            } else {
        
                                                if($query = $db->prepare('SELECT id, username from users WHERE username = ?;')) {
                                                    $query->bind_param('s', $username);
                                                    $query->execute();
                                                    $query->store_result();
        
                                                    if ($query->num_rows > 0) {
                                                        $message = "A account with this username already exists. Please login <a href=\"login.php\">here</a>!";
        
                                                    } else {
        
                                                        $hashedPassword = hash("sha256", $pw);
                                                        $query = $db->prepare('INSERT INTO users (mail,vname,nname,geschlecht,passwort,adresse,stadt,plz,isAdmin,username)
                                                        VALUES (?,?,?,?,?,?,?,?,0,?)');
                                                        $query->bind_param('sssssssss', $email,$vorname,$nachname,$geschlecht,$hashedPassword,$adress,$city,$plz,$username);
                                                        $query->execute();
                                                        $messageErfolg = "Account successfully registerd. Please login <a href=\"login.php\">here</a>!";
                                                        
                                                    }
        
                                                } else {
                                                    echo 'The Website is currently under maintenance';
                                                    exit();
                                                }
        
                                            }
                                        } else {
                                            echo 'The Website is currently under maintenance';
                                            exit();
                                        }
                                    }
                                    
                                }
                               
    
    
                            }
                        }
                  }
            }

        }
}




?>



<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style/style.css" type="text/css" />
    <title>Register</title>
</head>

<body>

    <?php
    include 'inc/navbar.php'
    ?>


    <div class="maincon container h-100 d-flex flex-column align-items-center w-50 mt-5">
        <h1>Register</h1>

        <br>
        <?php if(isset($message)): ?>
        <div class="container">
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>
        <?php if(isset($messageErfolg)): ?>
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show">
                <strong>Error!</strong> <?php echo $messageErfolg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php endif; ?>
        <br>

        <form action="register.php" method="post" class="row align-items-center">
            <div class="col-md-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="vorname" class="form-control" id="name" required>
            </div>
            <div class="col-md-4">
                <label for="surname" class="form-label">Surname</label>
                <input type="text" name="nachname" class="form-control" id="surname" required>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Sex</label>
                <select name="geschlecht" id=" inputState" class="form-select">
                    <option selected>Wähle aus</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                    <option value="d">Divers</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4" required>
            </div>
            <div class="col-md-6">
                <label for="inputEmailUserName" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="inputEmailUserName" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" name="pw" class="form-control" id="inputPassword4" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword5" class="form-label">Password wiederholen</label>
                <input type="password" name="pw2" class="form-control" id="inputPassword5" required>
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="adress" class="form-control" id="inputAddress" placeholder="Ringstraße 01"
                    required>
            </div>
            <div class="col-md-4">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" name="city" class="form-control" id="inputCity" required>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Postal Code</label>
                <input type="text" name="plz" class="form-control" id="inputZip" name="inputZip" required>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" name="nutz" type="checkbox" id="gridCheck" required>
                    <label class="form-check-label" for="gridCheck">Indem Sie auf „Registrieren” klicken, erklärst Sie
                        sich mit
                        unseren Nutzungsbedingungen einverstanden und bestätigst, dass du
                        unsere Datenrichtlinie einschließlich unserer Bestimmungen zur
                        Verwendung von Cookies gelesen hast.</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" name="register" class=" btn btn-primary">Register</button>
            </div>
        </form>
    </div>

    <?php
    include 'inc/footer.php'
    ?>
</body>

</html>