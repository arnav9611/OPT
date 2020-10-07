<?php

$dsn = 'mysql:host=localhost;dbname=optblog';
$db = new PDO($dsn, 'root', '');


$sql = "SELECT * FROM posts WHERE slug=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$post = $result->fetch(PDO::FETCH_ASSOC);


$sql = "SELECT * FROM comments WHERE parent_id = '0' AND comments.pid=? ORDER BY id DESC";

$statement = $db->prepare($sql);

$statement->execute(array($post['id']));

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $output .= '




 <div class="panel panel-default">
  
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id"].'">Reply</button></div>
 </div>
 ';


 $output .= get_reply_comment($db, $row["id"]);


}

echo $output;

function get_reply_comment($db, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT * FROM comments WHERE parent_id = '".$parent_id."'
 ";
 $output = '';
 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">


    <div class="panel-heading"> <i>'.$row["created"].'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id"].'">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($db, $row["id"], $marginleft);
  }
 }
 return $output;
}

?>