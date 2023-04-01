<?php
session_start();
include("connection.php");



   /* function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }*/
    if(isset($_POST['id']) && isset($_POST['password'])
        && isset($_POST['user']) && isset($_POST['re_password'])){

     $id = validate($_POST['id']);
     $username = validate($_POST['user']);
     $pass = validate($_POST['pass']);
     $re_password = validate($_POST['re_password']);

     $user_data = 'id=' . $id. '$username=' . $username;

     echo $user_data;

     if(empty($username)){
        header("Location:Location: signup.php?error=Username is Required&$user_data");
        exit();
     }else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
        exit();
    }else if(empty($id)){
        header("Location: signup.php?error=id is required&$user_data");
        exit(); 
    }else if(empty($re_pass)){
            header("Location: signup.php?error=Confirm Password is required&$user_data");
            exit();
    }else if(empty($pass !== $re_pass)){
                header("Location: signup.php?error=Confirmation password does not match&$user_data");
                exit();
     }else{

       // $sql = "select * from login where username = '$username' and password = '$password'";
       // $result = mysqli_query($conn, $sql);
       // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
       // $count = mysqli_num_rows($result);
     
   // if ($row["type"]== 1){
      //  header("Location:admin.php");

   // }
   // elseif($row["type"]=="0")
   // {
    //    header("Location: home.php");
   // }
    
   // else{
       // header("Location: signup.php");
       // exit();
   // } 
     }
}
?>