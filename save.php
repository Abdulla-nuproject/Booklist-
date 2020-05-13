<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Saved List</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
	</head>
<body>

		<header> 
			<nav>
				<ul>
					<li><a href="./main.php" >Home</a></li>
					<li><a href="./logout.php" >logout</a></li>
						<?php
							session_start();
							if (isset($_SESSION["username"])) {
								echo '<li><a class="active" href="save.php">Saved Books</a></li>';
						?>


					</ul>
				</nav>	
			</header>
			<br/>

			<div>
				<h4 style="float: center; text-align: center;">
						<?php
							echo "Hello ".$_SESSION["username"];
						}
						?> this is your Book List
				</h4>
			</div>
			</br>
			</br>

<?php
			//-------------------------db Connection ---------------------------
				$servername = "localhost";
				$dbname		= "unn_w19035858";
				$username	= "unn_w19035858";
				$password	= "a6yabroo7";
				$conn		= 'mysql:host='.$servername.';dbname='.$dbname; 
				$pdocon		= new PDO($conn,$username,$password); 
				$pdocon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

			//--------------------------------------------------------------------

				
				$username = $_SESSION["username"]; 
				$sql	  = "SELECT * FROM members WHERE name=:name";
				$stmt	  = $pdocon->prepare($sql);
				$stmt->bindParam('name',$username,PDO::PARAM_STR); 
				$stmt->execute();
				$data 	  = $stmt->fetchAll(); 

				foreach ($data as $row) {
					$memberID = $row['memberID'];
					$sql = "SELECT * FROM saved_books";
					$stmt = $pdocon->prepare($sql);
					$stmt->bindParam('memberID',$memberID,PDO::PARAM_STR);
					$stmt->execute();

					$data2 = $stmt->fetchAll();
					


					foreach ($data2 as $row2) {
						echo '<div class="bordersDiv">';
						echo 'Book ISBN number - '.$row2['bookID'].'<br>';
						echo 'Title - <a class="links" href="'.$row2['link'].'" target="_blank">'.$row2['bookTitle'].'</a><br>';
						echo 'Description - '.$row2['description'].'<br>';
						echo 'Author Name - '.$row2['author'].'<br>';
						echo 'Date - '.$row2['yearPublished'].'<br>';
						

						

						echo '<form action="delete.php?bookISBN='.$row2['bookID'].'" method="post">';
						echo '<input class="Button Button2" type="submit" value="Remove the Book from List">';
						echo '</form>';



						echo '<form action="save_xml.php?memberid='.$memberID.'" method="post">';
			            echo '<input class="Button Button2" type="submit" value="Export into XML">';
			            echo '</form>';

			            echo '</div>';
			            echo "<br>";

					}

				}

			?>

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