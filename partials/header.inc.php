
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking apppointments</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">ELTE Stadium</a>
<!---->
<!--    <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
<!--      <ul class="navbar-nav mr-auto">-->
<!--        <li class="nav-item active">-->
<!--          <a class="nav-link" href="index.php">Slot information</a>-->
<!--        </li>-->
<!--      </ul>-->
      <?php if ($auth->is_authenticated()): // If there is a user logged in ?>
        <a class="btn btn-primary" href="logout.php">Log out (<?= $auth->authenticated_user()["username"] ?>)</a>
      <?php else: ?>
        <a class="btn btn-primary" href="login.php">Log in</a>
      <?php endif; ?>
    </div>
  </nav>

  <div class="container py-3">