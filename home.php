<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location:index.php");
}
include('db.php');
$topevents = mysqli_query($link, "SELECT eventname,count(id) FROM `registration` WHERE paid=1 group by eventname order by count(id) desc limit 10");
$clgparticipation = mysqli_query($link, "SELECT collegename,count(id) FROM `registration` WHERE paid=1 group by collegename order by count(id) desc limit 6");
$deptparticipation = mysqli_query($link, "SELECT r.dept,count(r.id) FROM `registration` r WHERE r.paid=1 and r.dept<>'' group by r.dept order by count(r.id) desc limit 6");
$winners = mysqli_query($link, "SELECT r.collegename,count(r.id) FROM registration r,events e WHERE paid=1 and r.id=e.winnerreg group by r.collegename order by count(r.id) desc limit 6");
$runners = mysqli_query($link, "SELECT r.collegename,count(r.id) FROM registration r,events e WHERE paid=1 and r.id=e.runnerreg group by r.collegename order by count(r.id) desc limit 6");
?>
<html lang="en">

<head>
  <title>Fest Management System</title>
  <meta charset="UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/nv.d3.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script src="js/modernizr.custom.js"></script>
  <script src="js/d3.min.js"></script>
  <script src="js/nv.d3.min.js"></script>


</head>

<style>
  body {
    background-image: url("images/fest.jpg");
    background-attachment: cover;
    background-position: center;
  }
</style>

<body>
  <div id="header">
  </div>

  <div class="container">
    <div class="content">
      <nav class="dr-menu">
        <div class="dr-trigger"><span id="dr-icon" class="fa fa-bars"></span><a class="dr-label">Menu</a></div>
        <ul style="background: black">
          <li><a id="dr-icon" class="fa fa-compass" href="home.php">Dashboard</a></li>
          <li><a id="dr-icon" class="fa fa-check-square-o" href="registration.php">Registration</a></li>
          <li><a id="dr-icon" class="fa fa-bar-chart-o" href="reporting.php">Reporting</a></li>
          <li><a id="dr-icon" class="fa fa-pencil" href="events.php">Events</a></li>
          <li><a id="dr-icon" class="fa fa-phone" href="contact.php">Contact Us</a></li>
          <li><a id="dr-icon" class="fa fa-power-off" href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div><!-- content -->
    <div style="margin:0 auto;width:1100px; background:white;opacity:0.8;" id="block">
      <h4 style=" width:10%; margin-left:23px;">Dashboard</h4>

      <div id="insideblock">

        <h3>Top Events</h3>
        <div style="height:300px; width:100%;">

          <?php while ($row = mysqli_fetch_array($topevents)) {
            echo $row[0] . ' ' . $row[1] . '<br>';
          } ?>
        </div>

        <h3 style="float:left; width:50%;">College Participation Report</h3>
        <h3 style="float:left; width:50%;">Internal Department Participation Report</h3>
        <div class="clgParticipation" style="height:300px; float:left; width:50%;">
          <?php while ($row = mysqli_fetch_array($clgparticipation)) {
            echo $row[0] . ' ' . $row[1] . '<br>';
            // echo '"value" :' . $row[1] . '';
          } ?>
        </div>

        <div style="height:300px; float:left; width:50%;">
          <?php while ($row = mysqli_fetch_array($deptparticipation)) {
            echo $row[0] . ' ' . $row[1] . '<br>';
          } ?>
        </div>
        <h3 style="float:left; width:50%;">Winner Report</h3>
        <h3 style="float:left; width:50%;">Runner-up Report</h3>
        <div id="chart4" style="height:300px; float:left; width:50%;">
          <?php while ($row = mysqli_fetch_array($winners)) {
            echo $row[0] . ' ' . $row[1] . '<br>';
          } ?>
        </div>
        <div id="chart5" style="height:300px; float:left; width:50%;">
          <?php while ($row = mysqli_fetch_array($runners)) {
            echo $row[0] . ' ' . $row[1] . '<br>';
          } ?>
        </div>

        </>
      </div>
    </div>

    <div id="footer">
      <p id="leftContent">Fest Management System</p>
    </div>

    <script>
      let a = document.querySelector('.clgParticipation');
      a.innerHTML = exampleData2;
      example2 = () => {

        <?php while ($row = mysqli_fetch_array($runners)) {
          echo "{";
          echo '"label" : "' . $row[0] . '" ,';
          echo '"value" :' . $row[1] . '';
          echo "},";
        } ?>

      }
    </script>
    <script src="js/ytmenu.js"></script>
</body>

</html>