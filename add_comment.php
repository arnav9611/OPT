<?php

include('includes/connect.php'); 



$error = '';

$comment = '';





  if($error == '')
    {
    	$sql = "INSERT INTO comments (uid, pid, comment, parent_id, status) VALUES (:uid, :pid, :comment,:parent_id, 'approved')";
        $result = $db->prepare($sql);
        $values = array(':uid'      => $_POST['uid'],
                        ':pid'      => $_POST['pid'],
                        ':comment'  => strip_tags($_POST['comment']),
                        ':parent_id'=> $_POST['id']            //To save from XSS attack
                        );
        $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
        $error = '<label class="text-success">Comment Added</label>';
    }



$data = array(
 'error'  => $error
);

echo json_encode($data);

?>


