<?php
	$idnum = $_POST['idnum'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	

	
	$conn = new mysqli('localhost','root','','database1');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		
		$stmt = $conn->prepare("INSERT INTO login (`idnum`, `username`, `password`) VALUES (?, ?, ?)");
		$stmt->bind_param("iss", $idnum, $user, $pass,);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
		if ($execval) {
			
			echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
			exit;
		} else {
			echo "Registration failed.";
		}
	}
?>