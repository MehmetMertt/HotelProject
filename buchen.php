<?php
session_start();
if(isset($_SESSION['id']) == FALSE) {
    header('location: login.php');
    exit();
}


define('SECURE', true);
require_once('inc/connect.php');

//https://www.php.net/manual/en/function.checkdate.php#113205
function validateDate($date, $format = 'd.m.Y')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
//https://www.php.net/manual/en/function.checkdate.php#113205




$kostenparkplatz = 10;
$kostenfruestueck = 7;

if(isset($_POST['book'])) {

    //https://stackoverflow.com/questions/53889927/easiest-way-to-check-if-multiple-post-parameters-are-set
    $params_needed = ["zimmerID", "er", "ch",
                    "pets", "park","break"];
    $given_params = array_keys($_POST);

    $missing_params = array_diff($params_needed, $given_params);

    if(!empty($missing_params)) {
        header('location: dashboard.php');
        exit();
    }
    //https://stackoverflow.com/questions/53889927/easiest-way-to-check-if-multiple-post-parameters-are-set

    $id = trim(htmlspecialchars($_POST['zimmerID']));
    $adults = trim(htmlspecialchars($_POST['er']));
    $children = trim(htmlspecialchars($_POST['ch']));
    $pets = trim(htmlspecialchars($_POST['pets']));
    $park = trim(htmlspecialchars($_POST['park']));
    $break = trim(htmlspecialchars($_POST['break']));
    $voucher = 0;
    $query = $db->prepare('SELECT `preisProTag` from `zimmer` WHERE `zimmerId` = ?');
    $query->bind_param('i',$id);
    $query->execute();
    $query->store_result();
    $query->bind_result($preisProTag);
    $query->fetch();  

    
    if($park == 1) {
        $preisProTag = $preisProTag + $kostenparkplatz;
    }

    if($break == 1) {
        $preisProTag = $preisProTag + $kostenfruestueck;
    }

}




if(isset($_POST['zimmerID'])) {

    $query = $db->prepare('SELECT `von`,`bis` from gebuchtezimmer WHERE zimmerid = ?;');
    $query->bind_param('i', $id);
    $query->execute();
    $alletermine = $query->get_result()->fetch_all(MYSQLI_ASSOC);

}

