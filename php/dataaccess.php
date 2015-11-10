<?php
    define("DB_SERVER","myserver");				// server
    define("DB_USER","myuser");					// username
    define("DB_PASSWORD","mypassword");			// password
    define("DB_NAME","mydatabase");				// database's name
	
    class data {
        private $conn;			// database connection object
        
        function __construct()
        {
            $this->conn = new mysqli(DB_SERVER,DB_USER, DB_PASSWORD,DB_NAME) or die("There was a problem with the database connection");			// database connection creation
        }
		
        function ask_question($question,$keywords,$category)
        {
            //Insert into the Post table with format (Question,Answer,Keywords,Category)
            $query="INSERT INTO Post (Question,Answer,Keywords,Category) VALUES(?," ",?,?);";

            // Prepares the SQL query for execution
            if ($stmt = $this->conn->prepare($query))						
            {
                //Substitute ?'s for values from POST
                $stmt->bind_param('sss',$question,$keywords,$category);

                //Execute
                $stmt->execute();

                //Check if success
                if ($stmt->fetch())
                {
                    return true;
                    $stmt->close();
                }

                //Failed
                $stmt->close();
                return false;
            }

            //Failed
            $stmt->close();
            return false;
        }

        function answer_question($answer,$question_id)
        {
            //Insert answer to question in Post table by question_id
            $query="UPDATE Post SET Answer=? WHERE Post_ID=?;";

            // Prepare SQL query for execution
            if($stmt = $this->conn->prepare($query))
            {
                //Substitute ?'s for values from POST
                $stmt->bin_param("ss",$answer,$question_id);

                //Execute
                $stmt->execute();

                //Check if success
                if($stmt->fetch())
                {
                    retun true;
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
            }
        }

        function search_question($keywords, $category)
        {
            // create query for all category as default
            $query = "SELECT Question FROM Post WHERE CONTAINS(Question, ?);";

            //if the category isn't all, then search for specific category
            if($category != "all")
            {
                $query="SELECT Question FROM Post WHERE CONTAINS(Question, ?) AND CONTAINS(Keyword, ?);";
                
            }

            // Prepares the SQL query for execution	
            if ($stmt = $this->conn->prepare($query))
            {
                // Substitutes questions mark by actual value; s means the value is a string and 'i' means the value is an integer.
                $stmt->bind_param('ss',$keywords, $category);				
               
                // Executes the query
                $stmt->execute();

                // Binds the result to $results
                $stmt->bind_result($results);

                // Creates an array to store all the matches for keyword query
                $result_array=array();

                // Loop through the obtained rows
                while ($stmt->fetch())
                {
                    // Creates a temp array for the result value ($results)
                    $temp=array($results);

                    // Put this row into the array 'result_array'
                    array_push($result_array,$temp);
                }

                //Close connection and return result_array
                $stmt->close();
                return $result_array;
            }

            //Something went wrong
            $stmt->close();
            return false;
        }
    }
?>