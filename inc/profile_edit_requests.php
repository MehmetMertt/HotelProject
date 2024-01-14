<?php

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
                    $messageErfolg = "Mail is updated";
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
                    $messageErfolg = "You informations has been updated!";
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
                $messageErfolg = "Your Adress has been updated!";
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
                $messageErfolg = "Your City has been updated!";
                $checkIfError = TRUE;
                $stadt = $new_city;

        }
    }   
}

if(isset($_POST['update_plz']) && (isset($_POST['plzfield']))) {

    $new_plz = trim(htmlspecialchars($_POST['plzfield']));

    if(empty($new_plz)) {
        $message = "PLZ cannot be empty!";
        $checkIfError = FALSE;

    } else {
        if($plz == $new_plz) {
            $message = "Please change your PLZ!";
            $checkIfError = FALSE;
        } else {
                $query = $db->prepare("UPDATE users SET plz=? WHERE id=?");
                $query->bind_param('si',$new_plz,$id);
                $query->execute();
                $messageErfolg = "You PLZ has been updated!";
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
                $messageErfolg = "Your password has been updated!";
                $checkIfError = TRUE;
                $passwort = $new_pw;
            }


        }
    }   
}


if(isset($_POST['update_isAdmin']) && (isset($_POST['isAdminField'])) && $admin == 1) {

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
                    $messageErfolg = "isAdmin is updated";
                    $checkIfError = TRUE;
                    $isAdmin = $new_isAdmin;
            }
        }

    
}


if(isset($_POST['update_isActive']) && (isset($_POST['isActiveField'])) && $admin == 1) {

    $new_isActive = trim(htmlspecialchars($_POST['isActiveField']));

        //0 is considered empty!

        if($isActive != 1 && $isActive != 0) {
            $message = "isActive can only be 0 (is not active) or 1 (is active)";
            $checkIfError = FALSE;
        } else {
            if($isActive == $new_isActive) {
                $message = "You did not change isActive";
                $checkIfError = FALSE;
            } else {
                    $query = $db->prepare("UPDATE users SET isActive=? WHERE id=?");
                    $query->bind_param('ii',$new_isActive,$id);
                    $query->execute();
                    $messageErfolg = "isActive is updated";
                    $checkIfError = TRUE;
                    $isActive = $new_isActive;
            }
        }

    
}

?>