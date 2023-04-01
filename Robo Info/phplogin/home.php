<?php
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robo Info Homepage</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    
</head>
<body>
    <div class="banner">
    <div class="navbar">
  <img src="webimage/roboinfo.png" class="logo"><br><br>

  <ul>
    <li><a href="intro-to-computers.php">Home</a></li>
    <?php
            $logged_in = false;
            if (isset($_SESSION['userid'])) {
              $logged_in = true;
            }

            $header = "";
            if ($logged_in) {
                $header .= "<a href='profile.php'>Profile</a>";
            } else {
                $header .= "<a href='login.php'>Error</a>";
            }
     ?>
     <li><?php echo $header; ?></li>

    <li><a href="lance.html">About Us</a></li>
    <li class="dropdown">Contact Us
      <div class="dropdown-content">
        <p>Email: agtoto.sirlancelot@roboinfo.com</p>
        <p>Email: delatorre.erwin@roboinfo.com</p>
      </div>
    </li>
    <li><a button onclick="logout()" style="cursor:pointer;">Logout</a></li>
  </ul>
</div>

        <div class="content">
            <h1 id="welcome-message">Welcome <?php echo $_SESSION['userid']; ?></h1>
            <p>Robo Info is an educational app that focuses on teaching children about computers, technologies, and their history. The app provides interactive lessons and activities that help young learners develop their skills and knowledge in these areas. Additionally, Robo Info features quizzes that allow children to test their understanding of the topics they have learned and reinforce their learning. With Robo Info, children can develop valuable skills and knowledge that will help them succeed in our increasingly digital world.</p>
     <style>
        p{
            font-family:'Jura';
            font-size: 15px;
        }
     </style>
            <div> 
                <button type="button" onclick="window.location.href='quiz.php'"><span></span>Take the Quiz!</button>
                <button type="button" onclick="window.location.href='topic.php'"><span></span>Topics</button>
            </div>
        </div>
    </div>

    <script>
        function logout() {
            window.location.replace("index.php");
            window.history.replaceState(null, null, "index.php");
        }

        const welcomeMessage = document.getElementById('welcome-message');
        window.addEventListener('load', () => {
            setTimeout(() => {
                welcomeMessage.classList.add('typing');
            }, 1000);
        });
    </script>
</body>
</html>
