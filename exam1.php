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
        "question" => "What is the brain of the computer called?",
        "options" => array("Monitor", "Keyboard", "CPU"),
        "answer" => "CPU"
    ),
    array(
        "question" => "Which part of the computer stores your files for a long time?",
        "options" => array("Memory", "Hard Drive", "Mouse"),
        "answer" => "Hard Drive"
    ),
    array(
        "question" => "What do we call the screen of the computer?",
        "options" => array("CPU", "Hard Drive", "Monitor"),
        "answer" => "Monitor"
    ),
    array(
        "question" => "What do we use to type on the computer?",
        "options" => array("Mouse", "Keyboard", "Printer"),
        "answer" => "Keyboard"
    ),
    array(
        "question" => "Which part of the computer do we use to move the cursor on the screen?",
        "options" => array("Mouse", "Keyboard", "Monitor"),
        "answer" => "Mouse"
    ),
    array(
        "question" => "What do we call the computer's short-term memory?",
        "options" => array("CPU", "Memory", "Hard Drive"),
        "answer" => "Memory"
    ),
    array(
        "question" => "Which part of the computer do we use to click and select items on the screen?",
        "options" => array("Keyboard", "Mouse", "Printer"),
        "answer" => "Mouse"
    ),
    array(
        "question" => "What is the most important part of the computer?",
        "options" => array("Monitor", "Keyboard", "CPU"),
        "answer" => "CPU"
    ),
    array(
        "question" => "Which part of the computer do we use to see what we are typing?",
        "options" => array("Keyboard", "Mouse", "Monitor"),
        "answer" => "Monitor"
    ),
    array(
        "question" => "What part of the computer do we use to hear sounds and music?",
        "options" => array("Monitor", "Keyboard", "Speakers"),
        "answer" => "Speakers"
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
        $sql = "INSERT INTO quiz_score1 (username, score) VALUES ('$username', '$score')";
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
    <h1>Parts of the Computer Quiz</h1>
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
