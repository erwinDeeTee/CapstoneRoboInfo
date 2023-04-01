<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robo Info Sign Up</title>
    <link rel="stylesheet" type="text/css" href="signup.css"> 
</head>
<body><body><div class="logo-container">
    <img src="webimage/roboinfo.png" class="logo">
    
  </div>

    <div class="box">
    <div class="form">
        <h1>Sign Up</h1>
        <form action="config.php" method="post">
        <div class="inputBox">
            <input type="text" id="idnum" name="idnum" required="required">
             <span>ID #: </span>
             <i></i>
</div>
        <div class="inputBox">
            <input type="text" id="user" name="user" required="required">
             <span>Username:</span>
             <i></i>
</div>
            <div class="inputBox">
            <input type="password" id="pass" name="pass" required="required">
             <span>Password</span>
             <i></i>
</div>
<div class="inputBox">
    <input type="password" id="confirm-pass" name="confirm-pass" required="required">
    <span>Confirm Password:</span>
    <i></i>
</div>
<script>
    function validatePassword() {
        var password = document.getElementById("pass").value;
        var confirmPassword = document.getElementById("confirm-pass").value;

        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }

    var form = document.querySelector("form");
    form.onsubmit = validatePassword;
</script>
<div class="links">
<a href="index.php">Already have an account?</a>

</div>

            <input type="submit" id="btn" value="Register" name="register" >
            
</div>
</div>
</body>