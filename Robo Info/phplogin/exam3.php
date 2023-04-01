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
        "question" => "A Part of the computer that displays the output on the screen",
        "options" => array("Mouse", "Keyboard", "Monitor"),
        "answer" => "Monitor"
    ),
    array(
        "question" => "What Alphabets touches the pinky finger in the keyboard",
        "options" => array("QAZ", "WSX", "Spacebar"),
        "answer" => "QAZ"
    ),
    array(
        "question" => "What is the brain of the computer?",
        "options" => array("Printer", "CPU", "Speaker"),
        "answer" => "CPU"
    ),
    array(
        "question" => "When was the first computer invented?",
        "options" => array("1872", "1992", "1945"),
        "answer" => "1945"
    ),
    array(
        "question" => "Who invented the computers?",
        "options" => array("Albert Einstein", "Charles Babbage", "Blaise Pascal"),
        "answer" => "Charles Babbage"
    ),
    array(
        "question" => "Which of the following is not a point device",
        "options" => array("Mouse", "Pen", "Keyboard"),
        "answer" => "Keyboard"
    ),
    array(
        "question" => "_____ is the founder of facebook",
        "options" => array("Mark Zuckerberg", "Daniel Ek"," George Washington" ),
        "answer" => "Mark Zuckerberg"
    )
    ,
    array(
        "question" => "What is the meaning of ROM in Computer",
        "options" => array("Range of Motion", "Read-Only Memory", "Reading Of Motherboard"),
        "answer" => "Read-Only Memory"
    ),
    array(
        "question" => "What is the meaning of RAM in Computer",
        "options" => array("Random Access Memory", "Running Acquired Memory", "Reading Available Monitor "),
        "answer" => "Random Access Memory"
    ),
    array(
        "question" => "Do you think you can pass the exam?",
        "options" => array("Yes", "No", "Maybe"),
        "answer" => "No"
    )
);

// to administer quiz and calculate score
function administer_quiz($conn, $questions) {
    $score = 0;
    $submitted = ($_SERVER["REQUEST_METHOD"] == "POST");
    
    foreach ($questions as $i => $q) {
        echo "<p class='question'>Question ".($i+1).": ".$q['question']."</p>";
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
    echo "<br><span class='score'>Your Final score is ".$score." out of 10.</span>";
    
    
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
