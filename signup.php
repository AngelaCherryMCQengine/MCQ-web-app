<!-- sign up php -->
<!-- written by: Cherry 11/07/2015
	modified by: -->

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset = utf-8">
	<title> Sign Up </title>
</head>
<body>
	<?php
		$con = mysql_connect("localhost", "MCQ_web_app", "password");
		if (! $con) {
			die('could not connect: ' . mysql_error());
		}

		mysql_select_db("MCQ_web_app", $con);


		$username = $_POST['username'];
		$password = "" . $_POST['password'];

		if ($_POST['userType'] == "student") {
			$sql = "INSERT INTO Students(stuUN, stuPW) VALUES ('$_POST[username]', '$_POST[password]')";
		} else {
			$sql = "INSERT INTO Teachers(teaUN, teaPW) VALUES ('$_POST[username]', '$_POST[password]')";
		}

		$result = mysql_query($sql, $con);
		if (! $result) {
			die("Error: " . mysql_error());
		}
	?>

	<h2> Hi! Welcome to MCQ-engine. </h2>

	<?php
		if ($userType == "student"):
	?>
	
	<form action="student_interface.html" method="post">
		<input type="submit" value="Join an exam">
	</form>

	<?php
		else:
	?>

	<form action="teacher_interface.html" method="post">
		<input type="submit" value="Create an exam">	
	</form>

	<?php
		endif
	?>
</body>
</html>