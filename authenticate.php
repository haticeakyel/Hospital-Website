<?php
session_start();

$servername = "localhost";
$DATABASE_NAME = "hospital_system";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $DATABASE_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

if ( !isset($_POST['id-number'], $_POST['password']) ) {
	exit('Please fill both the username and password fields!');
}
 

$stmt = $conn->prepare("SELECT * FROM accounts WHERE ID_Number=? AND Password=?"); 
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('is', $_POST['id-number'],$_POST['password']);
    // $stmt->bind_param('s', $_POST['password']);
	$stmt->execute();
    $stmt->store_result();
    


    if ($stmt->num_rows > 0) {
        echo $_POST['id-number'];
        header("Location:./welcome.html");
    } else {
        // Incorrect username
        header("Location:./signin.html");

    }


	$stmt->close();

?>

