<?php
require_once("utils/_init.php");

if (verify_post("email", "password")) {
  $email = trim($_POST["email"]);
  $password = $_POST["password"];

 // look for the email address of this person
  $email = $auth->authenticate_email($email, $password);
  // If the user is not found
  if ($email === NULL) {
    $errors[] = "Invalid username or password";
  }

  // If there were no errors...
  if (empty($errors)) {
    // Log in the user
    $auth->login($email);
    redirect("index.php");
  }
}

?>
<?php require("partials/header.inc.php") ?>
<?php require("partials/errors.inc.php") ?>
<h1>Log in</h1>

<form class="col-md-6 col-xs-12" method="post">
  <div class="form-group">
    <label for="username">Email</label>
    <input class="form-control" type="text" name="email" id="email" value="<?= $email ?? "" ?>">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input class="form-control" type="password" name="password" id="password">
  </div>
  <button class="btn btn-primary">Log in</button>
  <a href="register.php">If you don't have an account, you can register here.</a>

 
</form>

<?php require("partials/footer.inc.php") ?>