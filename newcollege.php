<?php
include('db.php');
$name = $_POST['collegename'];

function clean_string($string)
{
      $bad = array(";", "<", ">", "$");
      return str_replace($bad, "", $string);
}
$name = clean_string($name);
$sql = "INSERT INTO college(name) VALUES('$name')";
mysqli_query($link, $sql);
header('Location: onspot.php');
