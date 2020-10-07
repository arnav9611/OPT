
<?php 

require_once('includes/connect.php');

include('fcomments.php');  

?>


<?php


        $comsql = "SELECT * FROM settings WHERE name='comments'";
        $comresult = $db->prepare($comsql);
        $comresult->execute();
        $com = $comresult->fetch(PDO::FETCH_ASSOC);
    ?>   
<!----------LOGIC IF COMMENTS ARE ENABLED -------------------------------------------->
        <?php if($com['value'] == 'yes')
        { if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
              $token = md5(uniqid(rand(), TRUE));
              $_SESSION['csrf_token'] = $token;
              $_SESSION['csrf_token_time'] = time();
        ?>
     
     <?php
        
        $sql = "SELECT * FROM fcomments WHERE pid=?";
        $result = $db->prepare($sql);
        $result->execute(array($fpost['id']));
        $commentcount = $result->rowCount();
        if($commentcount >= 0)
        {
         ?>

            <small style="font-size:0.8rem;font-weight:bold;text-align:right">  <?php echo $commentcount; ?> Comments </small>
            <?php } ?>

            </h4>
     
       
     <!-----MODAL PART--->
<div class="modal fade left" id="fullHeightModalLeft" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" style="">

  
  <div class="modal-dialog modal-full-height modal-left " role="document">
      
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
    
   <div class="modal-content" style="background:white;color:black">
    
   <h6 style="padding:10px;font-size:1rem;font-weight:bold"> Comments </h6>
    
    
    
    <div class="modal-header ">
    
    <h4 class="modal-title w-100" id="myModalLabel">
    
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
    <form method="post">
        <div class="form-group">


            <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
            <input type="hidden" name="pid" value="<?php echo $fpost['id']; ?>">
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">

   

            
            <textarea class="form-control" name="comment" rows="3" required="" style="border-radius:15px"></textarea>
            
            
            
            
            
           
        </div>
       
        
       <button type="submit" class="btn btn-md" style="background:white;color:black;border-radius:15px;font-weight:700">
                    <i class="fa fa-paper-plane" aria-hidden="true" ></i> Comment
       </button>
        
        
        
        </form>
        </h4>
        
       
        </div>
  

<?php } } else{ echo "<h3>Comments are Disabled</h3>"; } ?>


    

<!------COMMENT BODY--------------------->
<div class="modal-body">

      <?php
          $sql = "SELECT fcomments.comment, users.username, users.fname, users.lname, users.role ,fcomments.created 
          FROM fcomments INNER JOIN users ON fcomments.uid=users.id WHERE fcomments.pid=? 
          ORDER BY fcomments.created DESC";
          
          $result = $db->prepare($sql);
          $result->execute(array($fpost['id'])) or die(print_r($result->errorInfo(), true));
          $comments = $result->fetchAll(PDO::FETCH_ASSOC);
          foreach($comments as $comment)
          {
                ?>
      



<!-------COMMENT CARD BODY--------------->
      <div class="card mb-1" >
        
        
        <div class="card-body">
        
          <p style="font-weight:bold;color:black">
          
              <?php if((isset($comment['fname']) || isset($comment['lname'])) & (!empty($comment['fname']) || !empty($comment['lname']))) { echo $comment['fname'] . " " . $comment['lname']; }else{ echo $comment['username']; } ?> 
              <?php if(($comment['role'] == 'administrator')){ echo "<span class='badge badge-danger'> OPT</span>"; }
              elseif(($comment['role'] == 'editor')){ echo "<span class='badge badge-primary'> OPT</span>"; } ?>
            
          |
            <small>
              <?php 
        
                  $created = date_create($comment['created']);
        
                   echo $created = date_format($created,"g:i a, d M Y  ");
         
               ?>
        
            </small>
            </p>
          
          

          <h6 style="font-size:0.8rem"> <?php echo $comment['comment']; ?></h6>
         

          <hr>


        </div>
        
      </div>
      
      

      
      <?php } ?>
  <!---COMMENT CARD BODY ENDS------>



      </div>


      <!-----------COMMENT MODAL BODY------------->
  
  
  
      </div> 
      <!-------MODAL CONTENT ENDS------>
   
   
   </div>
   </div>
<!---------COMMENT BODY ENDS------------->

   