<!DOCTYPE html>

<head>
  <link href="./loginsu.css" type="text/css" rel="stylesheet">
</head>

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