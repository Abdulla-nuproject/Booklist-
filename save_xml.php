<?php
echo $_GET['memberid'];
$xmlHeader = '<rss version="0.91">
<channel>
    <title>Saved Book List </title>
    <description>
        Exportedss book list
    </description>
    <language>en-us</language>';


                $servername = "localhost";
                $dbname     = "unn_w19035858";
                $username   = "unn_w19035858";
                $password   = "a6yabroo7";
                $conn       = 'mysql:host='.$servername.';dbname='.$dbname; 
                $pdocon     = new PDO($conn,$username,$password); 
                $pdocon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

?>

<?php

    $sql="SELECT * FROM `saved_books` WHERE `memberID`=:memberID";
    $stmt=$pdocon->prepare($sql);
    $stmt->bindParam('memberID', $_GET['memberid'], PDO::PARAM_STR);

    $stmt->execute();

    $data=$stmt->fetchAll();
    $xmlItem="";

    foreach($data as $row){
        

        $xmlItem=$xmlItem.'<item>'.
            '<bookid>'.$row['bookID'].'</bookid>'.
            '<title>'.$row['bookTitle'].'</title>'.
            '<author>'.$row['author'].'</author>'.
            '<link>'.
            $row['link'].
            '</link>'.
            '<description>'.
            $row['description'].
            '</description>'.
            '<yearPublished>'.intval($row['yearPublished']).'</yearPublished>'.
            '</item>';
    }

    $xmlFooter='</channel></rss>';
    $xmlFull=$xmlHeader.$xmlItem.$xmlFooter;

	$dom = new DOMDocument;
	$dom->preserveWhiteSpace = FALSE;
	$dom->loadXML($xmlFull);

	//Save XML as a file in the server
	$dom->save('export.xml');
	header('Location: main.php');

?>