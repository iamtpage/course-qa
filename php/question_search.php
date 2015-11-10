<?php
    require ('dataaccess.php');			// load the file with the class
    $datalayer = new data();			// creates an object from data class, which also creates the database connection.

    $question_arg = $_POST['question'];		// Get from POST parameters, the value of the variable 'name'
    $category_arg = $_POST['category'];
	
    $status = $datalayer->search_question($question_arg, $category_arg);		// Call search function.
	
    if ($status != false) {
        echo "<table border='1'>";            // creates a table for the results
        echo "    <tr>";
        echo "        <th> Name </th>";
        echo "        <th> Number </th>";
        echo "    </tr>";
                                                    // creates a row for each result
        for ( $n=0; $n < count($status); $n++) {
            echo "    <tr>";
            echo "        <th> " . $status[$n][0] . " </th>";        // Prints row n, column 0; which is the name
            echo "    </tr>";
        }
        echo ">/table>";
    } else {
        echo "<p> There was a problem with the database. Try later. </p>";
    }
?>