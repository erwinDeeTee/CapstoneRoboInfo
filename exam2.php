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
        "question" => "What do we call a program that helps us do a specific task on the computer?",
        "options" => array("Software", "Application", "Hardware"),
        "answer" => "Application"
    ),
    array(
        "question" => "What do we call a set of instructions that tells the computer what to do?",
        "options" => array("Program", "Monitor", "Keyboard"),
        "answer" => "Program"
    ),
    array(
        "question" => "What do we call a program that helps us create and edit documents?",
        "options" => array("Microsoft Word", "Google Chrome", "Photoshop"),
        "answer" => "Microsoft Word"
    ),
    array(
        "question" => "What do we call a program that helps us browse the internet?",
        "options" => array("Google Chrome", "iTunes", "Microsoft Word"),
        "answer" => "Google Chrome"
    ),
    array(
        "question" => "What do we call a program that helps us edit and organize photos?",
        "options" => array("Microsoft Word", "Photoshop", "Google Chrome"),
        "answer" => "Photoshop"
    ),
    array(
        "question" => "What do we call a program that helps us listen to music and podcasts?",
        "options" => array("iTunes", "Google Chrome", "Microsoft Word"),
        "answer" => "iTunes"
    ),
    array(
        "question" => "What do we call a program that helps us send and receive emails?",
        "options" => array("Outlook", "Google Chrome", "Photoshop"),
        "answer" => "Outlook"
    ),
    array(
        "question" => "What do we call a program that helps us make calculations and work with numbers?",
        "options" => array("Microsoft Excel", "Photoshop", "Google Chrome"),
        "answer" => "Microsoft Excel"
    ),
    array(
        "question" => "What do we call a program that helps us play games on the computer?",
        "options" => array("Steam", "Outlook", "Photoshop"),
        "answer" => "Steam"
    ),
    array(
        "question" => "What do we call a program that helps us keep track of our daily tasks and appointments?",
        "options" => array("Microsoft Outlook", "Steam", "Google Chrome"),
        "answer" => "Microsoft Outlook"
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
        $sql = "INSERT INTO quiz_score2 (username, score) VALUES ('$username', '$score')";
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
    <h1>Software & App Quiz</h1>
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
