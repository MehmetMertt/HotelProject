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
                <img data-bs-toggle="modal" data-bs-target="#exampleModal" id="picedit" height="75px"
                    src="img/logo.png">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container profilesection">
        <div class="row profileelem">
            <div class="col-4"><span>Name</span></div>
            <div class="col-4"><span>Mehmet Mert</span></div>
            <div class="col-4"><a href="#"><span>Bearbeiten</span></a></div>

            <hr>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>E-Mail</span></div>
            <div class="col-4"><span>mehmetmert@test.com</span></div>
            <div class="col-4"><a href="#"><span>Bearbeiten</span></a></div>

            <hr>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Passwort</span></div>
            <div class="col-4"><span>*********</span></div>
            <div class="col-4"><a href="#"><span>Bearbeiten</span></a></div>
            <hr>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Adresse</span></div>
            <div class="col-4"><span>Ringstraße 01</span></div>
            <div class="col-4"><a href="#"><span>Bearbeiten</span></a></div>
            <hr>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Stadt</span></div>
            <div class="col-4"><span>Wien</span></div>
            <div class="col-4"><a href="#"><span>Bearbeiten</span></a></div>
            <hr>
        </div>

        <div class="row profileelem">
            <div class="col-4"><span>Postleitzahl</span></div>
            <div class="col-4"><span>1010</span></div>
            <div class="col-4"><a href="#"><span>Bearbeiten</span></a></div>
            <hr>
        </div>
    </div>


    <?php 
    include 'inc/footer.php'
    ?>

</body>

</html>