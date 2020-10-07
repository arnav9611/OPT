

<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php'); 
include('comment.php');


$sql = "SELECT * FROM posts WHERE slug=?";
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
        
        
        function time_ago_in_php($timestamp){
  
          date_default_timezone_set("Asia/Kolkata");         
          $time_ago        = strtotime($timestamp);
          $current_time    = time();
          $time_difference = $current_time - $time_ago;
          $seconds         = $time_difference;
          
          $minutes = round($seconds / 60); // value 60 is seconds  
          $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
          $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
          $weeks   = round($seconds / 604800); // 7*24*60*60;  
          $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
          $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
                        
          if ($seconds <= 60){
        
            return "Just Now";
        
          } else if ($minutes <= 60){
        
            if ($minutes == 1){
        
              return "One minute ";
        
            } else {
        
              return "$minutes m ";
        
            }
        
          } else if ($hours <= 24){
        
            if ($hours == 1){
        
              return "An hour ago";
        
            } else {
        
              return "$hours h ";
        
            }
        
          } else if ($days <= 7){
        
            if ($days == 1){
        
              return "Yesterday";
        
            } else {
        
              return "$days d ";
        
            }
        
          } else if ($weeks <= 4.3){
        
            if ($weeks == 1){
        
              return "A week ago";
        
            } else {
        
              return "$weeks w ";
        
            }
        
          } else if ($months <= 12){
        
            if ($months == 1){
        
              return "A month ago";
        
            } else {
        
              return "$months months ";
        
            }
        
          } else {
            
            if ($years == 1){
        
              return "One Year ago";
        
            } else {
        
              return "$years yrs ";
        
            }
          }
        }
        
        ?>
        
        <span style="color:grey"> 
        <?php  
        
        $created = date_create($post['created']);
        
        echo $created = date_format($created,"g:ia, d M Y");
        
        ?> </span>
        
        </h4>
      

        <div class ="col md-2">
      
      <div class="row ">
      <?php 
      $catsql = "SELECT categories.title FROM categories INNER JOIN post_categories ON post_categories.cid=categories.id WHERE post_categories.pid=?";
      $catresult = $db->prepare($catsql);
      $catresult->execute(array($post['id']));
      $catres = $catresult->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <?php foreach ($catres as $cat) { ?>
        <h4 style="color:black;font-size:0.8rem;background:#15e8c1;padding:5px;border-radius:5px"> <i class='fas fa-futbol'></i><a style="color:black;font-weight:bold;font-size:0.8rem;background:#15e8c1;padding:5px" href="<?php echo ucfirst($cat['title']); ?>"><?php echo $cat['title'];?></a></h4> &nbsp; &nbsp;
         
         
         
      <?php } ?>
     </div>
     </div>






      <hr  style="border:4px solid #ff6200">

     




        
          

          

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


<!----COMMENT FORM------->




<?php
             $comsql = "SELECT * FROM settings WHERE name='comments'";
             $comresult = $db->prepare($comsql);
             $comresult->execute();
             $com = $comresult->fetch(PDO::FETCH_ASSOC);
          ?>   

<?php if($com['value'] == 'yes'){ 
            if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
              // Create CSRF token
              $token = md5(uniqid(rand(), TRUE));
              $_SESSION['csrf_token'] = $token;
              $_SESSION['csrf_token_time'] = time();
        ?>
<?php
        $sql = "SELECT * FROM comments WHERE pid=? AND status='approved'";
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
          $sql = "SELECT comments.comment, users.username, users.fname, users.lname, users.role ,comments.created 
          FROM comments INNER JOIN users ON comments.uid=users.id WHERE comments.pid=? AND comments.status='approved' 
          ORDER BY comments.created DESC";
          
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
              
            
            
              <i class="fa fa-chevron-circle-right"></i>
            <small style="font-weight:bold">
              <?php 
        
                  echo  time_ago_in_php($comment['created']);?></small>
               
        
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
    
    <?php include('includes/singlesidebar.php'); ?>
   



  </div>
  </div>
  </div>

<?php include('includes/footer.php'); ?>


<script src="../comment.js"></script>
