<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}
include('db.php');

if (isset($_POST['submit'])) {
    $oldname = $_SESSION['username'];
    $_SESSION['username'] = $_POST['name'];
    // echo $_SESSION['username'];
    $name = $_POST['name'];
    $password = md5($_POST['pwd']);
    $manager = $_POST['manager'];
    $mob = $_POST['mob'];
    $email = $_POST['email'];
    $money = $_POST['money'];
    $pmode = $_POST['pmode'];
    $query = "UPDATE `sponsors` SET `password`='$password',`name`='$name',`manager`='$manager',`mob`='$mob',`email`='$email',`money`='$money', `paymode`='$pmode' WHERE `name`='$oldname'";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo ("Details changed successfully!");
    } else echo ("Error occur");
}

$name = $_SESSION['username'];
// echo ($name);
$query = "SELECT * FROM `sponsors` WHERE `name`='$name'";
$detail = mysqli_query($link, $query);
$row = mysqli_fetch_array($detail);
$name = $row['name'];
$password = $row['password'];
$manager = $row['manager'];
// echo ($manager);
$mob = $row['mob'];
$email = $row['email'];
$money = $row['money'];
$pmode = $row['paymode'];

?>
<html lang="en">

<head>
    <title>Sponsor detail</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/nv.d3.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <script src="js/d3.min.js"></script>
    <script src="js/nv.d3.min.js"></script>


</head>

<body>
    <div class="container">
        <a href="logout.php"><button style="float:right;" class="btn btn-success">Logout</button></a>

        <form style="margin:10px;" action="sponsordetail.php" method="post">
            <div class="form-group">
                <label for="name">Company Name: </label>
                <input name='name' id='name' type="text" class="form-control" value="<?php echo ($name); ?>">
            </div>
            <div class="form-group">
                <label for="pwd">Password: </label>
                <input name='pwd' id='pwd' type="password" class="form-control" value="<?php echo ($password); ?>">
            </div>
            <div class="form-group">
                <label for="manager">Manager Name: </label>
                <input name='manager' id="manager" type="text" class="form-control" value="<?php echo ($manager); ?>">
            </div>
            <div class="form-group">
                <label for="mob">Mobile No.: </label>
                <input name='mob' id='mob' type="text" class="form-control" value="<?php echo ($mob); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email id: </label>
                <input name='email' id='email' type="text" class="form-control" value="<?php echo ($email); ?>">
            </div>
            <div class="form-group">
                <label for="money">Money: </label>
                <input name='money' id='money' type="text" class="form-control" value="<?php echo ($money); ?>">
            </div>
            <div class=" form-group">
                <label for="money">Payment Mode: </label>
                <select name="pmode" id="pmode">
                    <option <?php if ($pmode == "NEFT") echo 'selected'; ?> value="NEFT">NEFT</option>
                    <option <?php if ($pmode == "Cash") echo 'selected'; ?> value="Cash">Cash</option>
                    <option <?php if ($pmode == "Google pay") echo 'selected'; ?> value="Google pay">Google pay</option>
                    <option <?php if ($pmode == "Phone pay") echo 'selected'; ?> value="Phone pay">Phone pay</option>

                </select>
            </div>
            <input name='submit' value='Change Details' id='submit' type="submit" class="form-control">
        </form>
    </div>
</body>

</html>