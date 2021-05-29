<html>

<head>
	<title>Fest Management System</title>
	<link type="text/css" rel="stylesheet" href="./css/login.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>

<body>
	<button class="btn btn-success"><a style="text-decoration: none; color:aliceblue;" href="vireshindex.php">Manager</a></button>
	<button class="btn btn-success"><a style="text-decoration: none; color:aliceblue;" href="sponsorindex.php">Sponsor</a></button>
	<form id="login" action="auth.php" method="POST">
		<h1>Log In</h1>
		<fieldset id="inputs">
			<input id="username" type="text" placeholder="Username" name="username" autofocus required>
			<input id="password" type="password" placeholder="Password" name="password" required>
		</fieldset>
		<fieldset id="actions">
			<input type="submit" id="submit" value="Log in">

		</fieldset>
	</form>

</body>

</html>