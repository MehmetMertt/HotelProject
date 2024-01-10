<?php

session_start();
define('SECURE', true);
require_once('inc/connect.php');
$admin = $_SESSION['isAdmin'];
if(isset($_SESSION['id']) == FALSE || $_SESSION['isAdmin'] == 0) {
    header('location: login.php');
    exit();
}


$query = $db->prepare('SELECT vname,nname,zimmerid,userid,von,bis,preis,wann,fruestueck,parkplatz,adults,pets,children,g.buchungsid
FROM `gebuchtezimmer` as g join buchungsdetails as b on g.buchungsid = b.buchungsid
join users as u on g.userid = u.id;');
$query->execute();
$allebuchungen = $query->get_result()->fetch_all(MYSQLI_ASSOC);


if(empty($allebuchungen)) {
    $message = "There are no reservation. ";
} 

if(isset($_GET['booking'])) {
    $bookingid = trim(htmlspecialchars($_GET['booking']));
    if(empty($_GET['booking']) == FALSE && is_numeric($_GET['booking']) == TRUE) {

        $query = $db->prepare('SELECT zimmerid,userid,von,bis,preis,wann,fruestueck,parkplatz,adults,pets,children,g.buchungsid
        FROM `gebuchtezimmer` as g join buchungsdetails as b on g.buchungsid = b.buchungsid WHERE g.buchungsid = ?');
        $query->bind_param('i',$bookingid);
        $query->execute();
        $query->store_result();
        
        if($query->num_rows == 1)
        {   
            $query->bind_result($id,$userid, $von, $bis, $totalprice,$wann,$break,$park,$adults,$pets,$children,$buchungsid);
            $query->fetch();

            
        } else {
            $message = "Please use a valid booking ID!";
        }
        
    } else {
        $message ="Please use a numberic booking ID!";
    }
}

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
    include 'inc/navbar.php';
    ?>

    <?php if(!isset($message) && !isset($_GET['booking'])) : ?>
    <?php $count = 0;?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">BookingID</th>
                <th scope="col">Room Number</th>
                <th scope="col">Name</th>
                <th scope="col">Date booked</th>
                <th scope="col">More Informationens</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allebuchungen as $buchung) : ?>
            <?php
                $count = $count + 1;
                ?>
            <tr>
                <th scope="row"><?php echo $count ?></th>
                <td><?php echo $buchung['buchungsid']; ?></td>
                <td><?php echo $buchung['zimmerid']; ?></td>
                <td><?php echo $buchung['vname'] . " " . $buchung['nname'] ; ?></td>
                <td><?php echo $buchung['wann']; ?></td>
                <td><a href="<?php echo "allereservierungen.php?booking=" . $buchung['buchungsid']; ?>">More
                        Information</a>
                </td>

            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>


    <?php if(isset($_GET['booking']) && isset($message) == FALSE) : ?>
    <div id="summary" class="summary container">
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
                            <td id="startDate" style="float: right"><?php echo $von;?></td>
                            <input type="hidden" id="startDateID" name="startDateID" value="" />

                        </tr>
                        <tr>
                            <th class="small text-muted pr-2" scope="row">Bis</th>
                            <td id="endDate" style="float: right"><?php echo $bis;?></td>
                            <input type="hidden" id="endDateID" name="endDateID" value="" />

                        </tr>
                        <tr>
                            <th class="small text-muted pr-2" scope="row"><b>Total</b></th>
                            <input type="hidden" id="preisProTag" name="preisProTag"
                                value="<?php echo $preisProTag; ?>" />
                            <td id="totalprice" style="float: right"><b><?php echo $totalprice . " EUR";?></b>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php
    include 'inc/footer.php';
    ?>


</body>


</html>