<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Search</title>
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/search-style.css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
    
<body>

<nav class="navbar navbar-default navbar-fixed">
  <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">
          <img class="back-icon" alt="Brand" src="images/keyboard-backspace.png">
        </a>
    </div>
  </div>    
</nav>

<div class="container card">
    <div class="row header">
        <h2>Search for a Question</h2>
    </div>
    <form action="search.php" method="post">
    <ul class="nav nav-pills center">
      <input type="radio" name="category" value="csi" checked>Computer Science</input>
      <input type="radio" name="category" value="it">IT</input>
      <input type="radio" name="category" value="other">Other</input>
      <input type="radio" name="category" value="all">All</input>
    </ul>

    <br>

    <div class="row">
      <div class="col-md-6 col-md-offset-3">
         <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
            <input type="text" name="keywords" class="form-control" placeholder="Enter keywords">
        </div>  
        </div>
    </div>
    <div class="row">
        <div class="submit-button">
                <input class="btn btn-primary btn-lg" type="submit" value="Search" name="submit">
        </div>
    </div>

    </form>


    <?php
        if(isset($_POST['submit']))
        {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL); 

            // load the file with the class
            require ('php/dataaccess.php');

            // creates an object from data class, which also creates the database connection.
            $datalayer = new data();        

            // Get from POST parameters, the value of the variable 'keywords' and 'category' from search.html
            $keywords_arg = $_POST['keywords'];
            $category_arg = $_POST['category'];
            
            if(empty($keywords_arg)) {
                echo 'no query';
                $status = false;
            } else {
                // Call search function.
                $status = $datalayer->search_question($keywords_arg, $category_arg);    
            }
            
            
            //if successful
            if ($status != false) 
            {
                
                // creates a table for the results
                echo "<hr><center><table class='table'>";            
                echo "    <tr>";
                echo "        <th> Question </th>";
                echo "        <th> Answer </th>";
                echo "    </tr>";
                
                // creates a row for each result
                for ( $n=0; $n < count($status); $n++) 
                {
                    //Print question out in table
                    echo "    <tr>";
                    echo "        <th> " . $status[$n][0] . " </th>";
                    echo "    <th> " . $status[$n][1] . " </th>";
                    echo "    </tr>";
                }

                //close table
                echo "</table></center>";
            } 

            //Failure
            else 
            {
                echo "<p> No records found </p>";
            }
        }
    ?>
</div>
</body>

<script type="text/javascript">
    function goBack () {
        window.history.back();
    }
</script>