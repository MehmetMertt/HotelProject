<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

    <link rel="stylesheet" href="style/style.css" type="text/css" />
    <title>Continental</title>
  </head>
  <body>


    <?php
    include 'inc/navbar.php';
    ?>

    <!---Head START-->
    <div class="container-fluid">
    <div class="row header">

      
      <div class="titlemain col-xs-12 text-center">
          <h1><b>Continental</b></h1>
          <h4><b>Continental - your home</b></h4>
      </div>

      <div class="bookdiv col-xs-12 text-center">
        <a class="booknow" href="#">BOOK NOW</a>
      </div>

        <div class="scroll">
          <a href=#feature><img src="img/scroll.gif" height="50px" width="auto"></a>
        </div>
      </div>
    </div>
    <!---Head END-->

  <!-- Feature Section START -->
    <section id="feature">
    <div class="container-fluid">
      <div class="row featured">
        <h2>Featured on</h2>
        <div class="col-4 newspaper">
          <img src="img/featured/forbes.png" alt="forbeslogo">
        </div>
        <div class="col-4 newspaper">
          <img src="img/featured/heute.png" alt="heutelogo">
        </div>
        <div class="col-4 newspaper">
          <img src="img/featured/spiegel.png" alt="spiegellogo">
        </div>
        <div class="col-4 newspaper">
          <img src="img/featured/guardian.png" alt="guardianlogo">
        </div>
        <div class="col-4 newspaper">
          <img src="img/featured/cnn.png" alt="cnnlogo">
        </div>
        <div class="col-4 newspaper">
          <img src="img/featured/thesun.png" alt="thesunlogo">
        </div>
      </div>
    </div>
  </section>
  <!--Feature Section END-->

    <div class="zimmer">
        <img src="img/hotelzimmer.jpg" alt="hotelzimmer">
        <p>
          Willkommen in unserer exquisiten Oase des Luxus, wo Stil und Raffinesse miteinander verschmelzen. Dieses außergewöhnliche 5-Sterne-Hotelzimmer bietet Ihnen den Inbegriff von Eleganz und Komfort. Der Augenblick, in dem Sie die Tür öffnen, offenbart einen atemberaubenden Blick auf die Skyline der Stadt, der durch die raumhohen Fenster hereinströmt und die wunderbar gestalteten Räume in ein helles Licht taucht.
Der großzügige Wohnbereich präsentiert eine harmonische Kombination aus modernem Design und traditioneller Handwerkskunst. Von den maßgefertigten Möbeln bis zum hochwertigen Teppichboden - jedes Detail verströmt Stil und Qualität.
Das Schlafzimmer ist ein Rückzugsort der Ruhe und Erholung. Ein luxuriöses Kingsize-Bett mit handgefertigter Bettwäsche aus ägyptischer Baumwolle verspricht himmlische Nächte. Die Auswahl an Premium-Kissen und Decken garantiert ultimativen Schlafkomfort.
        </p>
    </div>

  
  <div class="offer">
  <h1 class="title">Angebot</h1>
    <div class="card">
      <img src="img/gym.jpg" alt="gym">
      <h1>Gym</h1>
      <p>In all unseren Standorten, gibt es ein Fitnesstudio mit den modernsten Geräten.</p>
    </div>

    <div class="card">
      <img src="img/pool.jpg" alt="pool">
      <h1>Pool</h1>
      <p>Während ihren gesamten AUfenthalts, können Sie unseren Pool ohne weitere Kosten verwenden.</p>
    </div>

    <div class="card">
      <img src="img/breakfast.jpeg" alt="gym">
      <h1>Frühstück</h1>
      <p>Wir bieten Ihnen gratis Frühstück für Ihren gesamten Aufenthalt.</p>
    </div>
  </div>


  <footer>
    <div class="footer">
      <div class="footerflex">
      <ul class="nodec adress">
        <li><b>Hotel - The Continentel GmbH</b></li>
        <li>Ringstraße 01</li>
        <li>1010 Wien</li>
      </ul>

      <ul class="nodec number">
        <li><i class="bi bi-telephone-fill"></i>  +43 664 8342 23</li>
        <li><i class="bi bi-envelope-arrow-down-fill"></i>  info@The-Continental.at</li>
      </ul>
    </div>
      <hr>

      <ul class="nodec social">
        <li><a href=#><i class="bi bi-instagram"></i></a></li>
        <li><a href=#><i class="bi bi-facebook"></i></a></li>
        <li><a href=#><i class="bi bi-youtube"></i></a></li>
        <li><a href=#><i class="bi bi-twitter-x"></i></a></li>
        <li><a href="index.php">Startseite</a></li>
        <li><a href="impressum.php">Impressum</a></li>
        <li><a href="Datenschutz.php">Datenschutz</a></li>
      </ul>

    </div>




    <!---JS-->
    <script>
      // When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
      window.onscroll = function() {scrollFunction()};
      function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100){
        document.getElementById("navbar").classList.add("fixed")
      } else {
        document.getElementById("navbar").classList.remove("fixed")

      }
    }
      </script>
  </footer>

  </body>
</html>
