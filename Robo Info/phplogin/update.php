<?php
// Connect to the database

$conn = new mysqli('localhost','root','','database1');

// Check connection
                
                  if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

// Get the form data
$idnum = $_POST['idnum'];
$username = $_POST['username'];
$password = $_POST['password'];
$type = $_POST['type'];

// Update the record in the database
$sql = "UPDATE login SET username='$username', password='$password', type='$type' WHERE idnum=$idnum";
$result = $conn-> query($sql);
if ($result($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>