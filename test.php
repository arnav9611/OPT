<?php
$comsql = "SELECT * FROM settings WHERE name='comments'";
$comresult = $db->prepare($comsql);
$comresult->execute();
$com = $comresult->fetch(PDO::FETCH_ASSOC);
?>  
<?php if($com['value'] == 'yes')
{ 
            if(isset($_SESSION['id']) & !empty($_SESSION['id']))
            {
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
      
        <h4 style="background:#bac8de;color:black;border-radius:15px 15px 0 0;font-weight:bold;font-size:1rem;color:white"><i class="fa fa-comment-o" aria-hidden="true"></i> Leave your thoughts   &nbsp;  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-comments-o" aria-hidden="true"></i> <?php echo $commentcount; ?> Comments
      <?php } ?></h4>






  <div class="container">
   
   
   <form method="POST" id="comment_form">
    

    
    <div class="form-group">
    
    <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
    <input type="hidden" name="pid" value="<?php echo $post['id']; ?>">
            
     <textarea name="comment" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>


    <div class="form-group">
     <input type="hidden" name="id" id="comment_id" value="0" />
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>


   </form>
            
      <?php }else{ echo "<h3>Please login to post comments</h3>"; }
            }else{ echo "<h3>Comments are Disabled</h3>"; } ?>

   <span id="comment_message"></span>

   <br />

   <div id="display_comment"></div>
   
  </div>
  <?php } ?>

</div>