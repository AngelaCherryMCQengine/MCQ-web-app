<!DOCTYPE html>
<!-- student interface of MCQ web app -->
<!-- written by: Cherry 04/07/2015
	 modified by: -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset = utf-8"/>
	<title>MCQ web app: student interface</title>
</head>
<body>
	<?php
		/*for Cherry's SQL
		$con = mysql_connect("localhost","root","langtu");
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }
 
        mysql_select_db("mcq_v1_1", $con);*/

        //for Angela's SQL
		$con = mysql_connect("localhost","MCQ-web-app","password");
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }
 
        mysql_select_db("MCQ-web-app", $con);

        $examID = $_POST['examID'];
        setcookie('examID', $examID);

        $strsql = "SELECT * FROM Exams WHERE examID = " . $examID;

        $result = mysql_query($strsql, $con);
        if (!$result) {
        	die("Error: " . mysql_error());
        }

        $row = mysql_fetch_array($result);
        $quesID = $row['quesID'];
        $examTitle = $row['examTitle'];

        $strsql = "SELECT * FROM Questions WHERE quesID = " . $quesID;

        $result = mysql_query($strsql, $con);
        if (!$result) {
        	die("Error: " . mysql_error());
        }

        $row = mysql_fetch_array($result);

		mysql_close($con);
	?>

	<div id="exam">
		<h2><?php echo $examID . " " . $examTitle; ?></h2>
	</div>

	<div id="question">
		<h4>Q: <?php echo $row['ques'];?></h4>
		<form action="exam-result-display.php" method="post">
			<p>
				<label><input type="radio" name="answer" value="A"/>A. <?php echo $row['opA'];?></label><br/>
				<label><input type="radio" name="answer" value="B"/>B. <?php echo $row['opB'];?></label><br/>
				<label><input type="radio" name="answer" value="C"/>C. <?php echo $row['opC'];?></label><br/>
				<label><input type="radio" name="answer" value="D"/>D. <?php echo $row['opD'];?></label>
			</p>
			<input type="submit" value="Submit"/>
		</form>
	</div>
</body>
</html>