<?php
session_start();
if(isset($_SESSION['id']) == FALSE) {
    header('location: login.php');
    exit();
}


define('SECURE', true);
require_once('inc/connect.php');



//https://stackoverflow.com/questions/53889927/easiest-way-to-check-if-multiple-post-parameters-are-set
$params_needed = ["id", "er", "ch",
                "pets", "park","break"];
  $given_params = array_keys($_GET);

  $missing_params = array_diff($params_needed, $given_params);

  if(!empty($missing_params)) {
    header('location: dashboard.php');
    exit();
  }
//https://stackoverflow.com/questions/53889927/easiest-way-to-check-if-multiple-post-parameters-are-set

$id = trim(htmlspecialchars($_GET['id']));
$adults = trim(htmlspecialchars($_GET['er']));
$children = trim(htmlspecialchars($_GET['ch']));
$pets = trim(htmlspecialchars($_GET['pets']));
$park = trim(htmlspecialchars($_GET['park']));
$break = trim(htmlspecialchars($_GET['break']));




if(isset($_GET['id'])) {

    $query = $db->prepare('SELECT `von`,`bis` from gebuchtezimmer WHERE zimmerid = ?;');
    $query->bind_param('i', $id);
    $query->execute();
    $alletermine = $query->get_result()->fetch_all(MYSQLI_ASSOC);

}

if(isset($_POST['buchen'])) {
    
    $kostenparkplatz = 10;
    $kostenfruestueck = 7;

        //check ob daten manipuliert wurden
        $query = $db->prepare('SELECT preisProTag, maxPerson, maxHaustier from zimmer WHERE zimmerid = ?');
        $query->bind_param('i',$id);
        $query->execute();
        $query->store_result();
        $query->bind_result($preisProTag, $maxPerson, $maxHaustier);
        
        $human = (int)$children + (int)$adults;
        
        if($human > $maxPerson) {
            //error
            exit();
        }

        if($pets > $maxHaustier) {
            //error
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
        
        $start = '01.01.2024';
        $end = '02.01.2024';

        $query = $db->prepare("
        
        SELECT * FROM gebuchtezimmer WHERE
        STR_TO_DATE(von, '%d.%m.%Y') <= STR_TO_DATE(:newEndDate, '%d.%m.%Y') AND
        STR_TO_DATE(bis, '%d.%m.%Y') >= STR_TO_DATE(:newEndDate, '%d.%m.%Y')
        
        ");

        $stmt->bindParam(':newStartDate', $start);
        $stmt->bindParam(':newEndDate', $end);

        $query->execute();

        $results = $query->get_results();

       
        if (!empty($results)) {
            //User hat etwas manipuliert oder (unwahrscheinlich fehler)
            exit();
        } else {
            
        }


        
  
  
    
}

   


$step = 1

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <link rel="stylesheet" href="style/style.css" type="text/css" />
    <title>Continental</title>
</head>

<body>

    <div class="main">
        <?php include 'inc/navbar.php';?>


        <div class="steps">
            <div class="center date">
                <h2>Wählen Sie ihren Zeitraum aus</h2>
                <input id="datepicker" />
                <button style="float: right; margin: 5px" class="btn btn-primary" type="bookingdate" id="bookingdate"
                    onclick="sSteps()" name="bookingdate">Weiter</button>
            </div>
        </div>


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
                    <p>Room Type: Luxuszimmer</p>
                    <p>Room Number: Room <?php echo $id; ?></p>
                    <p>Frühstück: <?php echo $break == 1 ? '✔️' : '❌'; ?> </p>
                    <p>Parkplatz: <?php echo $park == 1 ? '✔️' : '❌'; ?> </p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="details">
                        <p>Erwachsene: <?php echo $adults; ?></p>
                        <p>Kinder: <?php echo $children; ?></p>
                        <p>Haustiere: <?php echo $pets; ?></p>
                    </div>
                </div>

                <div class="col col-sm-auto">
                    <div class="gebucht">
                        <table>
                            <tr>
                                <th class="small text-muted pr-2" scope="row">Von</th>
                                <td style="float: right">31.12.2023</td>
                            </tr>
                            <tr>
                                <th class="small text-muted pr-2" scope="row">Bis</th>
                                <td style="float: right">08.01.2024</td>
                            </tr>
                            <tr>
                                <th class="small text-muted pr-2" scope="row">Subtotal</th>
                                <td style="float: right">1025 EUR</td>
                            </tr>
                            <tr>
                                <th class="small text-muted pr-2" scope="row">Voucher</th>
                                <td style="float: right"> -0 EUR</td>
                            </tr>
                            <tr>
                                <th class="small text-muted pr-2" scope="row"><b>Total</b></th>
                                <td style="float: right"><b>1025 EUR</b></td>
                            </tr>
                        </table>
                    </div>
                    <button id="booknow" class="btn btn-primary" type="bookingdate" id="bookingdate"
                        name="bookingdate">Jetzt Buchen</button>
                </div>
            </div>



        </div>





        <script>
        var step = 1;

        function sSteps() {
            var inhalte = document.getElementsByClassName("steps");
            inhalte[0].style.display = "none";
            var summary = document.getElementById("summary").classList.remove("block");
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