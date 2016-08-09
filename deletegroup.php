<!DocType HTML>
<?php
include('conn.php');
include('functions.php');

$id = $_REQUEST['id'];
$groupName = $_REQUEST['groupName'];
$stmt = $PDO->prepare("DELETE FROM groups WHERE id=:id");
$stmt->bindParam(':id', $id);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
$stmt->execute();
}catch(PDOException $e){
	print 'Error!: Failed' . $e->getMessage();
    die();
}

/* LOG INFO */
$date = $date = date('Y-m-d H:i:s');
$action = 'Deleted Group =>' . $groupName;
$userName = strtoupper($_SESSION['user']['username']);
fnaddtolog($PDO, $action, $userName, $date);
/* END OF LOG INFO */


header("Location: permissions.php");
?>