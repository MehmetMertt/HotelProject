<?php

session_start();

define('SECURE', true);
require_once('inc/connect.php');



if(!isset($_GET['read'])) {

    $query = $db->prepare('SELECT LEFT(body, 100) AS textview, news_id, title, `image`, UNIX_TIMESTAMP(`date`), author_id FROM news
    order by `date` desc;');
    $query->execute();
    $allenewsartikel = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    
    
    if(empty($allenewsartikel)) {
        $message = "There is currently no news.";
    }
    
} else {
    $read_id = trim(htmlspecialchars($_GET['read']));

    $query = $db->prepare('SELECT body,news_id, title, `image`, UNIX_TIMESTAMP(`date`), users.vname  FROM news
    left join users on news.author_id = users.id 
    where news_id = ?;');
    $query->bind_param('i', $read_id);
    $query->execute();
    $query->store_result();

    if($query->num_rows > 0) {
        $query->bind_result($text, $newsid, $title,$bild,$datum,$author);

        $query->fetch();

     } else {
        $message = "There is a error with the news article!";
     }


}



    ?>

<!DOCTYPE html>
<html lang="en">


<?php include 'inc/head.php'; ?>


<body>

    <?php
    include 'inc/navbar.php'
    ?>


    <?php if(isset($message)): ?>
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php endif; ?>
    <?php if(isset($messageErfolg)): ?>
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show">
            <strong>Error!</strong> <?php echo $messageErfolg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php endif; ?>


    <div class="container">
        <div class="row">
            <?php if(!isset($message) && !isset($_GET['read'])) :?>
            <?php foreach ($allenewsartikel as $news) : ?>
            <?php
                $newsview = $news['textview'];
                $newsview = preg_replace('/&[^;]+;/', '', $newsview);
                $newsview = preg_replace('/<h1(.*?)<\/h1>/', '', $newsview);
            ?>
            <div class="news col-3">
                <img src="<?php echo $news['image']; ?>" alt="News Titelbild">
                <h3><?php echo $news['title']; ?></h3>
                <span class="newsdatum"><?php echo date('d.m.Y H:i',$news['UNIX_TIMESTAMP(`date`)']); ?></span><br>
                <span class="newsinhalt"><?php echo $newsview . "..."; ?></span><br>
                <a class="gotonews btn btn-primary" href="news.php?read=<?php echo $news['news_id'];?>" role="
                    button">Read</a><br>
            </div>
            <?php endforeach;?>
            <?php endif; ?>

        </div>
    </div>

    <?php if(!isset($message) && isset($_GET['read'])) :?>
    <div class="d-flex justify-content-center">
        <div class="read">
            <h2><?php echo $title; ?></h2>
            <span
                class="date"><?php echo "Posted at <b>" . date('d.m.Y H:i', $datum) . "</b> by <b>" . $author . "</b>" ?></span>
            <span class="author"></span><br>
            <img src="<?php echo $bild; ?>" alt="titelbild">

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