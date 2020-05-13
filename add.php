<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Adding</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
	</head>
<body>

		<header> 
			<nav>
				<ul>
					<li><a class="active" href="./main.php" >Home</a></li>
					<li><a href="./logout.php" >logout</a></li>
						<?php
							session_start();
							if (isset($_SESSION["username"])) {
								echo '<li><a href="save.php">Saved Books</a></li>';
							
						?>


					</ul>
				</nav>	
			</header>
			<br/>

			<div>
				<h4 style="float: center; text-align: center;">
						<?php
							echo "".$_SESSION["username"]." Here is the book details you added ";
						}
						?>
				</h4>
			</div>
			</br>
			</br>


<?php

				$servername = "localhost";
				$dbname		= "unn_w19035858";
				$username	= "unn_w19035858";
				$password	= "a6yabroo7";
				$conn		= 'mysql:host='.$servername.';dbname='.$dbname;
				$pdocon		= new PDO($conn,$username,$password); 
				$pdocon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

				echo '<div class="bordersDiv">';
				$date 		= date("Y/m/d");
				$time 		= date("H:i:s");
				$dateOfAdd  = $date . " " . $time;

				$bookTitle		= $_GET["bookname"];
				$bookLink		= $_GET["booklink"];
				$bookAuthor		= $_GET["bookauthor"];
				$bookDes  		= $_GET["bookdescription"];
				$bookPub		= $_GET["bookyear"];
				$bookID			= $_GET["bookISBN"];


				echo '<h3>Title - <a class="links" href="'.$bookLink.'" target="_blank">'.$bookTitle.'</a></h3>';
			 	echo '<p>Description - '.$bookDes.'</p>'; 
			 	echo '<p>Author Name - '.$bookAuthor.'</p>'; 
			 	echo '<p>Date - '.$bookPub.'</p>'; 

				$username = $_SESSION["username"];
				$sql	  = "SELECT * FROM members WHERE name=:name";
				$stmt	  = $pdocon->prepare($sql);
				$stmt->bindParam('name',$username,PDO::PARAM_STR);
				$stmt->execute();
				$data 	  = $stmt->fetchAll();

				$memberID = "";

				foreach ($data as $row) {
					$memberID = $row['memberID'];
				}

				$sql	= "INSERT INTO saved_books (bookID, memberID, bookTitle, author, description, link, yearPublished, dateSaved) VALUES ('$bookID', '$memberID','$bookTitle','$bookAuthor','$bookDes','$bookLink', '$bookPub', '$dateOfAdd')";

				$stmt	  = $pdocon->prepare($sql);
				$stmt->execute();
				echo '</div>';
?>

			
				<form style=" float: center; text-align: center;" name="list" method="POST" action="save.php">
					<input class="Button Button2" type="submit" value="Go to saved list">
				</form>

				<form style=" float: center; text-align: center;" name="home" method="POST" action="main.php">
					<input class="Button Button2" type="submit" value="Go to Home page">
				</form>


		</br>
		<footer class="center" style="background: url(./css/footer-books.jpg);
				background-repeat: no-repeat;
				background-attachment: fixed; 
				background-size: 100% 100%;
				color: 	white;
				padding: 5px;">

			<div>
					<p>Library of Abdulla Al-Najjar - 19035858</p>
			</div>
		</br>

		</footer>


</body>
</html>