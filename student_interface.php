<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!-- student interface of MCQ web app -->
<!-- written by: Cherry 04/07/2015
	modified by: Angela 05/07/2015 -->

<html>
    <head>
	   <meta http-equiv="Content-Type" content="text/html; charset = utf-8"/>
	   <title>MCQ web app: student interface</title>
    </head>

    <body>
        <?php
            $con = mysql_connect("localhost","MCQ-web-app","password");
            if (!$con)
            {
                die('Could not connect: ' . mysql_error());
            }
 
            mysql_select_db("MCQ-web-app", $con);

            $examID = $_POST['examID'];
            
            $sql = "SELECT * FROM Exams WHERE examID = " . $examID;
            $result = mysql_query($sql, $con);

            $check_existance = mysql_num_rows($result);
            if (!$check_existance) {
        	   die("Error: Invalid exam ID.");
            }

            $row = mysql_fetch_array($result);
            $examPW = $row['examPW'];
            if ($_POST['examPW'] != $examPW) {
                die("Error: Invalid password.");
            }

            setcookie('examID', $examID);
            
            $quesID = $row['quesID'];
            $examTitle = $row['examTitle'];           

            $sql = "SELECT * FROM Questions WHERE quesID = " . $quesID;
            $result = mysql_query($sql, $con);
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