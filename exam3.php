<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database1";

$conn = mysqli_connect($servername, $username, $password, $dbname);

session_start();
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$questions = array(
    array(
        "question" => "What should you never share online without permission from a trusted adult?",
        "options" => array("Your full name", "Your favorite color", "Your favorite food"),
        "answer" => "Your full name"
    ),
    array(
        "question" => "What should you do if you receive a message from a stranger online?",
        "options" => array("Reply and share personal information", "Ignore and delete the message", "Meet them in person"),
        "answer" => "Ignore and delete the message"
    ),
    array(
        "question" => "Which of the following is a strong and secure password?",
        "options" => array("password123", "123456", "c@t$#Dog!23"),
        "answer" => "c@t$#Dog!23"
    ),
    array(
        "question" => "What should you do if you come across something online that makes you uncomfortable?",
        "options" => array("Share it with friends", "Keep it to yourself", "Tell a trusted adult"),
        "answer" => "Tell a trusted adult"
    ),
    array(
        "question" => "Why is it important to be careful about the information you share online?",
        "options" => array("It's fun to share personal information", "To protect your privacy and stay safe", "Everyone else is sharing"),
        "answer" => "To protect your privacy and stay safe"
    ),
    array(
        "question" => "What is cyberbullying?",
        "options" => array("Being kind to others online", "Sending a mean message to someone", "Helping someone with their homework"),
        "answer" => "Sending a mean message to someone"
    ),
    array(
        "question" => "What is the purpose of a privacy setting on social media?",
        "options" => array("To make your profile invisible to others", "To share your information with everyone", "To control who can see your posts"),
        "answer" => "To control who can see your posts"
    ),
    array(
        "question" => "What should you do if you see something online that looks suspicious or unsafe?",
        "options" => array("Click on it to investigate", "Share it with friends", "Report it to a trusted adult"),
        "answer" => "Report it to a trusted adult"
    ),
    array(
        "question" => "What does 'phishing' mean?",
        "options" => array("Fishing for actual fish", "Stealing personal information online", "Sharing photos with friends"),
        "answer" => "Stealing personal information online"
    ),
    array(
        "question" => "Why is it important to be kind and respectful to others online?",
        "options" => array("It's not important", "To make others feel bad", "To create a positive online environment"),
        "answer" => "To create a positive online environment"
    )
);



// to administer quiz and calculate score
function administer_quiz($conn, $questions) {
    $score = 0;
    $submitted = ($_SERVER["REQUEST_METHOD"] == "POST");

    // Create an array of shuffled question numbers
    $question_order = range(0, count($questions) - 1);
    shuffle($question_order);

    foreach ($question_order as $i) {
        $q = $questions[$i];

        echo "<p class='question'>Question : ".$q['question']."</p>";
        foreach ($q['options'] as $j => $option) {
            $is_correct = ($option == $q['answer']);
            $is_selected = ($submitted && isset($_POST['q'.($i+1)]) && $_POST['q'.($i+1)] == $option);
            $class = '';
            $style = 'font-family: Jura;';
            if ($submitted) {
                $class = ($is_correct ? 'correct' : 'incorrect');
                if ($is_correct) {
                    $style .= 'color: green;';
                } elseif ($is_selected) {
                    $style .= 'color: red;';
                }
            }
            echo "<div class='options $class'><input type='radio' name='q".($i+1)."' value='".$option."'".($is_selected ? ' checked' : '')."> <label style='$style'>".$option."</label></div>";
          }
          
        if ($submitted && isset($_POST['q'.($i+1)]) && $_POST['q'.($i+1)] == $q['answer']) {
            $score += 1;
        }
    }
    echo "<br><span class='score'>Your Final score is ".$score." out of ".count($questions).".</span>";
    
    
    // Insert username and score into database
    if ($submitted) {
        $username = $_SESSION['userid'];
        $sql = "INSERT INTO quiz_score3 (username, score) VALUES ('$username', '$score')";
        mysqli_query($conn, $sql);
    }
}


   
?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Quiz</title>
        <style>
            body {
                color: white;
            }
        </style>
    </head>
    <body> 
        <div class="box">
        
        <div class="form">
            
            <div class="links">
                
            <form method="post">
            <a href="home.php" id="home-btn">Home</a>
    <h1>Internet Safety Quiz</h1>
    <link rel="stylesheet" type="text/css" href="exam.css">
    <br><br>
    <?php administer_quiz($conn, $questions); ?>
    <br><br>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <a href="topic.php" id="topic-btn">Back to Topics</a>
    <?php else: ?>
        <input type="submit" value="Submit">
    <?php endif; ?>
</form>

</form>

          
            <style>
   .options input[type="radio"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border: 2px solid #555;
  border-radius: 50%;
  width: 12px;
  height: 12px;
  outline: none;
  cursor: pointer;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
  transition: all 0.3s ease-in-out;
  transform: translateZ(0);
}

.options input[type="radio"]:checked {
  background-color: #ff8c00;
  border-color: #ff8c00;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3), 0 0 10px rgba(255, 140, 0, 0.6);
  transform: translateZ(0) scale(1.1);
}

</style>



        </form>
    </body>
    </html>
