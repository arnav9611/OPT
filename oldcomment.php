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