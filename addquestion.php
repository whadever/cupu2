<?php 


	require_once("./includes/config.php");

	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["xmlfile"]["name"]);
		$uploadOk = 1;
		$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
	    // Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["xmlfile"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($FileType != "xml") {
		    echo "Sorry, only XML files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["xmlfile"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["xmlfile"]["name"]). " has been uploaded.";
		        $xml=simplexml_load_file('uploads/question1.xml') or die("Error: Cannot create object");
		       	
		           $topic = $xml->classification->topic;
				   $level = $xml->level;
				   $question = $xml->question_text;
				   $choice1 = $xml->answer->choice1;
				   $choice2 = $xml->answer->choice2;
				   $choice3 = $xml->answer->choice3;
				   if($xml->answer->choice1->attributes()){
					$correct = 1;
					}elseif($xml->answer->choice2->attributes()){
						$correct = 2;
					}elseif($xml->answer->choice3->attributes()){
						$correct = 3;
					}
					$query = "INSERT INTO questions(topic,question,level,choice1,choice2,choice3,correctanswer) values('$topic','$question','$level','$choice1','$choice2','$choice3','$correct')";
				   	$stmt = db2_prepare($con, $query);
					   
					    $result = db2_execute($stmt);
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}

	}
	
 ?>

 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DB2 on Campus!</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?home">DB2 On Campus</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="index.php?home">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#student">Student</a></li>
              <li><a href="#faculty">Faculty</a></li>
              <li><a href="#professional">Professional</a></li>
              <?php if(isset($_SESSION['userid'])): ?>
                <li><a href="logout.php">Logout</a></li>      
              <?php else: ?>
                <li><a href="index.php?login">Login</a></li>
                <li><a href="index.php?register">Register</a></li>  
              <?php endif; ?>
              
             
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
          

      <div class="container">
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<h1>New Question</h1>

		<form action="addquestion.php" method="post" enctype="multipart/form-data">

			<div class="form-group">
				<label for="">Select XML File</label>
				<input type="file" class="form-control" name="xmlfile" id="xmlfile">
			</div>
			

			<div class="form-group">
				<input type="submit" class="btn btn-success" name="submit" value="Upload!">
				<a href="index.php?managequestion" class="btn btn-primary">Back</a>
			</div>

		</form>

	</div>
	<div class="col-md-4"></div>
</div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.12.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>