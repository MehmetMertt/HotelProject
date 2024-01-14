<?php

session_start();
define('SECURE', true);
require_once('inc/connect.php');
if(isset($_SESSION['id']) == FALSE) {
    header('location: login.php');
    exit();
}

$id = $_SESSION['id'];

if(isset($_GET['own'])) {
    $ownprofile = trim(htmlspecialchars($_GET['own']));
} else {
    $ownprofile = 1;
}


if((int)$ownprofile == 1 || $_SESSION['isAdmin'] == 0) {
    $query = $db->prepare('SELECT zimmerid,userid,von,bis,preis,wann,fruestueck,parkplatz,adults,pets,children,g.buchungsid
    FROM `gebuchtezimmer` as g join buchungsdetails as b on g.buchungsid = b.buchungsid  WHERE `userid` = ?');
    $query->bind_param('i',$id);
} else{
    if($_SESSION['isAdmin'] == 1) {
        $query = $db->prepare('SELECT zimmerid,userid,von,bis,preis,wann,fruestueck,parkplatz,adults,pets,children,g.buchungsid
        FROM `gebuchtezimmer` as g join buchungsdetails as b on g.buchungsid = b.buchungsid');
    }
}

$query->execute();
$allebuchungen = $query->get_result()->fetch_all(MYSQLI_ASSOC);


if(empty($allebuchungen)) {
    $message = "There is no reservation. Go book your next <a href=\"dashboard.php\">stay</a>";
} 

if(isset($_GET['booking'])) {
    $bookingid = trim(htmlspecialchars($_GET['booking']));
    if(empty($_GET['booking']) == FALSE && is_numeric($_GET['booking']) == TRUE) {

        if($_SESSION['isAdmin'] == 1) {
            $query = $db->prepare('SELECT zimmerid,userid,von,bis,preis,wann,fruestueck,parkplatz,adults,pets,children,g.buchungsid
            FROM `gebuchtezimmer` as g join buchungsdetails as b on g.buchungsid = b.buchungsid WHERE g.buchungsid = ?');
            $query->bind_param('i',$bookingid);
        } else {
            $query = $db->prepare('SELECT zimmerid,userid,von,bis,preis,wann,fruestueck,parkplatz,adults,pets,children,g.buchungsid
            FROM `gebuchtezimmer` as g join buchungsdetails as b on g.buchungsid = b.buchungsid WHERE g.buchungsid = ? AND g.userid = ?');
            $query->bind_param('ii',$bookingid,$id);
        }
        
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

$query = $db->prepare('SELECT kategorie,bildpfad from zimmer as z left join zimmerbilder as zb on z.zimmerid=zb.zimmerId WHERE z.zimmerid = ?;');
$query->bind_param('i', $id);
$query->execute();
$query->bind_result($kategorie2,$bildpfad);
$query->fetch();  

?>

<!DOCTYPE html>
<html lang="en">


<?php include 'inc/head.php'; ?>


<body>

    <?php
    include 'inc/navbar.php';
    ?>

    <?php if(!isset($message) && !isset($_GET['booking'])) : ?>
    <?php
      $count = 0;  
    ?>
    <div class="container" style="overflow-x:auto;">
        <h1>Your reservations</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">BookingID</th>
                    <th scope="col">Room Number</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
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
                    <td><?php echo $buchung['von']; ?></td>
                    <td><?php echo $buchung['bis']; ?></td>
                    <td><a href="<?php echo "reservierung.php?booking=" . $buchung['buchungsid']; ?>">More
                            Information</a>
                    </td>

                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>


    <?php include 'inc/roominfo.php'?>


    <?php
    include 'inc/footer.php';
    ?>

</body>

<script>

</script>

</html>