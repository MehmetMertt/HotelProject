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
                 $messageErfolg = "You file was successfully uploaded!";
            } else {
                $message = "There was a error while uploading your file!";
                $checkIfError == FALSE;
            };
        }
          
}

define('SECURE', true);
require_once('inc/connect.php');

$id = $_SESSION['id'];
$query = $db->prepare("SELECT mail,vname,nname,geschlecht,adresse,stadt,plz,passwort,isAdmin,isActive FROM users WHERE id = ?");

$query->bind_param('i',$id);


$query->execute();
$query->store_result();


$query->bind_result($mail, $vorname, $nachname,$geschlecht,$adresse,$stadt,$plz,$passwort,$isAdmin,$isActive);

$query->fetch();


include 'inc/profile_edit_requests.php';
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
                <h1>Personal Information</h1>
            </div>
            <div class="col-6">
                <img class="pb edit" data-bs-toggle="modal" alt="profile pic" data-bs-target="#exampleModal"
                    id="picedit" src="<?php echo $pb?>">
            </div>
            <div class="col-12">
                <p>Update your information and find out how it is used.</p>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Select an image to upload</h1>
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
                                class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal END -->

    <?php include 'inc/errorhandler.php' ?>



    <?php include 'inc/table_profileinfo.php';?>


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