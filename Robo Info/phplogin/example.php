<?php
  // Start the session (if not already started)
  session_start();

  // Check if the user is logged in
  $logged_in = false;
  if (isset($_SESSION['user_id'])) {
    $logged_in = true;
  }

  // Construct the HTML code for the page
  $header = "<h1>My Website</h1>";
  if ($logged_in) {
    $header .= "<p>Welcome, " . $_SESSION['username'] . "!</p>";
    $header .= "<a href='logout.php'>Logout</a>";
  } else {
    $header .= "<a href='login.php'>Login</a>";
  }

  $html = "
    <!DOCTYPE html>
    <html>
      <head>
        <title>My Website</title>
      </head>
      <body>
        $header
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pretium diam eu tristique convallis.</p>
      </body>
    </html>
  ";

  // Output the HTML code
  echo $html;
?>