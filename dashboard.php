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

    if((int)$adults <= 0){
        $fehler = TRUE;
        $message = "Es muss mindestens 1 Erwachsener ausgewählt sein!";
    }

    if(isset($_POST['park'])) {
        $park = 1;        
    }

    if(isset($_POST['breakfast'])) {

        $break = 1;
    }
    
    $kostenparkplatz = 10;
    $kostenfruestueck = 7;
    $KostenTier = 2;

    if(!empty($kategorie) && !empty($adults) && !isset($message)) {
        
        if(is_null($children)) {
            $children = 0;
        }
        $pets2 = (int)$pets;
        $human = (int)$adults + (int)$children;
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

        if(empty($allezimmer)) {
            $message = "Es wurden leider keine Zimmer gefunden!";
        } else {
            if(isset($_POST['park']) || isset($_POST['breakfast'])|| $pets2 > 0 ) {

                foreach ($allezimmer as $key => $room) {
                    if (isset($_POST['park'])) {
                        $allezimmer[$key]['preisProTag'] = $allezimmer[$key]['preisProTag'] + $kostenparkplatz; // Update price to 150 for room 1
                    }
    
                    if(isset($_POST['breakfast'])) {
                        $allezimmer[$key]['preisProTag'] = $allezimmer[$key]['preisProTag'] + $kostenfruestueck; // Update price to 150 for room 1
                    }

                    if($pets2 > 0) {
                        $allezimmer[$key]['preisProTag'] = $allezimmer[$key]['preisProTag'] + $KostenTier;
                    }
                 }
    
            }
        }

  
    }

   
      
} 

$currentstep = 1

?>

<!DOCTYPE html>
<html lang="en">

<?php include 'inc/head.php'; ?>

