<?php
    
    // load the file with the class
    require ('dataaccess.php');	

    // creates an object from data class, which also creates the database connection.		
    $datalayer = new data();			

    // Get from POST parameters, the value of the variable 'name'
    $answer_arg = $_POST['answer'];		
    $id_arg = $_POST['question_id'];
	
    // Call ask function and pass parameters
    $status = $datalayer->answer_question($answer_arg, $id_arg);		
	
    if ($status != false) 
    {
        //success
        echo "<p>QUESTION ANSWERED</p>";
    } 
    else 
    {
        //failure
        echo "<p> There was a problem with the database. Try later. </p>";
    }
?>