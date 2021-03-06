<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home</title>

		<!-- import bootstrap css/custom css, jquery javascript, and bootstrap javascript
			ALWAYS import jquery javascript BEFORE bootstrap, else it won't work
		-->
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/index.css">
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>

		<div class="jumbotron">
			<div class="container">
				<h1>Comp Sci Question Repo</h1>
				<p>Ask Computer Science questions and have them answered by other computer science students</p>
			</div>
		</div>

		<div class="row">
		  <div class="col-md-4">
		  <a href="ask.php">
		  	<div class="page-portal" id="ask">
		  		<div class="icon">
		  			<img class="portal-icon" src="images/help.svg" id="ask-icon" />
		  		</div>
		  		<h1 class="portal-text">Ask</h1>
		  	</div>
		  	</a>
		  </div>
		  
		  <div class="col-md-4">
		  	<a href="search.php">
		  	<div class="page-portal" id="search">
		  		<div class="icon">
		  			<img class="portal-icon" src="images/magnify.svg"id="search-icon"/>
		  		</div>
		  		<h1 class="portal-text">Search</h1>		  		
		  	</div>
		  	</a>
		  </div>

		  <div class="col-md-4">
		  	<a href="answer.php">
		  	<div class="page-portal" id="answer">
		  		<div class="icon">
		  			<img class="portal-icon" src="images/pencil.svg"id="pencil-icon"/>
		  		</div>
		  		<h1 class="portal-text">Answer</h1>		  		
		  	</div>
		  	</a>
		  </div>
		</div>		
	</body>
</html>