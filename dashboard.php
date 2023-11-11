<!DOCTYPE html>
<html lang="de">

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
    include 'inc/navbar.php';
    ?>



    <div class="main">
        <h1>Wohin als Nächstes, <?php echo "Mehmet"; ?>

            <div class="auswahlcenter">
                <div class="row auswahl">
                    <div class="d-flex col-lg-3 col-sm-12">
                        <input type="text" class="form-control" placeholder="Wohin reisen Sie?" aria-label="wohin">
                    </div>
                    <div class="d-flex col-lg-3 col-sm-12">
                        <input type="text" class="form-control" placeholder="Wann reisen Sie?" aria-label="Datum">
                    </div>
                    <div class="d-flex col-lg-3 col-sm-12">
                        <input class="form-control dropdown-toggle" type="text" id="dropdownMenuClickable"
                            placeholder="Mit wem Reisen sie?" data-bs-toggle="dropdown" data-bs-auto-close="false">
                        </input>

                        <div class="dropdown">

                            <div id="dropdown" class="dropdown-menu p-4">
                                <div class="mb-2">
                                    <label for="exampleDropdownFormEmail2" class="form-label">Erwachsene</label>
                                    <button onclick="increaseValue('adult')" name='incqty'>+</button>
                                    <input id="adult" type='text' size='1' name='item' value='0' />
                                    <button onclick="decreaseValue('adult')" name='decqty'>-</button>
                                </div>
                                <div class="mb-2">
                                    <label for="exampleDropdownFormPassword2" class="form-label">Kinder</label>
                                    <button onclick="increaseValue('child')" name='incqty'>+</button>
                                    <input id="child" type='text' size='1' name='item' value='0' />
                                    <button onclick="decreaseValue('child')" name='decqty'>-</button>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleDropdownFormPassword2" class="form-label">Haustiere</label>

                                    <button onclick="increaseValue('pets')" name='incqty'>+</button>
                                    <input id="pets" type='text' size='1' name='item' value='0' />
                                    <button onclick="decreaseValue('pets')" name='decqty'>-</button>
                                </div>

                                <button data-toggle="dropdown" onclick="removeDropdown()"
                                    class="btn btn-primary">Fertig</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex col-lg-3 col-sm-12">
                        <button type="button" class="btn btn-primary btn-lg">Suchen</button>
                    </div>
                </div>
            </div>

    </div>




    <script>
    function removeDropdown() {
        document.getElementById('dropdown').classList.remove('show');
    }

    function increaseValue(eleId) {
        var value = parseInt(document.getElementById(eleId).value, 10);
        value = isNaN(value) ? 0 : value;
        value++
        document.getElementById(eleId).value = value;
    }

    function decreaseValue(eleId) {
        var value = parseInt(document.getElementById(eleId).value, 10);
        value = isNaN(value) ? 0 : value;
        value--;
        if (value < 0) {
            document.getElementById(eleId).value = 0;
        } else {
            document.getElementById(eleId).value = value;

        }
    }
    </script>



    <?php
    include 'inc/footer.php';
    ?>



</body>

</html>