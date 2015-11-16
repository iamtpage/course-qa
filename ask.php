<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Question</title>
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/ask-style.css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
    
<body>

<nav class="navbar navbar-default navbar-fixed">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand back-icon" onclick="goBack()">
        <img class="back-icon" alt="Brand" src="images/keyboard-backspace.png">
      </a>
    </div>
  </div>    
</nav>

<div class="container card">
    <div class="row header">
        <h2>Ask a Question</h2>
    </div>
    <ul class="nav nav-pills center">
      <li class="active" role="presentation"><a href="#">Computer Science</a></li>
      <li role="presentation"><a href="#">Information Technology</a></li>
      <li role="presentation"><a href="#">Other</a></li>
    </ul>

    <br>
	
	<form action="ask.php" method="post">
	
    <div class="row subject">
        <div class="col-xs-4">
            <input type="text" name="keywords" class="form-control" placeholder="Enter keywords">
        </div>
    </div>

    <div class="row content">
        <div class="col-md-6">
            <textarea class="form-control" rows="5" type="text" placeholder="Question" name="question"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="input-group">
                <input type="radio" name="category" value="csi" checked>Computer Science</input>
                <input type="radio" name="category" value="it">IT</input>
                <input type="radio" name="category" value="other">Other</input>
				<input type="radio" name="category" value="all">All</input>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="submit-button">
            <input class="btn btn-primary btn-lg" type="submit" value="Submit" name="submit">
        </div>
    </div>
	
	</form>

    <?php
        if(isset($_POST['submit']))
        {
    
            // load the file with the class
            require ('/php/dataaccess.php'); 

            // creates an object from data class, which also creates the database connection.       
            $datalayer = new data();            

            // Get from POST parameters, the value of the variable 'name'
            $question_arg = $_POST['question'];     
            $category_arg = $_POST['category'];
            $keyword_arg = $_POST['keywords'];

            if(empty($keyword_arg) || empty($question_arg)) 
            {
                echo '<p> No Question/Keywords detected </p>';
                $status = false;
            } 

            else 
            {
                // Call search function.
                $status = $datalayer->ask_question($question_arg, $keyword_arg, $category_arg); 
            }
                
            if ($status != false) 
            {
                //success
                // creates a table for the results
                echo "<hr><center><table class='table'>";            
                echo "    <tr>";
                echo "        <th> Question Asked: </th>";
                echo "        <th> Keyword(s):</th>";
                echo "        <th> Category:</th>";
                echo "    </tr>";
                echo "    <tr>";
                echo "        <th> " . $question_arg . " </th>";
                echo "        <th> " . $keyword_arg . " </th>";
                echo "        <th> " . $category_arg . " </th>";
                echo "    </tr>";
                echo "</table></center>";
            } 
            else 
            {
                //failure
                echo "<p> There was a problem with the database. Try later. </p>";
            }
        }
	?>
</div>



<script type="text/javascript">
    function goBack () {
        window.history.back();
    }
</script>

</body>
</html>