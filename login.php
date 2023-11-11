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
    <style>
      .center {
        color: black;
        text-align: center;
      }
      h1 {
        text-align: center;
        color: silver;
      }
    </style>
  </head>
  <body>
  <?php
    include 'inc/navbar.php';
    ?>


    <h1>Login</h1>
    <form action="login.php">
      <div class="center">
        <label for="user">Username:</label><br />
        <input type="text" id="user" name="user" required />
      </div>
      <br />
      <div class="center">
        <label for="password">Password:</label><br />
        <input type="password" id="password" name="password" required />
      </div>
      <div class="center">
        <button type="submit">Login</button>
      </div>
    </form>


    <?php
     include 'inc/footer.php' 
     ?>
     
  </body>
</html>
