<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script></head>
<body>
            <div class="navbar">
                <img src="webimage/roboinfo.png" class="logo"><br><br>

                <ul>
                    <li><a href="intro-to-computers.php">Home</a></li>
                    <li><a href="lance.html">About Us </a></li>
                    <li><a href="#">Contact Us </a></li>
                    <li><a button onclick="logout()" style="cursor:pointer;">Logout</a></li>
                </ul>
            </div>
            <body>
        <div class="container">
        <h1>Users</h1>
                    <table class="table table-striped table-bordered">
                    <thead>
                          <tr>
                            <th>idnum</th>
                            <th>username</th>
                            <th>password</th>
                            <th>Role</th>
                          </tr>
                    </thead>
                    <tbody>
            <?php
              // Connect to the database
              
              

              // Check connection
              

              // Query the database
              $conn = new mysqli('localhost','root','','database1');
                  $sql = "SELECT * FROM login";
                  $result = $conn-> query($sql);
                  if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

              // Loop through the results and display them in the table
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row['idnum'] . "</td>";
                  echo "<td>" . $row['username'] . "</td>";
                  echo "<td>" . $row['password'] . "</td>";
                  echo "<td>" . $row['type'] . "</td>";
                  echo "<td>";
                  echo "<a href='update.php?id=" . $row['idnum'] . "' class='btn btn-primary'> Update </a>";
                  echo "<a href='delete.php?id=" . $row['idnum'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this user?\")'> Delete </a>";
                  echo "</td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
              }

              // Close the database connection
              mysqli_close($conn);
            ?>
            </tbody>
            </table>
        </div>
            
        <form method="POST" action="update.php">
          <input type="hidden" name="idnum" value="<?php echo $idnum; ?>">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
          </div>
          <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" class="form-control" id="type" name="tyoe" value="<?php echo $type; ?>">
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      


  <script>
  function logout() {
   
    window.location.replace("index.php");
    window.history.replaceState(null, null, "index.php");
  }
</script>
  
</body>
</html>
