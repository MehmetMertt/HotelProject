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
        <h1>Frequently Asked Question</h1>

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Which payment methods do you accept?
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">We accept the most common payment methods - Visa, Mastercard,
                        AmericanExpress - are accepted.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Can I take my pet with me?
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">A maximum of 2 pets are <b>welcome</b> in our hotel!
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        I booked the wrong room, what should I do?
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Please contact our support
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4">
                        My hotel room was damaged on arrival, what should I do? </button>
                </h2>
                <div id="flush-collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Please contact the hotel reception.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5">
                        How do I find out if the hotel has rooms available?
                    </button>
                </h2>
                <div id="flush-collapse5" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">You can check the availability of hotel rooms directly on our
                        website. Simply enter your travel dates and the number of
                        of guests and we will show you available rooms and prices
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse6" aria-expanded="false" aria-controls="flush-collapse6">
                        What do I do if I need help or support? </button>
                </h2>
                <div id="flush-collapse6" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Feel free to get in touch with one of our staff members!
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse7" aria-expanded="false" aria-controls="flush-collapse7">
                        I booked the wrong room, what should I do?
                    </button>
                </h2>
                <div id="flush-collapse7" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">If you need help or support, please do not hesitate to contact us,
                        unseren
                        Kundenservice zu kontaktieren. Sie erreichen uns per Telefon oder
                        E-Mail, und wir sind rund um die Uhr für Sie da, um Ihre Fragen zu
                        beantworten und Ihnen zu helfen.
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include 'inc/footer.php'; ?>

</body>

</html>