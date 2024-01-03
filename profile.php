<?php

session_start();

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
$query = $db->prepare("SELECT mail,vname,nname,geschlecht,adresse,stadt,plz FROM users WHERE id = ?");

$query->bind_param('i',$id);


$query->execute();

$query->bind_result($mail, $vorname, $nachname,$geschlecht,$adresse,$stadt,$plz);

$query->fetch();


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
            <div class="col-4" onclick="edit(0);"><span>Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form class="row">
                <div class="col-auto">
                    <label for="vornamefield" class="form-label">Vorname</label>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" id="vornamefield">
                </div>
                <div class="col-auto">
                    <label for="nachnamefield" class="form-label">Nachname</label>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" id="nachnamefield">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>

        </div>

        <div class="row profileelem">
            <div class="col-4"><span>E-Mail</span></div>
            <div class="col-4"><span><?php echo $mail;?></span></div>
            <div class="col-4" onclick="edit(1);"><span>Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form class="row">
                <div class="col-auto">
                    <label for="vornamefield" class="form-label">Vorname</label>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" id="vornamefield">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Passwort</span></div>
            <div class="col-4"><span>*********</span></div>
            <div class="col-4" onclick="edit(2);"><span>Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form class="row">
                <div class="col-auto">
                    <label for="vornamefield" class="form-label">Password</label>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" id="vornamefield">
                </div>
                <div class="col-auto">
                    <label for="vornamefield" class="form-label">Password again</label>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" id="vornamefield">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
        </div>

        <div class="row profileelem block">
            <div class="col-4"><span>Adresse</span></div>
            <div class="col-4"><span><?php echo $adresse;?></span></div>
            <div class="col-4" onclick="edit(3);"><span>Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form class="row">
                <div class="col-auto">
                    <label for="vornamefield" class="form-label">Adresse</label>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" id="vornamefield">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Stadt</span></div>
            <div class="col-4"><span><?php echo $stadt;?></span></div>
            <div class="col-4" onclick="edit(4);"><span>Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form class="row">
                <div class="col-auto">
                    <label for="vornamefield" class="form-label">City</label>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" id="vornamefield">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <br>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Postleitzahl</span></div>
            <div class="col-4"><span><?php echo $plz;?></span></div>
            <div class="col-4" onclick="edit(5);"><span>Bearbeiten</span></div>
            <hr>
        </div>

        <div class="row editdata block">
            <br>
            <form class="row">
                <div class="col-auto">
                    <label for="vornamefield" class="form-label">PLZ</label>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" id="vornamefield">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
    document.getElementsByClassName('editdata')[n].classList.remove("block");
}
</script>

</html>