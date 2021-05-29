<?php

include("db.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM `sponsors` WHERE `id` ='$id'";
    $result = mysqli_query($link, $query);
}
if (isset($_GET['submit'])) {
    $name = $_GET['name'];
    $manager = $_GET['manager'];
    $mob = $_GET['mob'];
    $email = $_GET['email'];
    $money = $_GET['money'];
    $pmode = $_GET['pmode'];
    $pwd = md5("root");
    $query = "INSERT INTO `sponsors`(`password`,`name`, `manager`, `mob`,`email`, `money`, `paymode`) VALUES ('$pwd', '$name','$manager','$mob','$email','$money', '$pmode')";
    mysqli_query($link, $query);
    // if (mysqli_query($link, $query)) echo ('Sponsor added');
    // else echo ('Error occur.');
}
if (isset($_GET['searchsponsor']) && $_GET['searchsponsor'] != '') {
    $searchsponsor = $_GET['searchsponsor'];
    $query =
        "SELECT * FROM `sponsors` WHERE `name` LIKE '$searchsponsor%'";
} else {
    $query =
        "SELECT * FROM `sponsors`";
}
$spon = mysqli_query($link, $query);


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

        <?php
        // if (isset($_GET['searchevents'])) {
        //     $searchevents = $_GET['searchevents'];
        //     $query =
        //         "SELECT `id`, `name`, `category`, `timing`, `groupSize`, `feeHome`, `feeRemote`, `firstCashPrize`, `secondCashPrize`, `winnerreg`, `winnercontactno`, `runnerreg`, `runnercontactno`, `status`, `location` FROM `events` WHERE `name`='$searchevents'";
        //     mysqli_query($link, $query);
        // echo ($query);
        // }


        ?>
        <div class="events">
            <a href="logout.php"><button style="float:right;" class="btn btn-success">Logout</button></a>

            <h2>Add sponsors</h2>
            <form class="form-group" action="sponsors.php" method="get">
                <div class="form-group">
                    <input name='name' type="text" placeholder="Name" required>
                </div>

                <div class="form-group">

                    <input name="manager" type="text" placeholder="Manager" required>
                </div>

                <div class="form-group">

                    <input name="mob" type="number" placeholder="Mobile No." required>
                </div>

                <div class="form-group">

                    <input name="email" type="text" placeholder="Email id" required>
                </div>

                <div class="form-group">

                    <input name="money" type="text" placeholder="Money" required>
                </div>

                <div class=" form-group">
                    <select name="pmode">
                        <option value="NEFT">NEFT</option>
                        <option value="Cash">Cash</option>
                        <option value="Google pay">Google pay</option>
                        <option value="Phone pay">Phone pay</option>

                    </select>
                </div>

                <input name="submit" value="Add" type="submit">



            </form>

            <div class="eventreg">
                <form action="sponsors.php" method="get">
                    <div class="form-group">
                        <input style="width:15rem;" class="form-control" name='searchsponsor' class='searchsponsor' type="text" placeholder="Search Sponsor" autofocus>
                    </div>
                </form>
                <?php

                // $query = "SELECT * FROM `sponsors`";
                // $spon = mysqli_query($link, $query);
                ?>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Manager</th>
                            <th>Mobile No.</th>
                            <th>Email id</th>
                            <th>Money</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = mysqli_fetch_array($spon)) {

                            echo '<tr>';
                            echo '<td name="id" value=' . $row['id'] . '>' . $row['id'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['manager'] . '</td>';
                            echo '<td>' . $row['mob'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['money'] . '<div style="float:right;"><a href="sponsors.php?id=' . $row['id'] . '"><i style="color:red;" class="fa fa-trash" ></i></a></div>
                            ' . '</td>';


                            echo '</tr>';
                        }

                        ?>

                    </tbody>

                </table>
                <?php



                ?>
            </div>
        </div>

    </div>
</body>

</html>