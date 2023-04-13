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
        "question" => "What is the part of a smartphone that we use to view information and interact with apps?",
        "options" => array("Camera", "Screen", "Battery"),
        "answer" => "Screen"
    ),
    array(
        "question" => "Which device do we use to connect to the internet wirelessly and access websites and apps?",
        "options" => array("Router", "Keyboard", "Printer"),
        "answer" => "Router"
    ),
    array(
        "question" => "What do we call the small portable device that can store and transfer digital files like documents and photos?",
        "options" => array("USB drive", "Mouse", "Monitor"),
        "answer" => "USB drive"
    ),
    array(
        "question" => "Which part of a computer or tablet do we use to type text and enter commands?",
        "options" => array("Mouse", "Keyboard", "Speakers"),
        "answer" => "Keyboard"
    ),
    array(
        "question" => "What do we call the part of a computer or smartphone that performs calculations and executes instructions?",
        "options" => array("CPU", "Memory", "Hard Drive"),
        "answer" => "CPU"
    ),
    array(
        "question" => "Which part of a computer or smartphone do we use to take pictures and record videos?",
        "options" => array("Speaker", "Camera", "Printer"),
        "answer" => "Camera"
    ),
    array(
        "question" => "What do we call the process of sending messages, pictures, and videos from one device to another over the internet?",
        "options" => array("Browsing", "Messaging", "Printing"),
        "answer" => "Messaging"
    ),
    array(
        "question" => "Which part of a computer or smartphone allows us to listen to music, watch videos, and hear sound effects?",
        "options" => array("Monitor", "Speaker", "Keyboard"),
        "answer" => "Speaker"
    ),
    array(
        "question" => "What is the term used for a website that contains a collection of articles, images, and videos that are regularly updated?",
        "options" => array("Search engine", "Blog", "Printer"),
        "answer" => "Blog"
    ),
    array(
        "question" => "Which part of a computer or smartphone do we use to navigate through web pages and apps?",
        "options" => array("Keyboard", "Mouse", "Touchscreen"),
        "answer" => "Touchscreen"
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
        $sql = "INSERT INTO quiz_score4 (username, score) VALUES ('$username', '$score')";
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
    <h1>Tech In Everyday Life Quiz</h1>
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
