<?php
include("connection.php");
session_start();
if(isset($_POST['submit'])){
    $username = $_POST['user'];
    $password = $_POST['pass'];
  

    $sql = "select * from login where username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($row["type"]== 1){
        header("Location:admin.php");

    }
    elseif($row["type"]=="0")
    {   
        $_SESSION['userid']=$username;
        header("Location: home.php");
    }
    
    else{
        echo'<script>
        window.location.href="index.php";
        alert("Login failed. Invalid username or password!!!")
        </script>';
    } 
}
?>