<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php'); 


$usersql = "SELECT * FROM users WHERE id=?";
$userresult = $db->prepare($usersql);
$userresult->execute(array($_GET['id']));
$usercount = $userresult->rowCount();
if($usercount < 1){
  header("location: index.php");
}
$user = $userresult->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM posts WHERE uid=? AND status='published'";
$result = $db->prepare($sql);
$result->execute(array($user['id']));
$postcount = $result->rowCount();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);


?>













<div class="container my-9" style="background:#e0501f"> 
<h1 class="my-4" style="text-align:center;background:#e0501f;color:black;font-family:Anton;font-size:3rem;padding:10px;text-decoration:underline"> <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></h1>

<div class="jumbotron text-center hoverable p-4"  >

  
  <div class="row" >
<!--------------------------------------------------------------------------->



      
      <?php
      if($postcount >= 1){
        foreach ($posts as $post) 
        {
          ?>




      <!------IMAGE PART------->     
    <div class="col-md-4 offset-md-1 mx-3 my-3" >

      
          <div class="view overlay h-100 w-100" style="border-radius:15px">
        
          <?php if(isset($post['pic']) & !empty($post['pic']))
          { ?>
              <img class="img-fluid" src="<?php echo $post['pic']; ?>"  alt="">
          <?php }
          else
          { ?>
              <img class="img-fluid" src="http://placehold.it/750x300" alt="">


          <?php } ?>
          
          
             
      </div>

    </div>

<!------RIGHT SIDE PART------->
<div class="col-md-7 text-md-left ml-3 mt-3"  >

  
 

        <a href="single.php?id=<?php  echo $post['slug'];    ?>"><h4 class="h4 mb-4" style="font-family:Anton;color:black;text-transform:uppercase;font-size:2rem"><?php echo $post['title']; ?></h4></a>
  

        <a href="single.php?id=<?php  echo $post['slug'];    ?>"><p class="font-weight-bold" style="color:black"><?php  echo $post['slug'];    ?></p></a>

        <small style="color:grey;justify-content:center;font-size:0.8rem"> 
          <?php  
          $created = date_create($post['created']);
        
        echo $created = date_format($created," d M, Y"); ?></small>
  

          <hr style="background:#e0501f">
  
        
  

</div>


<?php }  ?>



  










  


          <?php }else {
            echo "<h3> NO ARTICLES BY THIS EDITOR</h3>";
          }?>

          

          








</div>
</div>
</div>
</div>


<?php include('includes/footer.php'); ?>