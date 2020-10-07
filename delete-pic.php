<?php
require_once('includes/connect.php');
include('admin/includes/check-login.php');



$sql = "SELECT * FROM users WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_SESSION['id']));
$user = $result->fetch(PDO::FETCH_ASSOC); 
if(isset($_GET) & !empty($_GET))
{
	$id = $_GET['id'];
	switch ($_GET['type']) {
		case 'fanpost':
			$table = 'fanposts';
            $redirect = "editpost.php?id=$id";
			break;
		
		
		default:
			$redirect = 'index.php';
			break;
	}
	
		$sql = "SELECT * FROM $table WHERE id=?";
		$result = $db->prepare($sql);
		$result->execute(array($_GET['id']));
		$post = $result->fetch(PDO::FETCH_ASSOC);
		$filepath = ''.$post['pic'];
        if(unlink($filepath))
        {
			$sql = "UPDATE $table SET pic='', updated=NOW() WHERE id=?";
			$result = $db->prepare($sql);
			$res = $result->execute(array($_GET['id']));
            if($res)
            {
				header("location: $redirect");
			}
		}
    }

?>