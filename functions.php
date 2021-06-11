<?php
session_start();
include "./authenticate.php";

if (isset($_POST["login"])) {
	$username = $_POST["ID_Number"];
	$password = $_POST["Password"];
	$encodedPassword = md5($Password);

	$getUser = $db->prepare("SELECT * FROM accounts WHERE id-number=: ID_Number and password=:Password");
	$isLogin = $getUser->execute(array(
		"ID_Number" => $ID_Number,
		"password" => $encodedPassword
	));
	
	if ($getUser->rowCount() == 1) {
		$_SESSION["id-number"]=$ID_Number;
		header("Location:./welcome.html?status=signin");
		exit;
	} else {
		header("Location:./signin.html?status=notSignin");
		exit;
	}
}
?>