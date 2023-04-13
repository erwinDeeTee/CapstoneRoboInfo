<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'database1';
$conn = mysqli_connect($host, $user, $password, $dbname);
?>
<?php
$sql = "SELECT * FROM quiz_score1 ORDER BY score DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    
    <link rel="stylesheet" href="leaderboard.css"/>
    <style>
    .gold {
        background: linear-gradient(to right, #ffcc33, #ffde00); 
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .silver {
        background: linear-gradient(to right, #d9d9d9, #c4c4c4); 
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .bronze {
        background: linear-gradient(to right, #ff884d, #ff6600); 
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>


</head>
<body>
    
    <section>
    <div class="banner">
        <div class="navbar">
             <br><br><a href="home.php" class="custom-link">Home</a> <div class="container">
        <div  class="box">
        

            <h3>Parts of the Computer</h3>
            
            <div class="list">
                <div class="imgBx">
                <?php
                $position = 1;
                while($row = mysqli_fetch_assoc($result)) {
                    $class = '';
                    if ($position == 1) {
                        $class = 'gold';
                    } elseif ($position == 2) {
                        $class = 'silver';
                    } elseif ($position == 3) {
                        $class = 'bronze';
                    }
                    echo "<p><span class='rank'>$position.</span> <span class='$class'>" . $row['username'] . "<span class='score'>" . $row['score'] . "</span></span></p>";


                    $position++;
                }
                ?>
            </div>
       
        </div>
    </section>
</body>
</html>
