<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!-- to upload the questions posted by one teacher -->
<!-- written by: Angela 01/07/2015
	modified by: Cherry 02/07/2015 -->

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> MCQ web app trial </title>
	</head>

	<body>
		<?php
        	$con = mysql_connect("localhost","MCQ-web-app","password");
        	if (!$con)
        	{
            	die('Could not connect: ' . mysql_error());
        	}
 
        	mysql_select_db("MCQ-web-app", $con);
            
        	$sql = "INSERT INTO Questions(ques,answer,opA,feedA,opB,feedB,opC,feedC,opD,feedD) VALUES ('$_POST[ques]', '$_POST[answer]', '$_POST[opA]', '$_POST[feedA]', '$_POST[opB]', '$_POST[feedB]', '$_POST[opC]', '$_POST[feedC]', '$_POST[opD]', '$_POST[feedD]')";
        	$result = mysql_query($sql,$con);
            if (!$result)
        	{
        	    die('Error: ' . mysql_error());
        	}
        
            $quesID = mysql_insert_id();
            $examPW = $_POST['examPW'];
            $sql = "INSERT INTO Exams(examTitle, quesID, examPW) VALUES ('$_POST[examTitle]', '$quesID', '$examPW')";
            $result = mysql_query($sql, $con);
            if (!$result)
            {
                die('Error: ' . mysql_error());
            }

            $examID = mysql_insert_id();
            echo "Successfully uploaded your exam paper.";
            echo "The new exam id is " . $examID;
            echo "The password is " . $examPW;

        	mysql_close($con);
    	?>
	</body>
</html>