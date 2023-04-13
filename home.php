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
 
  <div class="dropdown">
    <button onclick="myFunction()">Ranking &#9662;</button>
    <div id="myDropdown" class="dropdown-content">
      <a href="leaderboard.php">History of the Computer</a>
      <a href="leaderboard1.php">Parts of the computer</a>
      <a href="leaderboard2.php">Softwares and Application</a>
      <a href="leaderboard3.php">Internet Safety</a>
      <a href="leaderboard4.php">Technology in Everyday Life</a>
    
    </div>
  </div>
</li>

<script>
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropdown button')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}document.addEventListener("click", function(e) {
  // Check if the click target is a dropdown button
  if (e.target.matches(".dropdown button")) {
    // Toggle the "active" class of the parent dropdown element
    e.target.closest(".dropdown").classList.toggle("active");
  } else {
    // Hide all dropdowns if the click is outside of a dropdown button
    document.querySelectorAll(".dropdown").forEach(function(dropdown) {
      dropdown.classList.remove("active");
    });
  }
});

</script>
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
