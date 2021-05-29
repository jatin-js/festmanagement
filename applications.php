<?php

include("db.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM `participants` WHERE `registrationid` ='$id'";
    mysqli_query($link, $query);
    $query = "DELETE FROM `registration` WHERE `id` ='$id'";
    mysqli_query($link, $query);
    $result = mysqli_query($link, $query);
}
if (isset($_GET['searchevents']) && $_GET['searchevents'] != '') {
    $searchevents = $_GET['searchevents'];
    $query =
        "SELECT * FROM `events` WHERE `name` LIKE '$searchevents%'";
} else {
    $query =
        "SELECT * FROM `events`";
}
$events = mysqli_query($link, $query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/930e580477.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <form action="applications.php" method="get">
            <input name='searchevents' class='searchevent' onchange="filterevents()" type="text" placeholder="Search" autofocus>
        </form>
        <a href="logout.php"><button style="float:right;" class="btn btn-success">Logout</button></a>
        <?php
        if (isset($_GET['searchevents'])) {
            $searchevents = $_GET['searchevents'];
            $query =
                "SELECT `id`, `name`, `category`, `timing`, `groupSize`, `feeHome`, `feeRemote`, `firstCashPrize`, `secondCashPrize`, `winnerreg`, `winnercontactno`, `runnerreg`, `runnercontactno`, `status`, `location` FROM `events` WHERE `name`='$searchevents'";
            mysqli_query($link, $query);
            // echo ($query);
        }
        ?>
        <div class="events">
            <div style="background:grey;height:40rem;overflow:scroll;">

                <?php
                while ($row = mysqli_fetch_array($events)) {
                ?>
                    <form action="applications.php" method="get">
                    <?php
                    echo ' <button value=' . str_replace(' ', '_', $row['name']) . '  type="submit" name="event" style="margin:10px; width:30rem;" class="btn btn-primary">' . $row['name'] . '</button>';
                }
                    ?>
                    </form>
            </div>

            <div class="eventreg">
                <?php
                if (isset($_GET['event'])) {
                    $event = str_replace('_', ' ', $_GET['event']);
                    // echo $event;
                    $query = "SELECT * FROM `registration`  WHERE `eventname`='$event'";
                    $reg = mysqli_query($link, $query);
                ?>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($row = mysqli_fetch_array($reg)) {

                                echo '<tr>';
                                echo '<td name="id" value=' . $row['id'] . '>' . $row['id'] . '</td>';
                                echo '<td>' . $row['name'] . '<div style="float:right;"><a href="applications.php?id=' . $row['id'] . '&event=' . str_replace(' ', '_', $row['eventname']) . '"><i style="color:red;" class="fa fa-trash" ></i></a></div>
                                    ' . '</td>';

                                echo '</tr>';
                            }

                            ?>

                        </tbody>

                    </table>
                <?php

                }

                ?>
            </div>
        </div>

    </div>
</body>

</html>