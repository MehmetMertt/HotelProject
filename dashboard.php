<?php
session_start();
if(isset($_SESSION['id']) == FALSE) {
    header('location: login.php');
    exit();
}


define('SECURE', true);
require_once('inc/connect.php');

if(isset($_POST['getZimmer'])) {
    
    $kategorie = trim(htmlspecialchars($_POST['zimmerart']));
    $pets = trim(htmlspecialchars($_POST['pets']));
    $children = trim(htmlspecialchars($_POST['child']));
    $adults = trim(htmlspecialchars($_POST['adult']));
    $park = 0;
    $break = 0;


    if(isset($_POST['park'])) {
        $park = 1;        
    }

    if(isset($_POST['breakfast'])) {

        $break = 1;
    }
    
    $kostenparkplatz = 10;
    $kostenfruestueck = 7;

    if(!empty($kategorie) && !empty($adults)) {
        
        if(is_null($children)) {
            $children = 0;
        }
        $pets2 = (int)$pets;
        $human = (int)$adults;
        $kategorie2 = (int)$kategorie;

        $query = $db->prepare('
        SELECT z1.`zimmerid`, z1.`beschreibung`, z2.`preisProTag`, z3.`bildpfad`
        FROM `zimmerdescription` as z1
        INNER JOIN
	        (SELECT `zimmerId`, `preisProTag` FROM `zimmer` as z2 WHERE `maxHaustier` >= ? AND `maxPerson` >= ? AND `kategorie` = ?) as z2 ON z1.zimmerid = z2.zimmerId
        INNER JOIN
	        (SELECT * FROM `zimmerbilder`) as z3 ON z3.zimmerid = z1.zimmerid;
        ');
        $query->bind_param('iii', $pets2, $human,$kategorie2);
        $query->execute();
        $allezimmer = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        if(isset($_POST['park']) || isset($_POST['breakfast']) ) {

            foreach ($allezimmer as $key => $room) {
                if (isset($_POST['park'])) {
                    $allezimmer[$key]['preisProTag'] = $allezimmer[$key]['preisProTag'] + $kostenparkplatz; // Update price to 150 for room 1
                }

                if(isset($_POST['breakfast'])) {
                    $allezimmer[$key]['preisProTag'] = $allezimmer[$key]['preisProTag'] + $kostenfruestueck; // Update price to 150 for room 1
                }
             }

        }
  
    } else {
        echo "Ok";
    }

   
      
} 

$currentstep = 1

?>

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
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>

    <link rel="stylesheet" href="style/style.css" type="text/css" />
    <title>Continental</title>
</head>

<body>

    <div class="main">
        <?php
    include 'inc/navbar.php';
    ?>

        <h1>Wohin als Nächstes, <?php echo $_SESSION['vorname']; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class=" auswahlcenter">
                    <div class="row auswahl">

                        <div class="d-flex col-lg-3 col-sm-12">
                            <select name="zimmerart" type="text" class="form-control" class="form-select form-select-sm"
                                aria-label="Small select example">
                                <option selected>Welches Zimmer?</option>
                                <option value="1">Luxuszimmer</option>
                                <option value="2">Doppelzimmer</option>
                                <option value="3">Einzelzimmer</option>
                                <option value="4">Dreierzimmer</option>
                                <option value="5">Viererzimmer</option>
                                <option value="6">Präsidentensuite</option>


                            </select>
                        </div>
                        <div class=" d-flex col-lg-3 col-sm-12">
                            <input class="form-control dropdown-toggle" type="text" id="dropdownMenuClickable"
                                placeholder="Mit wem reisen Sie?" data-bs-toggle="dropdown" data-bs-auto-close="false"
                                onclick="removeDropdown2()">
                            </input>

                            <div class="dropdown">

                                <div id="dropdown" class="dropdown-menu p-4">
                                    <div class="mb-2">
                                        <label for="exampleDropdownFormEmail2" class="form-label">Erwachsene</label>
                                        <button type="button" onclick="decreaseValue('adult')" name='decqty'>-</button>
                                        <input id="adult" type='text' size='1' name='adult' value='0' readonly />
                                        <button type="button" onclick="increaseValue('adult')" name='incqty'>+</button>

                                    </div>
                                    <div class="mb-2">
                                        <label for="exampleDropdownFormPassword2" class="form-label">Kinder</label>
                                        <button type="button" onclick="decreaseValue('child')" name='decqty'>-</button>
                                        <input id="child" type='text' size='1' name='child' value='0' readonly />
                                        <button type="button" onclick="increaseValue('child')" name='incqty'>+</button>

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleDropdownFormPassword2" class="form-label">Haustiere</label>
                                        <button type="button" onclick="decreaseValue('pets')" name='decqty'>-</button>
                                        <input id="pets" type='text' size='1' name='pets' value='0' readonly />
                                        <button type="button" onclick="increaseValue('pets')" name='incqty'>+</button>

                                    </div>

                                    <button type="button" data-toggle="dropdown" onclick="removeDropdown()"
                                        class="btn btn-primary">Fertig</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex col-lg-3 col-sm-12">
                            <!-- 
                        <input style="font-size: 15px;" id="datepicker" class="form-control dropdown-toggle"
                            type="text" id="dropdownMenuClickable" name="datepicker" placeholder="Wann reisen Sie?"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" />
                        <input type="hidden" id="startDate">
                        <input type="hidden" id="endDate">
                        --->

                            <input class="form-control dropdown-toggle" type="text" id="dropdownMenuClickable"
                                placeholder="Extras auswählen" data-bs-toggle="dropdown" data-bs-auto-close="false"
                                onclick="removeDropdown()">
                            </input>

                            <div class="dropdown">

                                <div id="dropdown2" class="dropdown-menu p-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="breakfast"
                                            value="breakfast" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Mit Frühstück?
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="park" value="park"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Mit Parkplatz?
                                        </label>
                                    </div>

                                    <button type="button" data-toggle="dropdown" onclick="removeDropdown2()"
                                        class="btn btn-primary">Fertig</button>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex col-lg-3 col-sm-12">
                            <button style="width: 100%;" class="btn btn-primary btn-lg" type="getZimmer" id="getZimmer"
                                name="getZimmer">Suchen</button>
                        </div>
                    </div>
                </div>
            </form>

            <?php if(isset($_POST['getZimmer'])) : ?>
            <?php foreach ($allezimmer as $zimmer) : ?>
            <div class="zimmer">
                <img alt="zimmer" height="183px" width="275px" src="<?php echo $zimmer['bildpfad'] ?>">
                <h2>Luxuszimmer</h2>
                <h3><?php echo $zimmer['preisProTag'] .'€' ?></h3>
                <p><?php echo $zimmer['beschreibung'] ?>
                </p>
                <a href="<?php echo "zimmerdetails.php?id=" . $zimmer['zimmerid'] ?>"> Mehr Informationen</a>
                <br>
                <br>
                <a
                    href="<?php echo "buchen.php?id=" . $zimmer['zimmerid'] . "&er=" . $adults . "&ch=" . $children . "&pets=" . $pets . "&park=" . $park . "&break=" . $break ?>"><button
                        type="button" class="btn btn-primary">Buchen</button></a>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>


            <div class=" angebote">
                <h1>Angebote</h1>
                <!--
        <p>Rabatte, Werbeaktionen und Sonderangebote für Sie</p>
        <div class="card-angebot">
            <h1>Machen Sie ihren bisher längsten Urlaub</h1>
            <p>Durchstöbern Sie Unterkünfte mit Langzeitaufenthalten -
                viele zu reduzierten Monatspreisen.</p>
                <img width="250px" src="img/family_laptop.jpg">
                
            </div>
            --->
            </div>






            <script>
            function removeDropdown() {
                document.getElementById('dropdown').classList.remove('show');
            }

            function removeDropdown2() {
                document.getElementById('dropdown2').classList.remove('show');
            }

            function increaseValue(eleId) {
                var maxPets = 2;
                var value = parseInt(document.getElementById(eleId).value, 10);
                value = isNaN(value) ? 0 : value;

                if (eleId === 'pets') {
                    if (value < maxPets) {
                        value++
                    }
                } else {
                    value++
                }


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

            <script type="text/javascript" src="js/picker.js"></script>


    </div>
    <?php
        include 'inc/footer.php';
        ?>



</body>

</html>