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


              <?php
                  $bookDoc = simplexml_load_file('booklist.xml');
                  $results = "";

                           //---------------Search By Title---------------

                    if (isset($_POST['action'])) {
                            $textEnterd = $_POST['textEnterd'];
                            $results = "Results <strong>$textEnterd</strong><br />";

                            
                            if (!is_null($textEnterd)) {
                                $qry = "//channel/item[title[contains(text(),\"$textEnterd\")]]"; // any text match the description will be shown
                            }
                            else {
                                $qry = "/channel/'ALL'"; // if nothing is entered the page will query everything
                            }
                            $query = $bookDoc->xpath($qry); //xpath query
                ?>

                            <?=$results //Show the Results ?> 

                <?php
                            // Loop for search
                            $loop = 0;
                            foreach ($query as $book) 
                            {
                            		$loop++;
                                $bookID 		= $book->bookid;
                        			 	$bookTitle 	= $book->title;
                        			 	$bookLink 	= $book->link;
                        			 	$bookAuthor = $book->author;
                        			 	$bookDes 		= $book->description;
                        			 	$bookPub		= $book->yearPublished;

                    			 	echo '<div class="bordersDiv">';
							 		echo '<h3>book number '.$loop.' - <a class="links" href="'.$bookLink.'" target="_blank">'.$bookTitle.'</a></h3>';
								 	echo '<p>Summary : '.$bookDes.'</p>'; 
								 	echo '<p>by : '.$bookAuthor.'</p>'; 
								 	echo '<p>Published on : '.$bookPub.'</p>'; 

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
                        }
              ?>








              <?php
                           //---------------Search By Description---------------

                    if (isset($_POST['actionA'])) {

                        $textEnterd = $_POST['textEnterd'];
                        $results = "Results <strong>$textEnterd</strong><br />";

                            // any text match the title will be shown
                            if (!is_null($textEnterd)) {
                                $qry = "//channel/item[description[contains(text(),\"$textEnterd\")]]";
                            }
                            else {
                            // if nothing is entered the page will query everythin
                                $qry = "/channel/'ALL'";
                            }

                            $query = $bookDoc->xpath($qry); // xpath query
              ?>

                            <?=$results //Show the Results ?> 

              <?php
                            // Loop for search
                            $loop = 0;
                            foreach ($query as $book) 
                            {
                                $loop++;
                                $bookID     = $book->bookid;
                                $bookTitle  = $book->title;
                                $bookLink   = $book->link;
                                $bookAuthor = $book->author;
                                $bookDes    = $book->description;
                                $bookPub    = $book->yearPublished;

						echo '<div class="bordersDiv">';

							 		echo '<h3>book number '.$loop.' - <a class="links" href="'.$bookLink.'" target="_blank">'.$bookTitle.'</a></h3>';
								 	echo '<p>Summary : '.$bookDes.'</p>'; 
								 	echo '<p>by : '.$bookAuthor.'</p>'; 
								 	echo '<p>Published on : '.$bookPub.'</p>'; 

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
