<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}
include('db.php');
function clean_string($string)
{
    $bad = array(";", "<", ">", "$", "*");
    return str_replace($bad, "", $string);
}
if (!isset($_POST['dateto']) && !isset($_POST['datefrom']) && !isset($_POST['username'])) {
    echo "There were error(s) found with the form you submitted. ";
    die();
}
$timeto = clean_string($_POST['timeto']) . ":00";
$timefrom = clean_string($_POST['timefrom']) . ":00";
$dateto = clean_string($_POST['dateto']) . " ";
$datefrom = clean_string($_POST['datefrom']) . " ";
$username = clean_string($_POST['username']);
$query = mysqli_fetch_array(mysqli_query($link, "SELECT sum(amount) FROM `appuser_transactions` WHERE appuserid='$username' AND time BETWEEN '$datefrom.$timefrom' AND '$dateto.$timeto'"));

?>
<html lang="en">

<head>
    <title>Fest Management System</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/modernizr.custom.js"></script>
</head>

<body>
    <div id="header">
    </div>

    <div class="container">
        <div class="content">
            <nav class="dr-menu">
                <div class="dr-trigger"><span id="dr-icon" class="fa fa-bars"></span><a class="dr-label">Menu</a></div>
                <ul>
                    <li><a id="dr-icon" class="fa fa-compass" href="home.php">Dashboard</a></li>
                    <li><a id="dr-icon" class="fa fa-check-square-o" href="registration.php">Registration</a></li>
                    <li><a id="dr-icon" class="fa fa-bar-chart-o" href="reporting.php">Reporting</a></li>
                    <li><a id="dr-icon" class="fa fa-pencil" href="events.php">Events</a></li>
                    <li><a id="dr-icon" class="fa fa-phone" href="contact.php">Contact Us</a></li>
                    <li><a id="dr-icon" class="fa fa-power-off" href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div><!-- content -->
        <div style="margin:0 auto;width:1100px;color:black" id="block">
            <h4 style="width:14%; ">Search Results</h4>
            <br />
            <div id="insideblock" style="margin-left: 1rem;">
                <?php
                if ($query[0]) echo "Money collected:";
                else echo "No money collected";
                echo $query[0];
                ?>

            </div>
        </div>
    </div>

    <div id="footer">
        <p id="leftContent">Fest Management System</p>
    </div>
    <script src="js/ytmenu.js"></script>
</body>

</html>