<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>FAQ</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="style/style.css" type="text/css" />
</head>

<body>

    <?php
  include 'inc/navbar.php';
  ?>
    <div class="bodyhelp">
        <h1>Frequently Asked Question</h1>

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Welche Zahlungsmethoden nehmen Sie an?
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Wir nehmen die gängigen Zahlungsmöglichkeiten - Visa, Mastercard,
                        AmericanExpress - an.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Darf ich mein Haustier mitnehmen?
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Haustiere sind in unserem Hotel <b>herzlichst</b> willkommen!
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Ich habe ein falsches Zimmer gebucht, was soll ich machen?
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"> Auf ihrem Dashboard können Sie ihre Buchung innerhalb 24h stornieren.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4">
                        Mein Hotelzimmer war bei der Ankunft beschädigt, was soll ich machen?
                    </button>
                </h2>
                <div id="flush-collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Bitte melden Sie sich bei der Rezeption des Hotels.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5">
                        Wie erfahre ich, ob das Hotel über freie Zimmer verfügt?
                    </button>
                </h2>
                <div id="flush-collapse5" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"> Sie können die Verfügbarkeit von Hotelzimmern direkt auf unserer
                        Website überprüfen. Geben Sie einfach Ihre Reisedaten und die Anzahl
                        der Gäste ein, und wir zeigen Ihnen verfügbare Zimmer und Preise
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse6" aria-expanded="false" aria-controls="flush-collapse6">
                        Was mache ich, wenn ich Hilfe oder Unterstützung benötige?
                    </button>
                </h2>
                <div id="flush-collapse6" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"> Auf ihrem Dashboard können Sie ihre Buchung innerhalb 24h stornieren.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse7" aria-expanded="false" aria-controls="flush-collapse7">
                        Ich habe ein falsches Zimmer gebucht, was soll ich machen?
                    </button>
                </h2>
                <div id="flush-collapse7" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"> A Wenn Sie Hilfe oder Unterstützung benötigen, zögern Sie nicht,
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