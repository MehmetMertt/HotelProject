<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Loginn</title>
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
    <h1>Login</h1>

    <?php
    include 'inc/navbar.php';
    ?>

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
  </body>
</html>
