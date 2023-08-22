<!DOCTYPE html>

<?php
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM useraccounts WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<p class="error">Username password combination is incorrect!</p>';
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['userid'] = $result['id'];
                echo '<p class="success">Congratulations, you are logged in!</p>';
            } else {
                echo '<p class="error">Username password combination is incorrect!</p>';
            }
        }
    }
?>

<form method="post" action="" name="signin-form">
  <div class="form-element">
    <label>Email Address</label>
    <input type="email" name="email" placeholder="Email Address" required />
  </div>
  <div class="form-element">
    <label>Password</label>
    <input type="password" name="password" required />
  </div>
  <button type="submit" name="login" value="login">Log In</button>
</form>