<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8" />
		<title>Home</title>
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
							echo "Hello ".$_SESSION["username"];
						}
						else{
							echo '<h1>please sign in</h1>';
						}
						?>
				</h4>
			</div>
			</br>
			</br>
				
				
				<div style=" float: center; text-align: center;">
					<form name="search" method="POST" action="search.php">
						<h4> Search For Book </h4>
			   			<input class="searchBar" name="textEnterd" type="text" id="textEnterd" size="30" placeholder="Type your search here ..." /></br>
			   			<input class="Button Button1" type="submit" value="Search by Title" name="action" />
			            <input class="Button Button1" type="submit" value="Search by Description" name="actionA" />
					</form> 
		    	</div><br/> 





		    <div>
				<?php 
					$books 	= simplexml_load_file('booklist.xml');
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


						 	if (isset($_SESSION["username"])) {
						 		echo '<form action="add.php?bookname='.$bookTitle.
						 		'&bookdescription='.$bookDes.				 		
						 		'&bookauthor='.$bookAuthor.
						 		'&bookyear='.$bookPub.
						 		'&booklink='.$bookLink.
						 		'&bookISBN='.$bookID.'" method="post">';

						 		echo '<input class="Button Button2" type="submit" value="Add Book to save list">';
						 		echo '</form><br/>';
							} 
						echo '</div><br/>';
					} 
				?>
		</div>


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