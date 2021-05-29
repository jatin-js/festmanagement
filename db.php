<?php
$link = mysqli_connect('localhost','root','root','fms');
if (!$link) {
	die('Could not connect: ' . mysqli_error($link));
}
	// mysqli_select_db("fms");
