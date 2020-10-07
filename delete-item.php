
<?php

require_once('includes/connect.php');
include('includes/check-login.php');

$sql = "SELECT * FROM users WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_SESSION['id']));
$user = $result->fetch(PDO::FETCH_ASSOC); 

	switch ($_GET['item']) {
		case 'fanpost':
			$table = 'fanposts';
			$redirect = 'viewposts.php';
			
		default:
			$redirect = 'viewposts.php';
			break;
	}



	$DelSql = "DELETE FROM $table WHERE id=? AND uid={$_SESSION['id']}";
	$result = $db->prepare($DelSql);
	$res = $result->execute(array($_GET['id']));

if($res){
    echo "You deleted the post";
	header("location: $redirect");
}else{
	echo "Failed to Delete Record";
	header("location: $redirect");
}
?>

    