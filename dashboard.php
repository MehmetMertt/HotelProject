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
    $date = trim(htmlspecialchars($_POST['datepicker']));

    if(!empty($kategorie) && !empty($adults) && !empty($date)) {
        
        if(is_null($children)) {
            $children = 0;
        }
        $pets2 = (int)$pets;
        $human = (int)$adults;
        $kategorie2 = (int)$kategorie;

        #achtung auch zimmer geben wenn man 1 person 2er zimmer falls frei <= #DONE
        #limit 1 achtung
        $query = $db->prepare('SELECT `zimmerId` FROM `zimmer` WHERE `maxHaustier` <= ? AND `maxPerson` <= ? AND `kategorie` = ? limit 1');
        $query->bind_param('iii', $pets2, $human,$kategorie2);
        $query->execute();
        $query->store_result();
        $query->bind_result($id);

        if($query->num_rows == 1)
        {
            $query->fetch();
            echo "id: ";
            echo $id;
        }
        else
        {
            $error = 'Ihre Anmeldedaten sind nicht korrekt. Bitte wiederholen Sie Ihre Eingabe.';
        }

  
    } else {
        echo "Ok";
    }

   
      
} else {
    echo "Bitte alles ausfüllen";
}

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

    <?php
    include 'inc/navbar.php';
    ?>



    <div class="main">
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
                                placeholder="Mit wem reisen Sie?" data-bs-toggle="dropdown" data-bs-auto-close="false">
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
                            <!--<input type="text" class="form-control" placeholder="Wann reisen Sie?" aria-label="Datum"> --->
                            <input style="font-size: 15px;" id="datepicker" class="form-control dropdown-toggle"
                                type="text" id="dropdownMenuClickable" name="datepicker" placeholder="Wann reisen Sie?"
                                data-bs-toggle="dropdown" data-bs-auto-close="false" />
                            <input type="hidden" id="startDate">
                            <input type="hidden" id="endDate">
                        </div>
                        <div class="d-flex col-lg-3 col-sm-12">
                            <button style="width: 100%;" class="btn btn-primary btn-lg" type="getZimmer" id="getZimmer"
                                name="getZimmer">Suchen</button>
                        </div>
                    </div>
                </div>
            </form>

    </div>


    <?php if (!empty($_POST)): ?>

    <?php endif; ?>



    <div class="angebote">
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


    <script>
    const DateTime = easepick.DateTime;
    const bookedDates = [
        ['2023-12-25', '2023-12-30']
    ].map(d => {
        if (d instanceof Array) {
            const start = new DateTime(d[0], 'YYYY-MM-DD');
            const end = new DateTime(d[1], 'YYYY-MM-DD');

            return [start, end];
        }

        return new DateTime(d, 'YYYY-MM-DD');
    });

    const picker = new easepick.create({
        element: document.getElementById('datepicker'),
        css: [
            'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css',
        ],
        plugins: ['RangePlugin', 'LockPlugin'],
        LockPlugin: {
            minDate: new Date(),
            minDays: 1,
            inseparable: true,
            filter(date, picked) {
                if (picked.length === 1) {
                    const incl = date.isBefore(picked[0]) ? '[)' : '(]';
                    return !picked[0].isSame(date, 'day') && date.inArray(bookedDates, incl);
                }
                console.log(date.inArray(bookedDates, '[)'))
                return date.inArray(bookedDates, '[)');
            },
        }


    });
    </script>


    <?php
    include 'inc/footer.php';
    ?>



</body>

</html>