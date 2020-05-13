<!DOCTYPE html>
<html>

<head>
	<head>
		<meta charset="UTF-8" />
		<title>Sign In</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
	</head>
</head>

<body>



		<header> 
			<nav>
				<ul>
					<li><a href="../index.php" >Home</a></li>
					<li><a class="active" href="./login.php" >Sign In</a></li>
					<?php
							session_start();
							if (isset($_SESSION["username"])) {
								echo '<a href="savedbooks.php">My Books</a>';
								echo '<a href="logout.php">Logout</a>';
							}
					?>

				</ul>
			</nav>	
		</header> </br>



		<div>
			<h3 style="	float: center; text-align: center;""> Enter your Email and Password </h3>
			<form class="center" method="post" action="login.php">
				<input class="searchBar" type="email" name="Email" placeholder="Enter your email"></br>
				<input class="searchBar" type="password" name="Pass" placeholder="Enter your password"></br>
				<input class="Button Button1" type="submit" name="login" value="Sign In">
			</form>	
		</div>


<?php
		if (isset($_POST["login"])){

			// ----------------Connection----------------

				$servername = "localhost";
				$dbname		= "unn_w19035858";
				$username	= "unn_w19035858";
				$password	= "a6yabroo7";
				$conn		= 'mysql:host='.$servername.';dbname='.$dbname; 
				$pdocon		= new PDO($conn,$username,$password); 
				$pdocon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

			// ----------------db Query----------------

			$email = $_REQUEST['Email']; 
			$pwd   = $_REQUEST['Pass'];  
			$sql   = "SELECT * FROM `members` WHERE `email`=:email";
			$stmt  = $pdocon->prepare($sql);

			$stmt->bindParam('email',$email,PDO::PARAM_STR); 
			$stmt->execute();

			$data = $stmt->fetchAll();
			foreach ($data as $row) {
				if (password_verify($_REQUEST['Pass'], $row['password'])) { 
					$_SESSION["username"]=$row['name']; 
					$date 		= date("Y/m/d"); 
					$time 		= date("H:i:s"); 
					$lastlogin  = $date . " " . $time;
					$sql 		= "UPDATE members SET lastLogin=:lastLogin WHERE `email`=:email";
					$stmt		= $pdocon->prepare($sql);
					$stmt->bindParam('lastLogin',$lastlogin,PDO::PARAM_STR); 
					$stmt->bindParam('email',$email,PDO::PARAM_STR); 
					$stmt->execute();

					header('Location: main.php');

				} else {
					echo " Somthing went wrong, Try Agian!";
				}
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
