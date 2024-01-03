<?php

session_start();
define('SECURE', true);
require_once('inc/connect.php');
if(isset($_SESSION['id']) == FALSE) {
    header('location: login.php');
    exit();
}

$id = $_SESSION['id'];

$query = $db->prepare('SELECT zimmerid,userid,von,bis,preis,wann,fruestueck,parkplatz,adults,pets,children,g.buchungsid
FROM `gebuchtezimmer` as g join buchungsdetails as b on g.buchungsid = b.buchungsid  WHERE `userid` = ?');
$query->bind_param('i',$id);
$query->execute();
$allebuchungen = $query->get_result()->fetch_all(MYSQLI_ASSOC);


if(empty($allebuchungen)) {
    $message = "There is no reservation. Go book your next <a href=\"dashboard.php\">stay</a>";
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

    <?php if(!isset($message)) : ?>
    <?php
      $count = 0;  
    ?>
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
                <td><a href="<?php echo "reservierung.php?booking=" . $buchung['buchungsid']; ?>">More Information</a>
                </td>

            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <?php
    include 'inc/footer.php';
    ?>

</body>

<script>

</script>

</html>