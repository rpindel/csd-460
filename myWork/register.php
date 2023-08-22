<!DOCTYPE html>

<head>
  <link href="./loginsu.css" type="text/css" rel="stylesheet">
</head>

<?php
    session_start();
    include('config.php');
    if (isset($_POST['register'])) {
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $telephone = $_POST['telephone'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM useraccounts WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo '<p class="error">The email address is already registered!</p>';
        }
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO useraccounts(email,fname,lname,telephone,password) VALUES (:email,:fname,:lname,:telephone,:password_hash)");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("fname", $fname, PDO::PARAM_STR);
            $query->bindParam("lname", $lname, PDO::PARAM_STR);
            $query->bindParam("telephone", $telephone, PDO::PARAM_STR);
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
                echo '<p class="success">Your registration was successful!</p>';
            } else {
                echo '<p class="error">Something went wrong!</p>';
            }
        }
    }
?>

<form method="post" action="" name="signup-form">
  <div class="form-element">
    <label>Email Address</label>
    <input type="email" name="email" required />
  </div>
  <div class="form-element">
    <label>First Name</label>
    <input type="text" name="fname" required />
  </div>
  <div class="form-element">
    <label>Last Name</label>
    <input type="text" name="lname" required />
  </div>
  <div class="form-element">
    <label>Telephone</label>
    <input type="tel" name="telephone" 
      pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required />
  </div>
  <div class="form-element">
    <label>Password</label>
    <input type="password" name="password" required />
  </div>
  <div class="form-element">
    <label>Confirm Password</label>
    <input type="password" name="password" required />
  </div>
  <button type="submit" name="register" value="register">Register</button>
</form>