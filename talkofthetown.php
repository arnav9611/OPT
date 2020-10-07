<?php 

require_once('includes/connect.php');
include('includes/check-login.php'); 



//Empty Fields Validation-----------------------------------------------------------------------------

if (isset($_POST) & !empty($_POST)) {
   
   
    
 //CSRF Validation------------------------------------------------------------------------------------
    if(isset($_POST['csrf_token'])){
        if($_POST['csrf_token'] === $_SESSION['csrf_token']){
        }else{
            $errors[] = "Problem with CSRF Token Verification";
        }
       }
       else{
           $errors[] = "Problem with CSRF Token Validation";
       }

       $max_time = 60*60*24; // in seconds
       if(isset($_SESSION['csrf_token_time'])){
           $token_time = $_SESSION['csrf_token_time'];
           if(($token_time + $max_time) >= time() ){
           }else{
               $errors[] = "CSRF Token Expired";
               unset($_SESSION['csrf_token']);
               unset($_SESSION['csrf_token_time']);
           }
       }else{
               
               unset($_SESSION['csrf_token']);
               unset($_SESSION['csrf_token_time']);
           }

           if(empty($errors))
           {

            if(isset($_FILES) & !empty($_FILES))
            {
                $name = $_FILES['pic']['name'];
                $size = $_FILES['pic']['size'];
                $type = $_FILES['pic']['type'];
                $tmp_name = $_FILES['pic']['tmp_name'];

                if(isset($name) && !empty($name)){
                    if($type == "image/jpeg"){
                        $location = "media/";
                        $filename = time() . $name;
                        $uploadpath = $location.$filename;
                        $dbpath = "media/" . $filename;
                        move_uploaded_file($tmp_name, $uploadpath);
                    }else
                    {
                        $errors[] = "Only Upload JPEG files";
                    }
            }


            if(isset($_FILES) & !empty($_FILES))
            {
                $name = $_FILES['video']['name'];
                $size = $_FILES['video']['size'];
                $type = $_FILES['video']['type'];
                $tmp_name = $_FILES['video']['tmp_name'];

                if(isset($name) && !empty($name))
                {
                    if($type == "video/mp4")
                    {
                        $location = "media/";
                        $filename = time() . $name;
                        $uploadpath = $location.$filename;
                        $dbpath = "media/" . $filename;
                        move_uploaded_file($tmp_name, $uploadpath);
                    }else
                    {
                        $errors[] = "Only Upload mp4 files";
                    }
                }








            }

            $sql = "INSERT INTO fanposts (uid, title, content, news, pic,video) 
                    VALUES (:uid, :title, :content, :news, :pic, :video)";
            $result = $db->prepare($sql);
            $values = array(':uid'      => $_SESSION['id'],
                            ':title'    => strip_tags($_POST['title']),
                            ':content'  => strip_tags($_POST['content']),
                            ':news'     => $_POST['news'],
                            ':pic'      => $dbpath,
                            ':video'    => $dbpath
                            
                            );
                            
                            
                            $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
                            
                            
                            if($res)
                            {
                                
                                
                                header("location: talkofthetown");
                            }else
                            {
                                $errors[] = "Failed to Add Post";
                            }
       
       



    }



//No erros end//

           }

        }

//Create csrf token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();



