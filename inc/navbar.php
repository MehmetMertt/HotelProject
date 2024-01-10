<?php


if(isset($_SESSION['id'])) {
    $directory = "upload/" . $_SESSION['id'];
    if(file_exists($directory) && file_exists($directory . '/pb.jpg')) {
        $pb = $directory . "/pb.jpg";
    } else{
     $pb = "upload/pb.png";
    }
}

?>

<nav id='navbar' class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img height="50px" src="img/logo.png"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <?php if(!(isset($_SESSION['id']))) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <?php endif; ?>

                <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) : ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Admin-Menü
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">News-Beitrage erstellen</a></li>
                        <li><a class="dropdown-item" href="users.php">User-Bearbeiten</a></li>
                        <li><a class="dropdown-item" href="allereservierungen.php">Alle Reservierungen</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">#</a></li>
                    </ul>
                </li>

                <?php endif; ?>


            </ul>
            <?php if(isset($_SESSION['id'])) : ?>


            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown dropstart">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img class="pb" style="height: 25px; width:25px" src="<?php echo $pb;?>">
                        <?php echo $_SESSION['vorname']; echo ' '; echo $_SESSION['nachname']; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="reservierung.php">My Reservations</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>

            <?php endif; ?>
        </div>
    </div>
</nav>