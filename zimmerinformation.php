<?php
session_start();
if(isset($_SESSION['id']) == FALSE) {
    header('location: login.php');
    exit();
}


define('SECURE', true);
require_once('inc/connect.php');

if(isset($_GET['id'])) {
    $id = trim(htmlspecialchars($_GET['id'])); //


    $query = $db->prepare('SELECT zimmer_id, a.name FROM ausstattung a RIGHT JOIN
    zimmer_ausstattung za ON za.ausstattung_id  =  a.ausstattung_id WHERE zimmer_id = ?;');
    $query->bind_param('i',$id);
    $query->execute();
    $alleausstattungen = $query->get_result()->fetch_all(MYSQLI_ASSOC);

    if(empty($alleausstattungen)) {
        $message = "Invalid ID, Please provide a valid ID!";
    }

    $query = $db->prepare('SELECT `maxPerson`, `maxHaustier`, `kategorie`,bildpfad from `zimmer` as z left join zimmerbilder as zb on z.zimmerid=zb.zimmerId WHERE z.zimmerid = ?');
    $query->bind_param('i',$id);
    $query->execute();
    $query->store_result();
    $query->bind_result($maxPerson, $maxHaustier,$kategorie2,$bildpfad);
    $query->fetch();  
    


} else {
    $message = "Please try it again. ID is missing!";
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include 'inc/head.php'; ?>

<body>

    <?php include 'inc/navbar.php';?>

    <div class="container main">

        <div id="summary" class="summary container">

            <?php include 'inc/errorhandler.php'; ?>

            <?php if(isset($_GET['id']) && !isset($message)) :?>
            <h2>Informations about your room</h2>
            <hr>
            <div class="row justify-content-center text-center">
                <div class="col-auto col-xs-12">
                    <div>
                        <img src="<?php echo $bildpfad ?>" width="250px" alt="Hotelzimmer">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <p>Room Type: <b><?php include 'inc/kategorieparser.php';?></b></p>
                    <p>Room Number: <b>Room <?php echo $id; ?></b></p>
                    <input type="hidden" name="zimmerID" value="<?php echo $id; ?>" />
                    <p>Max Pets: <b><?php echo $maxHaustier ?></b></p>
                    <p>Max Persons: <b><?php echo $maxPerson ?></b></p>

                </div>

                <div class="col-md-3 col-sm-6">
                    <p><b>Room facilities</b></p>
                    <?php foreach($alleausstattungen as $ausstattung):?>
                    <p><?php echo $ausstattung['name'] ?></p>
                    <?php endforeach;?>
                </div>

            </div>
            <?php endif; ?>
        </div>

    </div>


    <?php include 'inc/footer.php'; ?>



</body>

</html>