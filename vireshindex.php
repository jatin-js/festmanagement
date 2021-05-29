<?php
if (isset($_POST['submit'])) {
    include('db.php');
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = mysqli_query($link, "SELECT * FROM `appuser` WHERE `username`='$username' AND `password`='$password'");
    $num = mysqli_num_rows($query);
    if ($num == 1) {
        $_SESSION['username'] = $username;
        header("location:vireshlogin.php");
    } else {
        echo "Wrong Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Viresh login</title>
    <link type="text/css" rel="stylesheet" href="./css/login.css" />
</head>

<body>
    <form id="login" action="vireshindex.php" method="POST">
        <h1>Log In</h1>
        <fieldset id="inputs">
            <input id="username" type="text" placeholder="Username" name="username" autofocus required>
            <input id="password" type="password" placeholder="Password" name="password" required>
        </fieldset>
        <fieldset id="actions">
            <input name='submit' type="submit" id="submit" value="Log in">

        </fieldset>
    </form>

</body>

</html>