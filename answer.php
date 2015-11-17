<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Answer</title>
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/answer.css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
    
<body>

<nav class="navbar navbar-default navbar-fixed">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand back-icon" href="index.php">
        <img class="back-icon" alt="Brand" src="images/keyboard-backspace.png">
      </a>
    </div>
  </div>    
</nav>

<div class="container card">
    <div class="row header">
        <h2>Answer a Question</h2>
    </div>
	
    <br>
	<div class="row content">
		<div class="col-md6 col-md-offset-3">
			<form action="answer.php" method="post">
			<?php
			
			ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
			
			require ('php/dataaccess.php');
			
			$datalayer = new data();
			
			$status = $datalayer->list_unanswered_questions();
			
			if($status != false)
			{
				
				//success
				// creates a dropdown of unanswered questions
				//the value is the question id in the database
						echo "<select name=\"question_id\">\n";            
						
						// creates a row for each result
						for ( $n=0; $n < count($status); $n++) 
						{
							//Print question out in table
							echo "<option value=\"".$status[$n][1]."\">".$status[$n][0]."</option>\n";
						}
						echo "</select>\n";
						echo "<div class=\"row content\">\n";
						echo "<div class=\"col-md-6\">\n";
						echo "<textarea class=\"form-control\" rows=\"5\" type=\"text\" placeholder=\"Answer\" name=\"answer\"></textarea>\n";
						echo "</div>\n";
						echo "</div>\n";
			}
			
			else
			{
				echo "<p> There was a problem with the database. Try later. </p>\n";
			}
			
			if(isset($_POST['submit']) && isset($_POST['answer']))
			{
     
				$datalayer = new data();            

				//Get from POST parameters, the value of the variable 'name'
				$question_id_arg = $_POST['question_id'];     
				$answer_arg = $_POST['answer'];
				
				//Call search function.
				$status = $datalayer->answer_question($question_id_arg, $answer_arg);
					
				if ($status != false) 
				{}
					$status = $datalayer->select_question($question_id_arg);
					
					if($status != false)
					{
				
						//success
						// creates a table for the results
						echo "<hr><center><table class='table'>";            
						echo "    <tr>\n";
						echo "        <th> Question </th>\n";
						echo "        <th> Answer </th>\n";
						echo "    </tr>\n";
						echo "	  <tr>\n";
						echo "		  <th>".$status[0][0]."</th>\n";
						echo "		  <th>".$status[0][1]."</th>\n";
					}
				}
				
				else 
				{
					//failure
					echo "<p> sdasThere was a problem with the database. Try later. </p>\n";
				}
			}
			
			?>
		</div>
	</div>

    <div class="row">
        <div class="submit-button">
            <input class="btn btn-primary btn-lg" type="submit" value="Submit" name="submit">
        </div>
    </div>
	
	</form>

</div>
</body>
</html>