if(isset($_POST['booking'])) {

    
    //https://stackoverflow.com/questions/53889927/easiest-way-to-check-if-multiple-post-parameters-are-set
    $params_needed = ["fruestueck", "parkplatz", "adults",
    "children", "pets","startDateID", "endDateID", "zimmerID"];
    $given_params = array_keys($_POST);

    $missing_params = array_diff($params_needed, $given_params);

    if(!empty($missing_params)) {
        header('location: dashboard.php');
        exit();
    }
    //https://stackoverflow.com/questions/53889927/easiest-way-to-check-if-multiple-post-parameters-are-set


    $id = (trim(htmlspecialchars($_POST['zimmerID'])));
    $adults = trim(htmlspecialchars($_POST['adults']));
    $children = trim(htmlspecialchars($_POST['children']));
    $pets = trim(htmlspecialchars($_POST['pets']));
    $park = trim(htmlspecialchars($_POST['parkplatz']));
    $break = trim(htmlspecialchars($_POST['fruestueck']));


        //check ob daten manipuliert wurden
        $query = $db->prepare('SELECT `preisProTag`, `maxPerson`, `maxHaustier`, `kategorie` from `zimmer` WHERE `zimmerId` = ?');
        $query->bind_param('i',$id);
        $query->execute();
        $query->store_result();
        $query->bind_result($preisProTag, $maxPerson, $maxHaustier,$kategorie2);
        $query->fetch();  
        
        $human = (int)$children + (int)$adults;
        
        if($human > $maxPerson) {
            header("location: dashboard.php");
            exit();
        }

        if($pets > $maxHaustier) {
            header("location: dashboard.php");
            exit();
        }

        //check ob preis manipuliert wurde

        
        //preis server-seitig berechnen
        if($park == 1) {
            $preisProTag = $preisProTag + $kostenparkplatz;
        }

        if($break == 1) {
            $preisProTag = $preisProTag + $kostenfruestueck;
        }

        //freier termin server-seitig überprüfen
        
        $start = trim(htmlspecialchars($_POST['startDateID']));
        $end = trim(htmlspecialchars($_POST['endDateID']));

        if(validateDate($start) == false || validateDate($end) == false) {
            header("location: dashboard.php");
            exit();
        }

        $query = $db->prepare("SELECT * FROM gebuchtezimmer WHERE
        STR_TO_DATE(von, '%d.%m.%Y') <= STR_TO_DATE(?, '%d.%m.%Y') AND
        STR_TO_DATE(bis, '%d.%m.%Y') >= STR_TO_DATE(?, '%d.%m.%Y') AND zimmerid = ?
        ");

        $query->bind_param('sss',$start,$end,$id);


        $query->execute();

        $results = $query->get_result();
        
       
        if ($results->num_rows != 0) {
            //User hat etwas manipuliert
            header("location: dashboard.php");
            exit();
        }
            
        $query = $db->prepare('INSERT INTO `gebuchtezimmer` (zimmerid, userid, von, bis) VALUES (?, ?, ?, ?);');
        $query->bind_param('iiss',$id,$_SESSION['id'],$start,$end);
        $query->execute();
        $buchungsid = $query->insert_id;

        $query = $db->prepare('INSERT INTO `buchungsdetails` (preis, buchungsid, cardid, wann,fruestueck,parkplatz,adults,pets,children) 
        VALUES (?, ?, ?, ?,?,?,?,?,?);');

        $date = date('Y-m-d H:i:s');

        $newStart = new DateTime($start);
        $newEnd = new DateTime($end);

        $anzahltage = $newStart->diff($newEnd)->format("%a");
        $preis = $preisProTag * (int)$anzahltage;
        $carid = 0;

        $query->bind_param('iiisiiiii',$preis,$buchungsid,$carid,$date,$break,$park,$adults,$pets,$children);
        $query->execute();

        
        header("location: dashboard.php");
        
        echo "Zimmer gebucht :)";
        
  
    
}

   
$query = $db->prepare('SELECT kategorie from zimmer WHERE zimmerid = ?;');
$query->bind_param('i', $id);
$query->execute();
$query->bind_result($kategorie2);
$query->fetch();  

?>

<!DOCTYPE html>
<html lang="en">

<?php include 'inc/head.php'; ?>


<body>

    <div class="main">
        <?php include 'inc/navbar.php';?>


        <div class="steps">
            <div class="center date">
                <h2>Wählen Sie ihren Zeitraum aus</h2>
                <input id="datepicker" />
                <button style="float: right; margin: 5px" class="btn btn-primary" type="bookingdate" id="bookingdate"
                    onclick="sSteps(); getDates();" name="bookingdate">Weiter</button>
            </div>
        </div>


        <form method="post" action="buchen.php">
            <div id="summary" class="summary container block">
                <h2>Booking Summary</h2>
                <hr>
                <div class="row">
                    <div class="col-auto col-xs-12">
                        <div>
                            <img src="upload/hotelrooms/3.jpg" width="250px" alt="Hotelzimmer">
                        </div>
                        <div>
                            <button id="roomdetails" class="btn btn-primary" type="bookingdate" id="bookingdate"
                                name="bookingdate">See room
                                details</button>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <p>Room Type: <?php include 'inc/kategorieparser.php';?></p>
                        <p>Room Number: Room <?php echo $id; ?></p>
                        <input type="hidden" name="zimmerID" value="<?php echo $id; ?>" />
                        <p>Frühstück:
                            <?php echo $break == 1 ? '✔️' : '❌'; ?> </p>
                        <input type="hidden" name="fruestueck" value="<?php echo $break; ?>" />

                        <p>Parkplatz: <?php echo $park == 1 ? '✔️' : '❌'; ?> </p>
                        <input type="hidden" name="parkplatz" value="<?php echo $park; ?>" />

                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="details">
                            <p>Erwachsene: <?php echo $adults; ?></p>
                            <input type="hidden" name="adults" value="<?php echo $adults; ?>" />
                            <p>Kinder: <?php echo $children; ?></p>
                            <input type="hidden" name="children" value="<?php echo $children; ?>" />
                            <p>Haustiere: <?php echo $pets; ?></p>
                            <input type="hidden" name="pets" value="<?php echo $pets; ?>" />
                        </div>
                    </div>

                    <div class="col col-sm-auto">
                        <div class="gebucht">
                            <table>
                                <tr>
                                    <th class="small text-muted pr-2" scope="row">Von</th>
                                    <td id="startDate" style="float: right"></td>
                                    <input type="hidden" id="startDateID" name="startDateID" value="" />

                                </tr>
                                <tr>
                                    <th class="small text-muted pr-2" scope="row">Bis</th>
                                    <td id="endDate" style="float: right"></td>
                                    <input type="hidden" id="endDateID" name="endDateID" value="" />

                                </tr>
                                <tr>
                                    <th class="small text-muted pr-2" scope="row">Price/Tag</th>
                                    <td id="priceperday" style="float: right"><?php echo $preisProTag . " EUR"; ?></td>
                                </tr>
                                <tr>
                                    <th class="small text-muted pr-2" scope="row"><b>Total</b></th>
                                    <input type="hidden" id="preisProTag" name="preisProTag"
                                        value="<?php echo $preisProTag; ?>" />
                                    <td id="totalprice" style="float: right"><b></b>
                                    </td>
                                </tr>
                            </table>
                            <button id="booknow" class="btn btn-primary" type="submit" id="booking" name="booking">Jetzt
                                Buchen</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



    </div>





    <script>
    function getDates() {
        let Syyyy = picker.getStartDate().getFullYear();
        let Smm = picker.getStartDate().getMonth() + 1;
        let Sdd = picker.getStartDate().getDate();

        if (Sdd < 10) Sdd = '0' + Sdd;
        if (Smm < 10) Smm = '0' + Smm;

        const startDate = Sdd + '.' + Smm + '.' + Syyyy;


        document.getElementById('startDate').innerHTML = startDate;
        document.getElementById('startDateID').value = startDate;

        let Eyyyy = picker.getEndDate().getFullYear();
        let Emm = picker.getEndDate().getMonth() + 1;
        let Edd = picker.getEndDate().getDate();

        if (Edd < 10) Edd = '0' + Edd;
        if (Emm < 10) Emm = '0' + Emm;

        const endDate = Edd + '.' + Emm + '.' + Eyyyy;

        document.getElementById('endDate').innerHTML = endDate;
        document.getElementById('endDateID').value = endDate;

        const von = new Date(Syyyy, Smm, Sdd);
        const bis = new Date(Eyyyy, Emm, Edd);

        var anzahlDerNaechte = Math.round(Math.abs((von - bis) / (24 * 60 * 60 *
            1000)));

        var preis = anzahlDerNaechte * parseInt(document.getElementById('preisProTag').value);

        document.getElementById('totalprice').innerHTML = preis.toString() + " EUR";
    }

    var step = 1;

    function sSteps() {

        if (picker.getStartDate() == null && picker.getEndDate() == null) {

        } else {
            var inhalte = document.getElementsByClassName("steps");
            inhalte[0].style.display = "none";
            var summary = document.getElementById("summary").classList.remove("block");
        }

    }


    function isWithin(date, start, end) {
        return date.isAfter(start) && date.isBefore(end);
    }



    const testDates = <?php echo json_encode($alletermine); ?>;
    const bookedDates = [];

    for (var i = 0; i < testDates.length; i++) {
        var vonSplit = testDates[i].von.split(".");
        var
            newVon = new Date(+vonSplit[2], vonSplit[1] - 1, +vonSplit[0]);
        var
            bisSplit = testDates[i].bis.split(".");
        var newBis = new Date(+bisSplit[2], bisSplit[1] - 1,
            +bisSplit[0]); // const start=new Date(newVon); // Assuming von is a valid date string
        //const end=new Date(newBis); // Assuming bis is a valid date string
        bookedDates[i] = [newVon, newBis];
    }
    const DateTime = easepick.DateTime;
    bookedDates.map(d => {
        if (d instanceof Array) {
            const start = new DateTime(d[0], 'DD.MM.YYYY');
            const end = new DateTime(d[1], 'DD.MM.YYYY');

            return [start, end];
        }

        return new DateTime(d, 'DD.MM.YYYY');
    });
    const picker = new easepick.create({
        element: document.getElementById('datepicker'),
        format: 'DD.MM.YYYY',
        lang: 'de-DE',
        css: [
            'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css',
            'https://easepick.com/css/demo_hotelcal.css',
        ],
        plugins: ['RangePlugin', 'LockPlugin'],
        RangePlugin: {
            tooltipNumber(num) {
                return num - 1;
            },
            locale: {
                one: 'night',
                other: 'nights',
            },
        },
        LockPlugin: {
            minDate: new Date(),
            minDays: 0,
            inseparable: true,
            filter(date, picked) {
                return bookedDates.some(([start, end]) => date.isSameOrAfter(start, 'day') &&
                    date
                    .isSameOrBefore(end, 'day'));
            },
        }
    });
    </script>



    </div>
    <?php include 'inc/footer.php';?>



</body>



</html>