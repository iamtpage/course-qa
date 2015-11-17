<?php
    //Report all errors
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    define("DB_SERVER","localhost");
    define("DB_USER","15FAUSPAHCIDB7");
    define("DB_PASSWORD","8a9b4r");
    define("DB_NAME","15FAUSPAHCIDB7");
	
    class data 
    {
     
        // database connection object
        private $conn;
        
        function __construct()
        {
            // database connection creation
            $this->conn = new mysqli(DB_SERVER,DB_USER, DB_PASSWORD,DB_NAME) or die($mysqli->error);
        }
		
        function ask_question($question,$keywords,$category)
        {
            //Insert into the Post table with format (Question,Answer,Keywords,Category)
            $query="INSERT INTO Post (Question,Answer,Keyword,Category) VALUES('".$question."','','".$keywords."','".$category."')";
            // Prepares the SQL query for execution
            if ($stmt = $this->conn->prepare($query))						
            {

                //Execute and Check if success
                if ($stmt->execute())
                {
                    $stmt->close();
					return true;
                }

                //Failed
				else
				{	
					$stmt->close();
					return false;
				}
            }

			//Something went wrong
            else
            {
                echo "Failed connection\n";
                echo mysqli_error($this->conn);
                return false;
            }
        }

        function answer_question($answer,$question_id)
        {
            //Insert answer to question in Post table by question_id
            $query="UPDATE Post SET Answer='".$answer."' WHERE Post_ID='".$question_id."'";

            // Prepare SQL query for execution
            if($stmt = $this->conn->prepare($query))
            {

                //Execute
                $stmt->execute();

                //Check if success
                if($stmt->fetch())
                {
                    return true;
                    $stmt->close();
                }

                //Else failed
                $stmt->close();
                return false;
            }
 
            //Failed
            $stmt->close();
            return false;
        }

        function search_question($keywords, $category)
        {
            // create query
            $query="SELECT Question,Answer,Post_ID FROM Post WHERE Category='".$category."' AND Keyword LIKE '%".$keywords."%'";

			//different query for "all" so it return ALL results
			if($category == "all")
			{
				$query="SELECT Question,Answer FROM Post WHERE Category IS NOT NULL AND Keyword LIKE '%".$keywords."%'";
			}
            // Prepares the SQL query for execution	
            if ($stmt = $this->conn->prepare($query))
            {

                // Executes the query
                $stmt->execute();

                // Binds the result to $results
                $stmt->bind_result($results_questions,$results_answers,$results_id);

                // Creates an array to store all the matches for keyword query
                $result_array=array();

                // Loop through the obtained rows
                while ($stmt->fetch())
                {
                    // Creates a temp array for the result value ($results)
                    $temp=array($results_questions,$results_answers,$results_id);
		    
                    // Put this row into the array 'result_array'
                    array_push($result_array,$temp);
                }
		
				//Close connection and return result_array
                $stmt->close();
                return $result_array;
            }

            
			//Something went wrong
            else
            {
                echo "Failed connection\n";
                echo mysqli_error($this->conn);
                return false;
            }
        }
    }
?>
