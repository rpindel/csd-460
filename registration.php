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
            $query = $connection->prepare("INSERT INTO useraccounts(email,fname,lname,telephone,password) VALUES (:email,:fname,:lname,:telephone,:password_hash,)");
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