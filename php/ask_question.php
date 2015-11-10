<?php
    
    // load the file with the class
    require ('dataaccess.php');	

    // creates an object from data class, which also creates the database connection.		
    $datalayer = new data();			

    // Get from POST parameters, the value of the variable 'name'
    $question_arg = $_POST['question'];		
    $category_arg = $_POST['category'];
    $keyword_arg = $_POST['keywords'];
	
    // Call ask function and pass parameters
    $status = $datalayer->ask_question($question_arg, $keyword_arg, $category_arg);		
	
    if ($status != false) 
    {
        //success
        echo "<p>QUESTION ASKED</p>";
    } 
    else 
    {
        //failure
        echo "<p> There was a problem with the database. Try later. </p>";
    }
?>