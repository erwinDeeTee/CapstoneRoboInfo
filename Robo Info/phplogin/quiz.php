<?php
include("connection.php");
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Quiz App</title>
    
  
    <link rel="stylesheet" type="text/css" href="quiz.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
 
  <body>
  <img src="blackcity.jpg" alt="">
  
    <div class="box">
      
      <div class="form">
        <div class="links">
        <i class="fa-solid fa-arrow-left" id="arrow"></i>
      <a href="home.php" id="home-btn">Home</a> 
</div>
        <h1>Robo Info Quiz</h1>
        <div class="quiz">
         <form id="quiz-form" ></div>
       
         <div id="question" class="question"></div>
         <div id="answers" class="answer-buttons" ></div>
         
         <button id="next-btn">Next</button>
        <div id="score" class="score"></div>
          </form>
      </div>
    </div>
    <script src="quiz.js"></script>
     </body>
</html>