include('includes/header.php'); 
include('includes/navigation.php'); 


        if(isset($_SESSION['id']) & !empty($_SESSION['id']))
  
          {
    // display logged in user details
                $sql = "SELECT * FROM users WHERE id=?";
                $result = $db->prepare($sql);
                $result->execute(array($_SESSION['id']));
                $user = $result->fetch(PDO::FETCH_ASSOC); 
     
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
                  
                        return "$minutes mins ";
                  
                      }
                  
                    } else if ($hours <= 24){
                  
                      if ($hours == 1){
                  
                        return "An hour ago";
                  
                      } else {
                  
                        return "$hours hrs ";
                  
                      }
                  
                    } else if ($days <= 7){
                  
                      if ($days == 1){
                  
                        return "Yesterday";
                  
                      } else {
                  
                        return "$days days ";
                  
                      }
                  
                    } else if ($weeks <= 4.3){
                  
                      if ($weeks == 1){
                  
                        return "A week ago";
                  
                      } else {
                  
                        return "$weeks weeks ";
                  
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


      



                                        
                                        
                                     

                                    
                                       
                                       
                                       
                                       
<div >                         
    <h1 style="text-align:center;font-family:Anton;font-size:1.5rem;padding:20px"> Welcome  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a> </h1>   
    <h1 style="text-align:center;font-family:Anton;font-size:1.5rem;padding:20px;border-bottom:2px solid black"> You are our  OffPitcher No #<?php echo $user['id']; ?> 
    
             
                                    
<?php } ?>     
</div>





<div class="container">
<button type="button" class="btn " data-toggle="modal" data-target="#fullHeightModalRight" style="border-radius:5px;font-family:Anton;text-align:left">
<i class='fas fa-pen'></i>  &nbsp; Write a Post
</button>
</div>
<!-- Full Height Modal Right -->
<div class="modal fade top" id="fullHeightModalRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" style="background:black">

  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-full-height modal-top " role="document">

  <?php
                            if(!empty($messages)){
                                echo "<div class='alert alert-success'>";
                                foreach ($messages as $message) {
                                    echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;".$message."<br>";
                                }
                                echo "</div>";
                            }
                        ?>
                    
                    
                    <?php
                            if(!empty($errors)){
                                echo "<div class='alert alert-danger'>";
                                foreach ($errors as $error) {
                                    echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;".$error."<br>";
                                }
                                echo "</div>";
                            }
                        ?>

                    <form role="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
    
    
    
    
    <div class="modal-content" style="background:white;color:black">



      <div class="modal-header">
      <h4 class="modal-title w-100" id="myModalLabel">

       
                    <div class="form-group" >
                        <label style="font-weight:bold" >Lets share with the world</label>
                        <input class="form-control" style="border-radius:15px" name="title" placeholder="Leave your post title" value="<?php if(isset($_POST['title'])){echo $_POST['title'];} ?>" autofocus>
                    </div>
        
        
        
        </h4>


        <!----CLOSE BUTTON------->


        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>



      </div>

<!-----MODAL HEADER ENDS------>

      <div class="modal-body">
        
        
      <input type="file" name="pic" id="img" style="display:none;"/>
      <label for="img" style="color:#041124;font-weight:bold;cursor:pointer"><i class="fa fa-picture-o" aria-hidden="true"></i> Upload Image</label>

                                          
        &nbsp; &nbsp;     &nbsp; &nbsp;  
      <input type="file" name="video" id="video" style="display:none;"/>
      <label for="video" style="color:#041124;font-weight:bold;cursor:pointer"><i class="fa fa-file-video-o" aria-hidden="true"></i> Upload Video</label>
      
     <div class="form-group" style="padding:20px">
            <label style="font-weight:bold">Share your Post Content</label>
            <textarea class="form-control" name="content" rows="10"><?php if(isset($_POST['content'])){echo $_POST['content'];} ?></textarea>
     </div>



        <div class="form-group" style="padding:30px">
                    <label style="font-weight:bold;">Category</label>
                                            
                                        <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios8" value="football" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['news'] == 'football'){ echo "checked"; } } ?>> Football
                                                </label>
                                            </div>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios9" value="esports" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['news'] == 'esports'){ echo "checked"; } } ?>> Esports
                                                </label>
                                            </div>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios10" value="tennis" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['news'] == 'tennis'){ echo "checked"; } } ?>> Tennis
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios4" value="transfer" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['news'] == 'transfer'){ echo "checked"; } } ?>> Transfer News
                                                </label>
                                            </div>
                                        
        </div>
     



</div>                    


      <div class="modal-footer justify-content-center">
                 <input type="submit" class="btn" style="border-radius:15px;background:lightgreen;color:black;font-weight:bold" value="Post" />
                <button type="button" class="btn " data-dismiss="modal" style="border-radius:15px;background:pink;color:black;font-weight:bold">Cancel</button>
        
     </div>
      
    
    
    
    </div>




    </form>
  </div>
</div>







<?php 


$sql = "SELECT * FROM fanposts ORDER BY created DESC";
$result = $db->prepare($sql);
$result->execute();
$fanposts = $result->fetchAll(PDO::FETCH_ASSOC);


?>




  

<div class="container">

  <div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-8">

    <h1 class="page-title" style="text-align:center;background:#19181c;color:yellow;font-family:Anton;font-size:5rem;" ><i style="color:yellow" class="fa fa-chevron-circle-down"></i> tALKS OF THE TOWN</h1>

<?php foreach ($fanposts as $fpost) 
{ ?>

  
<div class="col mb-4">
    
    <div class="card  " style="background:white">
    
    <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($fpost['uid']));
                $usercount = $result->rowCount();
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
    ?>   
               
        
        <h4  style="font-size:1rem;font-weight:bold;padding:10px">
       
        <i class='fas fa-user-circle'></i> <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?>
          
        
          
          
        <p style="font-size:0.69rem">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i style="color:black" class="fa fa-chevron-circle-right"></i>
        <?php  echo  time_ago_in_php($fpost['created']); ?> 
        </p>
        
        </h4>
        
      <div class="view overlay">

      <h4 class="card-title" style="color:black;font-size:1.6rem;padding:5px;font-weight:bold;text-align:center"> <a href="fsingle.php?id=<?php echo $fpost['title'];?>"></a><?php echo ucfirst($fpost['title']); ?></h4>
      <?php if(isset($fpost['pic']) & !empty($fpost['pic'])){?>

       
        <img class="card-img-top w-100" style="max-height:400px"  src="<?php echo $fpost['pic']; ?>"
          alt="">
        
          <h6 style="background:#bac8de;color:black;font-size:1rem;font-family:Anton;padding:2px;letter-spacing:0.6px"> &nbsp; &nbsp;&nbsp;<?php echo ucfirst($fpost['news']); ?> <h6>

        <a href="fsingle.php?id=<?php echo $fpost['title'];    ?>">
          <div class="mask rgba-white-slight"></div>
        </a>

        <?php }  ?>

        

      </div>

     
      
      
     



     
     
     
        


     
     <?php
        
        $sql = "SELECT * FROM fcomments WHERE pid=?";
        $result = $db->prepare($sql);
        $result->execute(array($fpost['id']));
        $commentcount = $result->rowCount();
        if($commentcount >= 0)
        {
         ?>
             <a style="color:#b30b1e;font-weight:bold;padding:10px;text-align:center" href="fsingle.php?id=<?php echo $fpost['title'];?>"> tALKS <i class="fa fa-chevron-circle-right"></i> </a>
    
             <hr>
            <small style="font-size:0.8rem;font-weight:bold;text-align:right;padding:10px;color:black">  <?php echo $commentcount; ?> <a style="color:black" href="fsingle.php?id=<?php echo $fpost['title'];?>"> Talks </a></small>
            <?php } ?>

          
     
            
     <!-----MODAL PART--->

   
     
      
    
 







                  





  <!-- Card -->
 </div>
 
  <!---COL B-4---->
  </div>
  <?php } ?>


  

</div>


<?php 
include('includes/fansidebar.php'); ?>
 
</div>


</div>


<?php include('includes/footer.php'); ?>