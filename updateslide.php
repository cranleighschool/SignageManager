<?php
	require_once('conn.php');
	require_once('functions.php');
?>
<!DocType HTML>
<?php

$screenTable = $_POST['screenTable'];
$id = $_POST['id'];
$owner = $_POST['owner'];
$orderNumber = $_POST['orderNumber'];
$title = $_POST['title'];
$picture = $_POST['picture'];
$message = $_POST['message'];
$theWhere = $_POST['theWhere'];
$theWhen = $_POST['theWhen'];
$theWho = $_POST['theWho'];
$theWhy = $_POST['theWhy'];
$fontSize = $_POST['fontSize'];
$lineHeight = $_POST['lineHeight'];
$startDate = dateTomysql($_POST['startDate']);
$endDate = dateTomysql($_POST['endDate']);
$background = $_POST['background'];



$stmt = $PDO->prepare("UPDATE $screenTable
SET
id=:id
,orderNumber=:orderNumber
,title=:title
,picture=:picture
,message=:message
,theWhere=:theWhere
,theWhen=:theWhen
,theWho=:theWho
,theWhy=:theWhy
,fontSize=:fontSize
,lineHeight=:lineHeight
,startDate=:startDate
,endDate=:endDate
,background=:background


WHERE id=:id");

$stmt->bindParam(':id', $id);
$stmt->bindParam(':orderNumber', $orderNumber);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':picture', $picture);
$stmt->bindParam(':message', $message);
$stmt->bindParam(':theWhere', $theWhere);
$stmt->bindParam(':theWhen', $theWhen);
$stmt->bindParam(':theWho', $theWho);
$stmt->bindParam(':theWhy', $theWhy);
$stmt->bindParam(':fontSize', $fontSize);
$stmt->bindParam(':lineHeight', $lineHeight);
$stmt->bindParam(':startDate', $startDate);
$stmt->bindParam(':endDate', $endDate);
$stmt->bindParam(':background', $background);

$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
$stmt->execute();
}catch(PDOException $e){
	print 'Error!: Failed' . $e->getMessage();
    die();
}

/* LOG INFO */
date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s');
$action = 'Updated Slide info - Title = ' . $title . 'Message = ' . $message . 'theWhere = ' . $theWhere . 'theWhen = ' . $theWhen . 'theWho = ' . $theWho . 'theWhy = ' . $theWhy . 'FontSize = ' . $FontSize . 'lineHeight = ' . $lineHeight . 'startDate= ' . $startDate . 'endDate= ' . $endDate;

$userName = $owner;
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */


header("Location:screenmanager.php" . $e->getMessage);
?>
