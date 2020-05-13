<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8" />
		<title>Home</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./library/css/style.css">
	</head>

<body>


		<header> 
			<nav>
				<ul>
					<li><a class="active" href="./index.php" >Home</a></li>
					<li><a href="./library/login.php" >Sign In</a></li>
				</ul>
			</nav>	
		</header> </br>


				<div>
							<?php 
								$books 	= simplexml_load_file('library/booklist.xml');
								$loop = 0;

								foreach ($books->channel->item as $book) {
								 	$loop++;
								 	$bookID 		= $book->bookid;
								 	$bookTitle 		= $book->title;
								 	$bookLink 		= $book->link;
								 	$bookAuthor 	= $book->author;
								 	$bookDes 		= $book->description;
								 	$bookPub		= $book->yearPublished;

								 	echo '<div class="bordersDiv">';
						 			echo '<h3>book number '.$loop.' - <a class="links" href="'.$bookLink.'" target="_blank">'.$bookTitle.'</a></h3>';
						 			echo '<p><h4>Description</h4> - '.$bookDes.'</p>'; 
						 			echo '<h4>Author name - '.$bookAuthor.'</h4>'; 
						 			echo '<p>Date : '.$bookPub.'</p>'; 
									echo '</div></br>';
									} 

								?>
				</div></br>

		</br>
		<footer class="center" style="background: url(./library/css/footer-books.jpg);
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