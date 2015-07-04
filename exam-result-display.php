<!DOCTYPE html>
<!-- result display of MCQ web app -->
<!-- Written by: Cherry 04/07/2015
	Modified by:-->

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset = utf-8">
	<title>MCQ web app: exam result</title>
</head>
<body>
	<h3>
		<?php
			/*for Cherry's SQL
			$con = mysql_connect("localhost", "root", "langtu");
			if (!$con) {
				die('Could not connect: ' . mysql_error());
			}

			mysql_select_db('mcq_v1_1', $con);*/

			//for Angela's SQL
			$con = mysql_connect("localhost", "MCQ-web-app", "password");
			if (!$con) {
				die('Could not connect: ' . mysql_error());
			}

			mysql_select_db('MCQ-web-app', $con);

			$strsql = "SELECT * FROM Exams WHERE examID = " . $_COOKIE['examID'];
			$result = mysql_query($strsql, $con);
			if (!$result) {
				die("Error: " . mysql_error());
			}

			$row = mysql_fetch_array($result);

			$strsql = "SELECT * FROM Questions WHERE quesID = " . $row['quesID'];
			$result = mysql_query($strsql, $con);
			if (!$result) {
				die('Error: ' . mysql_error());
			}

			$row = mysql_fetch_array($result);

			if ($_POST['answer'] == $row['answer']) {
				echo "Congratulation! You get 100 scores.";
			}elseif ($_POST['answer'] == "A") {
				echo "Sorry, the right answer is " . $row['answer'] . ".";
				$feedback = $row['feedA'];
			}elseif ($_POST['answer'] == "B") {
				echo "Sorry, the right answer is " . $row['answer'] . ".";
				$feedback = $row['feedB'];
			}elseif ($_POST['answer'] == "C") {
				echo "Sorry, the right answer is " . $row['answer'] . ".";
				$feedback = $row['feedC'];
			}elseif ($_POST['answer'] == "D") {
				echo "Sorry, the right answer is " . $row['answer'] . ".";
				$feedback = $row['feedD'];
			}
		?>
	</h3>

	<blockquote>
		<?php
			if (! $_POST['answer'] == $row['answer']) {
				echo $row["feed" . $row['answer']];
			}
		?>
	</blockquote>

	<p>
		<h3>
			<?php
				if (! $_POST['answer'] == $row['answer']) {
					echo "Why " . $_POST['answer'] . " is not correct: ";
				}
			?> 
		</h3>
		<blockquote>
			<?php
				if (! $_POST['answer'] == $row['answer']) {
					echo $feedback;
				}
				mysql_close($con);
			?>
		</blockquote>
	</p>
</body>
</html>