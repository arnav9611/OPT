<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('fcomments.php');
include('includes/navigation.php'); 



$sql = "SELECT * FROM fanposts WHERE title=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$post = $result->fetch(PDO::FETCH_ASSOC);

$usersql = "SELECT * FROM users WHERE id=?";
$userresult = $db->prepare($usersql);
$userresult->execute(array($post['uid']));
$user = $userresult->fetch(PDO::FETCH_ASSOC);

?>





     



 





<div class="container">

  <div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-8">
    

      <!-- Title -->
      <h1 class="mt-4" style="font-family:Anton"><?php echo $post['title']; ?></h1>
  
      <!-- Author -->
      <h4  style="font-size:0.9rem;padding:10px;font-weight:400">
       By 
        <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?>
          
        
          
          |
        
        <?php 
        
        $created = date_create($post['created']);
        
         echo $created = date_format($created,"D, d M Y ");
         
        ?>
        
        </h4>
      

      





      <hr />

     




        
          

          

          <!-- Preview Image -->
          <?php if(isset($post['pic']) & !empty($post['pic']))
            {?>
            
            <img class="img-fluid" src="<?php echo $post['pic']; ?>" > 
    
    
            
            <?php }else{  ?>

                <img  class="img-fluid" src="http://placehold.it/750x300" alt=""> 
  

            <?php } ?>
          

          

          <!-- Post Content -->
<div class="content">
<h5 style="font-size:1.1rem;font-weight:400;padding:10px"> <?php echo $post['content']; ?></h5>
<hr >




















          <?php
             $comsql = "SELECT * FROM settings WHERE name='comments'";
             $comresult = $db->prepare($comsql);
             $comresult->execute();
             $com = $comresult->fetch(PDO::FETCH_ASSOC);
          ?>   










<!----------LOGIC IF COMMENTS ARE ENABLED -------------------------------------------->
        
        <?php if($com['value'] == 'yes'){ 
            if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
              // Create CSRF token
              $token = md5(uniqid(rand(), TRUE));
              $_SESSION['csrf_token'] = $token;
              $_SESSION['csrf_token_time'] = time();
        ?>












     
       <!-- ------------------------Comments Form ----------------------------------------->

       <?php
        $sql = "SELECT * FROM fcomments WHERE pid=? AND status='approved'";
        $result = $db->prepare($sql);
        $result->execute(array($post['id']));
        $commentcount = $result->rowCount();
        if($commentcount >= 0)
        {
      ?>
      <div class="card my-4" style="border-radius:15px">
        <h4 class="card-header" style="background:#bac8de;color:black;border-radius:15px 15px 0 0;font-weight:bold;font-size:1rem;color:white"><i class="fa fa-comment-o" aria-hidden="true"></i> Leave your thoughts   &nbsp;  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-comments-o" aria-hidden="true"></i> <?php echo $commentcount; ?> Comments
      <?php } ?></h4>
       
     
        <div class="card-body">
      
        <?php
              if(!empty($messages))
              {
                  echo "<div class='alert alert-success'>";
                  foreach ($messages as $message) {
                      echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;". $message ."<br>";
                  }
                  echo "</div>";
              }
          ?>

          <?php
              if(!empty($errors))
              {
                  echo "<div class='alert alert-danger'>";
                  foreach ($errors as $error) {
                      echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;". $error ."<br>";
                  }
                  echo "</div>";
              }
          ?>
            

          <form method="post">
            <div class="form-group">


            <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
            <input type="hidden" name="pid" value="<?php echo $post['id']; ?>">
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <textarea class="form-control" name="comment" rows="3" required="" style="border-radius:15px"></textarea>
            </div>

            <button type="submit" class="btn btn-md" style="background:white;color:black;border-radius:15px;font-weight:700"><i class="fa fa-paper-plane" aria-hidden="true" ></i> Comment</button>
          </form>

        </div>
      </div>


      <?php }else{ echo "<h3>Please login to post comments</h3>"; }
            }else{ echo "<h3>Comments are Disabled</h3>"; } ?>


    


<div class="card my-9" style="border-radius:15px">

      <?php
          $sql = "SELECT fcomments.comment, users.username, users.fname, users.lname, users.role ,fcomments.created 
          FROM fcomments INNER JOIN users ON fcomments.uid=users.id WHERE fcomments.pid=? AND fcomments.status='approved' 
          ORDER BY fcomments.created DESC";
          
          $result = $db->prepare($sql);
          $result->execute(array($post['id'])) or die(print_r($result->errorInfo(), true));
          $comments = $result->fetchAll(PDO::FETCH_ASSOC);
          foreach($comments as $comment)
          {
          ?>
      




      <div class="card mb-1">
        
        
        <div class="card-body">
        
          <p style="font-weight:bold;color:black">
          
              <?php if((isset($comment['fname']) || isset($comment['lname'])) & (!empty($comment['fname']) || !empty($comment['lname']))) { echo $comment['fname'] . " " . $comment['lname']; }else{ echo $comment['username']; } ?> 
               
              <?php if(($comment['role'] == 'administrator')){ echo "<span class='badge badge-danger'>OPT Admin</span>"; }
              elseif(($comment['role'] == 'editor')){ echo "<span class='badge badge-primary'>OPT Editor</span>"; } ?>
              
            
            
          |
            <small>
              <?php 
        
                  $created = date_create($comment['created']);
        
                   echo $created = date_format($created," g:i a, d M Y  ");
                  
               ?>
        
            </small>

            </p>
            
          <h6>
          <?php echo $comment['comment']; ?>
          </h6>
         
          <hr>
          
        </div>
        
      </div>
      
      

      
      <?php } ?>
  
      </div>



   
   
      </div>
      
    </div>
    <!------sidebar down----------->
    
    <?php include('includes/fansidebar.php'); ?>
   



  </div>
  </div>
  </div>

<?php include('includes/footer.php'); ?>