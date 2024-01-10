<?php

session_start();
if(isset($_SESSION['id']) == FALSE) {
    header('location: login.php');
    exit();
}

define('SECURE', true);
require_once('inc/connect.php');



if(!isset($_GET['read'])) {
    $id = $_SESSION['id'];

    $query = $db->prepare('SELECT LEFT(body, 100) AS textview, news_id, title, `image`, `date`, author_id FROM news
    order by `date` desc;');
    $query->execute();
    $allenewsartikel = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    
    
    if(empty($allenewsartikel)) {
        $message = "There is currently no news.";
    }
    
} else {
    $read_id = trim(htmlspecialchars($_GET['read']));

    $query = $db->prepare('SELECT body,news_id, title, `image`, `date`, users.vname  FROM news
    left join users on news.author_id = users.id 
    where news_id = ?;');
    $query->bind_param('i', $read_id);
    $query->execute();
    $query->store_result();

    if($query->num_rows >= 0) {
        $query->bind_result($text, $newsid, $title,$bild,$datum,$author);

        $query->fetch();

     } else {
        $message = "There is a error with the news article!";
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
    include 'inc/navbar.php'
    ?>

    <div class="container">
        <div class="row">
            <?php if(!isset($message) && !isset($_GET['read'])) :?>
            <?php foreach ($allenewsartikel as $news) : ?>
            <div class="news col-3">
                <img src="<?php echo $news['image']; ?>" alt="News Titelbild">
                <h3><?php echo $news['title']; ?></h3>
                <p class="newsdatum"><?php echo $news['date']; ?></p><br>
                <p class="newsinhalt"><?php echo $news['textview'] . "..."; ?> </p>
                <a class="gotonews btn btn-primary" href="news.php?read=<?php echo $news['news_id'];?>" role="
                    button">Read</a>
            </div>
            <?php endforeach;?>
            <?php endif; ?>

        </div>
    </div>

    <?php if(!isset($message) && isset($_GET['read'])) :?>
    <div class="d-flex justify-content-center">
        <div class="read">
            <h2><?php echo $title; ?></h2>
            <span class="date"><?php echo $datum; ?></span>
            <span class="author">by <?php echo $author; ?></span>
            <br>
            <img class="img-fluid" src="<?php echo $bild; ?>" alt="titelbild" height="400" width="auto">
            <p><?php echo $text; ?>
            </p>
        </div>
    </div>
    <?php endif; ?>


    <?php 
    include 'inc/footer.php'
    ?>

</body>

<script>
function edit(n) {
    var x = document.getElementsByClassName('editdata')[n]
    if (x.classList.contains("block")) {
        x.classList.remove("block");
    } else {
        x.classList.add("block");
    }
}
</script>

</html>