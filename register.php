<?php
require_once("utils/_init.php");
if (verify_post("username", "password", "confirm-password", "email") ){
  
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm-password"];
  $username = $_POST["username"];
  $email=trim($_POST["email"]);
  $users=$userStorage->findAll();

  // Password length
  if (strlen($password) < 5) {
    $errors[] = "Password must be at least 5 characters long";
  }

  // Passwords match
  if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match";
  }

  // username is not empty
  if (empty($username)) {
    $errors[] = "Username must not be empty";
  }

// email cannot be empty
  if (empty($email)) {
    $errors[] = "email address must not be empty";
  }
  // the form of the email address must be right
  if (!empty($_POST["email"])) {

    $email = trim(htmlspecialchars($_POST['email']));
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
  
    if ($email == false) {
      $errors[]="invalid Email address";
    }
    
     foreach($users as $user)
     {
       if($email==$user["email"])
       {
        $errors[] = "Email address already taken";
       }
     }
  
  }
  //checking whether the email address has been taken or not
  // If there were no errors...
  if (empty($errors)) {
    $successes[] = "Registration successful. Please log in.";
    save_to_flash("successes", $successes);
    
    // Register the new user
    $auth->register([
      "password" => $password,
      "username" => $username,
      "email"=>$email,
    ]);
    redirect("login.php");
  }
}

?>
<?php require("partials/header.inc.php") ?>
<?php require("partials/errors.inc.php") ?>
<h1>Register</h1>

<form class="col-md-6 col-xs-12" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input class="form-control" type="text" name="username" id="username" value="<?= $username ?? "" ?>">
  </div>
  
 

  <div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" type="text" name="email" id="email" value="<?= $email ?? "" ?>">
  </div>


  <div class="form-group">
    <label for="password">password</label>
    <input class="form-control" type="password" name="password" id="password" >
  </div>
  <div class="form-group">
    <label for="confirm-password">Confirm password</label>
    <input class="form-control" type="password" name="confirm-password" id="confirm-password">
  </div>
  <button class="btn btn-primary">Submit</button>
  <a href="login.php">If you have already registered, you can log in here</a>

 
</form>

<?php require("partials/footer.inc.php") ?>