<body>

    <?php
    include 'inc/navbar.php';
    ?>
    <div class="container main">


        <h1>Where to go next, <?php echo $_SESSION['vorname']; ?> </h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="auswahlcenter">
                <div class="row auswahl">

                    <div class="d-flex col-lg-3 col-sm-12">
                        <select value="test" name="zimmerart" type="text" class="form-control"
                            class="form-select form-select-sm" aria-label="Small select example" required>
                            <option value="1">Luxuszimmer</option>
                            <option value="2">Doppelzimmer</option>
                            <option value="3">Einzelzimmer</option>
                            <option value="4">Dreierzimmer</option>
                            <option value="5">Viererzimmer</option>
                            <option value="6">Präsidentensuite</option>


                        </select>
                    </div>
                    <div class="d-flex col-lg-4 col-sm-12">
                        <input class="form-control dropdown-toggle" type="text" id="mitwemreisen"
                            placeholder="Who are you traveling with?" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" onclick="removeDropdown2()">
                        </input>

                        <div class="dropdown">

                            <div id="dropdown" class="dropdown-menu p-4">
                                <div class="mb-2">
                                    <label for="exampleDropdownFormEmail2" class="form-label">Adults</label>
                                    <input class="btn btn-primary btn-sm" type="button"
                                        onclick="decreaseValue('adult');changePlace();" name='decqty' value="-">
                                    <input id="adult" type='text' size='1' name='adult' value='0' readonly />
                                    <input class="btn btn-primary btn-sm" type="button"
                                        onclick="increaseValue('adult');changePlace();" type="
                                        button" value="+">

                                </div>
                                <div class="mb-2">
                                    <label for="exampleDropdownFormPassword2" class="form-label">Children</label>
                                    <input class="btn btn-primary btn-sm" type="button"
                                        onclick="decreaseValue('child');changePlace();" name='decqty' value="-">
                                    <input id="child" type='text' size='1' name='child' value='0' readonly />
                                    <input class="btn btn-primary btn-sm" type="button"
                                        onclick="increaseValue('child');changePlace();" value="+" name='incqty'>

                                </div>
                                <div class="mb-2">
                                    <label for="exampleDropdownFormPassword2" class="form-label">Pets</label>
                                    <input class="btn btn-primary btn-sm" type="button" value="-"
                                        onclick="decreaseValue('pets');changePlace();" name='decqty'>
                                    <input id="pets" type='text' size='1' name='pets' value='0' readonly />
                                    <input type="button" class="btn btn-primary btn-sm" value="+"
                                        onclick="increaseValue('pets');changePlace();" name='incqty'>

                                </div>

                                <button type="button" data-toggle="dropdown" onclick="removeDropdown()"
                                    class="btn btn-primary">Done</button>
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

                        <input class="form-control dropdown-toggle" type="text" id="extrasauswahlen"
                            placeholder="Extras auswählen" data-bs-toggle="dropdown" data-bs-auto-close="false"
                            onclick="removeDropdown();">
                        </input>

                        <div class="dropdown">

                            <div id="dropdown2" class="dropdown-menu p-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="breakfast" value="breakfast"
                                        id="flexCheckDefault1" onclick="changeExtraPlace();">
                                    <label class="form-check-label" for="flexCheckDefault1">
                                        breakfast?
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="park" value="park"
                                        id="flexCheckDefault2" onclick="changeExtraPlace();">
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        parking lot?
                                    </label>
                                </div>

                                <button type="button" data-toggle="dropdown" onclick="removeDropdown2()"
                                    class="btn btn-primary">Done</button>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex col-lg-2 col-sm-12">
                        <button class="btn btn-primary btn-lg buttonform" type="getZimmer" id="getZimmer"
                            name="getZimmer">Search</button>
                    </div>
                </div>
            </div>
        </form>

        <?php if(isset($_POST['getZimmer']) && !isset($message)) : ?>


        <?php foreach ($allezimmer as $zimmer) : ?>
        <form action="buchen.php" method="post">
            <input type="hidden" name="zimmerID" value="<?php echo $zimmer['zimmerid'] ?>" />
            <input type="hidden" name="er" value="<?php echo $adults?>" />
            <input type="hidden" name="ch" value="<?php echo $children ?>" />
            <input type="hidden" name="pets" value="<?php echo $pets ?>" />
            <input type="hidden" name="park" value="<?php echo $park ?>" />
            <input type="hidden" name="break" value="<?php echo $break ?>" />
            <div class="zimmer">
                <img alt="zimmer" src="<?php echo $zimmer['bildpfad'] ?>">
                <h2><?php include 'inc/kategorieparser.php'; ?></h2>
                <p><?php echo $zimmer['beschreibung'] ?>
                </p>
                <h4><?php echo $zimmer['preisProTag'] .'€/night' ?></h4>
                <a target="_blank" href="<?php echo "zimmerinformation.php?id=" . $zimmer['zimmerid'] ?>">More
                    Informations</a>

                <button type="submit" name="book" class="bookdash btn btn-primary">Book</button></a>
            </div>
        </form>
        <?php endforeach; ?>
        <?php endif; ?>


        <?php include 'inc/errorhandler.php'; ?>





        <script>
        function changeExtraPlace() {
            var parkk = document.getElementById('flexCheckDefault1').checked;
            var breakk = document.getElementById('flexCheckDefault2').checked;

            if (!parkk && !breakk) {
                document.getElementById('extrasauswahlen').placeholder = "Any Extras?"
            } else {
                document.getElementById('extrasauswahlen').placeholder =
                    `Park: ${parkk} | Breakfast: ${breakk}`;
            }
        }

        function removeDropdown() {
            document.getElementById('dropdown').classList.remove('show');
        };

        function removeDropdown2() {
            document.getElementById('dropdown2').classList.remove('show');
        };

        function increaseValue(eleId) {
            var maxPets = 2;
            var value = parseInt(document.getElementById(eleId).value);
            value = isNaN(value) ? 0 : value;

            if (eleId === 'pets') {
                if (value < maxPets) {
                    value++
                    document.getElementById(eleId).value = value;
                }
            } else {
                value++

                document.getElementById(eleId).value = value;

            }

        };

        function decreaseValue(eleId) {
            var value = parseInt(document.getElementById(eleId).value, 10);
            value = isNaN(value) ? 0 : value;
            value--;
            if (value < 0) {
                document.getElementById(eleId).value = 0;
            } else {
                document.getElementById(eleId).value = value;

            }
        };

        function changePlace() {
            var pets = document.getElementById('pets').value;
            var adults = document.getElementById('adult').value;
            var children = document.getElementById('child').value;

            if (pets == 0 && adults == 0 && children == 0) {
                document.getElementById('mitwemreisen').placeholder = "Who are you traveling with?"
            } else {
                document.getElementById('mitwemreisen').placeholder =
                    `Adults: ${adults} | Kids: ${children} | Pets: ${pets}`;
            }

        };
        </script>


        <script type="text/javascript" src="js/picker.js"></script>


    </div>
    <?php
        include 'inc/footer.php';
        ?>



</body>

</html>