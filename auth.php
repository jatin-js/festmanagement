<?php
session_start();
include('db.php');
$username = $_POST['username'];
$password = md5($_POST['password']);
$query = mysqli_query($link, "SELECT * FROM appuser WHERE username='$username' AND password='$password'");
$num = mysqli_num_rows($query);
if ($num == 1) {
	$_SESSION['username'] = $username;
	header("location:login_success.php");
} else {
	echo "Wrong Username or Password";
}
