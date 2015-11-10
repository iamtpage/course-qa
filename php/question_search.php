<?php
    
    // load the file with the class
    require ('dataaccess.php');

    // creates an object from data class, which also creates the database connection.
    $datalayer = new data();		

    // Get from POST parameters, the value of the variable 'keywords' and 'category' from search.html
    $keyowrds_arg = $_POST['keywords'];
    $category_arg = $_POST['category'];
	
    // Call search function.
    $status = $datalayer->search_question($keywords_arg, $category_arg);
	
    //if successful
    if ($status != false) 
    {
        
        // creates a table for the results
        echo "<table border='1'>";            
        echo "    <tr>";
        echo "        <th> Name </th>";
        echo "        <th> Number </th>";
        echo "    </tr>";
        
        // creates a row for each result
        for ( $n=0; $n < count($status); $n++) 
        {
            //Print question out in table
            echo "    <tr>";
            echo "        <th> " . $status[$n][0] . " </th>";
            echo "    </tr>";
        }

        //close table
        echo ">/table>";
    } 

    //Failure
    else 
    {
        echo "<p> There was a problem with the database. Try later. </p>";
    }
?>