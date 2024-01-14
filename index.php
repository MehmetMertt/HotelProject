<!DOCTYPE html>
<html lang="en">


<?php include 'inc/head.php'; ?>


<body>


    <?php
    include 'inc/navbar.php';
    ?>

    <!---Head START-->
    <div class="container-fluid">
        <div class="row header">


            <div class="titlemain col-xs-12 text-center">
                <h1><b>Continental</b></h1>
                <h2><b>Continental - your hotel</b></h2>
            </div>

            <div class="bookdiv col-xs-12 text-center">
                <a class="booknow" href="dashboard.php">BOOK NOW</a>
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

    <div class="zimmer in">
        <img class="img-fluid" src="img/hotelzimmer.jpg" alt="hotelzimmer">
        <p>
            Welcome to our exquisite oasis of luxury, where style and sophistication blend together. This
            exceptional 5-star hotel room offers you the epitome of elegance and comfort. The moment you
            you open the door reveals a breathtaking view of the city skyline streaming in through the floor-to-ceiling
            windows.
            through the floor-to-ceiling windows, bathing the beautifully designed rooms in a bright light.
            The spacious living area presents a harmonious combination of modern design and traditional craftsmanship.
            craftsmanship. From the custom-made furniture to the high-quality carpeting - every detail exudes style and
            quality.
            style and quality.
            The bedroom is a retreat for rest and relaxation. A luxurious king-size bed with handcrafted
            Egyptian cotton bed linen promises heavenly nights. The selection of premium pillows and blankets
            guarantees the ultimate in sleeping comfort.
        </p>
    </div>


    <div class="offer">
        <h1 class="title">Offer</h1>
        <div class="card">
            <img src="img/gym.jpg" alt="gym">
            <h1>Gym</h1>
            <p>All our locations have a fitness studio with state-of-the-art equipment.</p>
        </div>

        <div class="card">
            <img src="img/pool.jpg" alt="pool">
            <h1>Pool</h1>
            <p>During your entire stay, you can use our pool at no extra cost.</p>
        </div>

        <div class="card">
            <img src="img/breakfast.jpeg" alt="gym">
            <h1>Breakfast</h1>
            <p>We offer the best breakfast from around the globe!</p>
        </div>
    </div>


    <?php
 include 'inc/footer.php'

?>



    <script>
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            document.getElementById("navbar").classList.add("fixed")
        } else {
            document.getElementById("navbar").classList.remove("fixed")

        }
    }
    </script>

</body>

</html>