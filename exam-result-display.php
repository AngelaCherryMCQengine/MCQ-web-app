<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!-- result display of MCQ web app -->
<!-- written by: Cherry 04/07/2015
	modified by: Angela 05/07/2015 -->

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset = utf-8">
		<title>MCQ web app: exam result</title>
	</head>

	<body>
		<h3>
			<?php
				$con = mysql_connect("localhost", "MCQ-web-app", "password");
				if (!$con) {
					die('Could not connect: ' . mysql_error());
				}

				mysql_select_db('MCQ-web-app', $con);

				$sql = "SELECT * FROM Exams WHERE examID = " . $_COOKIE['examID'];
				$result = mysql_query($sql, $con);
				if (!$result) {
					die("Error: " . mysql_error());
				}

				$row = mysql_fetch_array($result);

				$sql = "SELECT * FROM Questions WHERE quesID = " . $row['quesID'];
				$result = mysql_query($sql, $con);
				if (!$result) {
					die('Error: ' . mysql_error());
				}

				$row = mysql_fetch_array($result);

				if ($_POST['answer'] == $row['answer']) {
					echo "Correct!";
				} elseif ($_POST['answer'] == "A") {
					$feedback = $row['feedA'];
					echo "Sorry, the right answer is " . $row['answer'] . ".";
				} elseif ($_POST['answer'] == "B") {
					$feedback = $row['feedB'];
					echo "Sorry, the right answer is " . $row['answer'] . ".";
				} elseif ($_POST['answer'] == "C") {
					$feedback = $row['feedC'];
					echo "Sorry, the right answer is " . $row['answer'] . ".";
				} elseif ($_POST['answer'] == "D") {
					$feedback = $row['feedD'];
					echo "Sorry, the right answer is " . $row['answer'] . ".";
				}
			?>
		</h3>

		<blockquote>
			<?php
				if (!$_POST['answer'] == $row['answer']) {
					echo $row["feed" . $row['answer']];
				}
			?>
		</blockquote>

		<p>
			<h3>
				<?php
					if (!$_POST['answer'] == $row['answer']) {
						echo "Why " . $_POST['answer'] . " is not correct: ";
					}
				?> 
			</h3>
			<blockquote>
				<?php
					if (!$_POST['answer'] == $row['answer']) {
						echo $feedback;
					}
					mysql_close($con);
				?>
			</blockquote>
		</p>
	</body>
</html>