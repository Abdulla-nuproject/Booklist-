<?php

                $servername = "localhost";
                $dbname     = "unn_w19035858";
                $username   = "unn_w19035858";
                $password   = "a6yabroo7";
                $conn       = 'mysql:host='.$servername.';dbname='.$dbname; 
                $pdocon     = new PDO($conn,$username,$password); 
                $pdocon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);


		$sql  = "DELETE FROM `saved_books` WHERE `bookID`=:bookID";
		$stmt = $pdocon->prepare($sql);
		$stmt->bindParam('bookID', $_GET["bookISBN"], PDO::PARAM_STR);
		$stmt->execute();

		header("Location: save.php");

?>