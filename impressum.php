<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'inc/head.php'; ?>


<body>

    <?php
    include 'inc/navbar.php';
    ?>


    <div class="container">
        <h1 class="margin">Impressum The Continental</h1>
        <section>
            <ul style="list-style-type: none">
                <li><b>The Continental GmbH</b></li>
                <li>Gesellschaft mit beschränkter Haftung</li>
                <br />
                <li>Hotel</li>
                <li>UID-Nr: ATU34567892</li>
                <li>FN: 826328a</li>
                <br>
                <li>FB-Gericht: Wien</li>
                <li>Sitz: 1010 Wien</li>
                <br>
                <li>Tel: +43 664 8342 232</li>
                <li>
                    <a href="mailto:info@The-Continental.at">info@The-Continental.at</a>
                </li>
                <br>
                <li>Mitglied der WKÖ, WKNÖ</li>
                <li>Gewerbeordnung <a href="www.ris.bka.gv.at">ris.bka.gv.at</a></li>
                <li>Bezirkshauptmannschaft Wien</li>
                <li>
                    <p>
                        Verbraucher haben die Möglichkeit, Beschwerden an die Online-
                        Streitbeilegungsplattform der EU zu richten:
                        <a href="http://ec.europa.eu/odr">www.ec.europa.eu/odr</a> Sie
                        können allfällige Beschwerde auch an die oben angegebene
                        E-Mail-Adresse richten
                    </p>
                </li>
            </ul>
        </section>

        <p class="font">Die Geschäftsführer </p>
        <div class="container-impressum">





            <figure class="figure">
                <img src="img\mehmet.png" alt="Mehmet Mert" height="200px" width="auto">
                <figcaption class="figure-caption">Mehmet Mert</figcaption>
            </figure>



            <figure class="figure">
                <img src="img\flo.png" alt="Mehmet Mert" height="200px" width="auto">
                <figcaption class="figure-caption">Florian Korcian</figcaption>
            </figure>

        </div>

    </div>
    <?php
     include 'inc/footer.php' 
     ?>
</body>

</html>