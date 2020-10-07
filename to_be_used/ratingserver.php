<?php 

require_once('includes/connect.php');




// if user clicks like or dislike button
if (isset($_POST['action'])) 
{
  if(isset($_SESSION['id']) & !empty($_SESSION['id']))
  {
    // display logged in user details
    $sql = "SELECT * FROM users WHERE id=?";
    $result = $db->prepare($sql);
    $result->execute(array($_SESSION['id']));
    $user = $result->fetch(PDO::FETCH_ASSOC); 
    $uid = $user['id'];
  }
  $pid = $_POST['pid'];
  $action = $_POST['action'];



  switch ($action)
   {
  	case 'like':
         $sql="INSERT INTO rating_info (uid, pid, rating_action) 
         	   VALUES ($uid, $pid, 'like') 
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
                               
          $res = $result->execute() or die(print_r($result->errorInfo(), true));
                            
    break;
  	case 'dislike':
          $sql="INSERT INTO rating_info (uid, pid, rating_action) 
               VALUES ($uid, $pid, 'dislike') 
                ON DUPLICATE KEY UPDATE rating_action='dislike'";
                
                                
                       


                  
                  
            $res = $result->execute() or die(print_r($result->errorInfo(), true));


    break;
  	case 'unlike':
          $sql="DELETE FROM rating_info WHERE uid=$uid AND pid=$pid";
          
	 break;
  	case 'undislike':
            $sql="DELETE FROM rating_info WHERE uid=$uid AND pid=$pid";
           
     break;
  	default:
  		break;
  }

  
}





// Get total number of likes for a particular post
function getLikes($id)
{
  
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE  pid = $id AND rating_action='like'";
  $result = $db->prepare($sql);
  $result->execute();
  $result->fetchAll(PDO::FETCH_ASSOC);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
  
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE pid = $id AND rating_action='dislike'";
  $result = $db->prepare($sql);
  $result->execute();
  $result->fetchAll(PDO::FETCH_ASSOC);
  
  return $result[0];
}


// Check if user already likes post or not

function userLiked($pid)
{
    
    $sql = "SELECT * FROM rating_info WHERE  pid=$pid AND rating_action='like'";
    $result = $db->prepare($sql);
    $result->execute(array($_GET['id']));
    $result->fetchAll(PDO::FETCH_ASSOC);
    $likecount = $result->rowCount();
    if ($likecount > 0) {
        return true;
    }else{
        return false;
    }
  }

// Check if user already dislikes post or not
function userDisliked($pid)
{
  
  $sql = "SELECT * FROM rating_info WHERE  
  		   pid=$pid AND rating_action='dislike'";
  $result = $db->prepare($sql);
  $result->execute();
  $result->fetchAll(PDO::FETCH_ASSOC);
  $dislikecount = $result->rowCount();
  if ($dislikecount > 0) {
  	return true;
  }else{
  	return false;
  }
}

?>