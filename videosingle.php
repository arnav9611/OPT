<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('comment.php');
include('includes/navigation.php'); 

$sql = "SELECT * FROM videoposts WHERE slug=? AND status='published'";
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
      <p class="lead">
        by
            <a style="color:black" href="user-posts.php?id=<?php echo $user['id']; ?>"><?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname'])))
             {
               echo $user['fname'] . " " . $user['lname']; 
             }else
             {
               echo $user['username'];
              } 
              
              ?>
          
            </a>


            
      </p>
      

      <!-- Date/Time -->
      <p>Posted on <?php echo $post['created']; ?></p>

      

        
          

          

          <!-- Preview Image -->
          <?php if(isset($post['video']) & !empty($post['video']))
            {?>
            
            <video class="img-fluid" controls muted>
        <source src="<?php echo $post['video']; ?>" > 
    
    </video>
            
            <?php }else{  ?>

                <video  class="img-fluid">
        <source src="http://placehold.it/750x300" alt=""> 
    </video>

            <?php } ?>
          

          

          <!-- Post Content -->
          <div class="content">
           <h5> <?php echo $post['content']; ?></h5>
          <hr style="border:2px solid black">

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
      <div class="card my-4">
        <h4 class="card-header" style="background:black;color:white;font-family:Anton">Leave a Comment:</h4>
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
            <?php
        $sql = "SELECT * FROM comments WHERE pid=? AND status='approved'";
        $result = $db->prepare($sql);
        $result->execute(array($post['id']));
        $commentcount = $result->rowCount();
        if($commentcount >= 0)
        {
      ?>
      <h4><?php echo $commentcount; ?> Comments</h4>
      <?php } ?>

          <form method="post">
            <div class="form-group">


            <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
            <input type="hidden" name="pid" value="<?php echo $post['id']; ?>">
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <textarea class="form-control" name="comment" rows="3" required=""></textarea>
            </div>

            <button type="submit" class="btn btn-md" style="background:black;color:white">Submit</button>
          </form>

        </div>
      </div>


      <?php }else{ echo "<h3>Please login to post comments</h3>"; }
            }else{ echo "<h3>Comments are Disabled</h3>"; } ?>


    


      

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
      




      <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
          <h6 class="mt-0" style="font-family:Anton">
              <?php if((isset($comment['fname']) || isset($comment['lname'])) & (!empty($comment['fname']) || !empty($comment['lname']))) { echo $comment['fname'] . " " . $comment['lname']; }else{ echo $comment['username']; } ?> 
               
              <?php if(($comment['role'] == 'administrator')){ echo "<span class='badge badge-danger'>Admin</span>"; }
              elseif(($comment['role'] == 'editor')){ echo "<span class='badge badge-primary'>Editor</span>"; } ?>
              <?php echo $comment['created']; ?>
            </h6>
          <?php echo $comment['comment']; ?>
          
          
        </div>
        
      </div>
      <?php } ?>

    
  
   
   
      </div>
      
    </div>
    <!------sidebar down----------->
    
    <?php include('includes/sidebar.php'); ?>




  </div>
  </div>
  </div>

<?php include('includes/footer.php'); ?>