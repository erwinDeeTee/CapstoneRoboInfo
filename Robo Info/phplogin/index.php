<?php
include("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robo Info Login</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body><div class="logo-container">
    <img src="webimage/roboinfo.png" class="logo">
    
  </div>
    <div class="box">
    <div class="form">
        
        <h1>Sign In</h1>
        <form name="form" action="login.php"    onsubmit="return isvalid()" method="POST">
        <div class="inputBox">
        <input type="text" id="user" name="user" required="required">
            <span>Username: </span>
                <i></i>
</div>
            <div class="inputBox">
            <input type="password" id="pass" name="pass" required="required">
             <span>Password:</span>
             <i></i>
</div>
            <div class="links">
               <a href="signup.php">Sign Up</a> 
</div>
            <input type="submit" id="btn" value="Login" name="submit"  />
</div>
</div>
</form>

<script>
    function isvalid(){
        var user = document.form.user.value;
        var pass = document.form.pass.value;
        if(user.length==""&& pass.length==""){
            alert("Username and password field is empty!!!");
            return false
        }
        else{
            if(user.length==""){
            alert("Username is empty!!!");
            return false
            }
            if(pass.length==""){
            alert("Password is empty!!!");
            return false
            }
        }
    }   
    </script>
</body>
</html>
