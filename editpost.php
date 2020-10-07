<?php 

require_once('includes/connect.php');
include('includes/check-login.php');



//Empty Fields Validation-----------------------------------------------------------------------------

if (isset($_POST) & !empty($_POST)) 
{
   
   
    
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

                if(isset($name) && !empty($name))
                {
                    if($type == "image/jpeg")
                    {
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
           


            $sql = "UPDATE fanposts SET title=:title, content=:content,  news=:news, ";
            if(isset($dbpath) & !empty($dbpath))
            {
                 $sql .="pic=:pic, "; 
            } 
            if(isset($dbpath) & !empty($dbpath))
            { 
                $sql .="video=:video, "; 
            }  
            $sql .= "updated=NOW() WHERE id=:id";
            
            $result = $db->prepare($sql);
            $values = array( ':title'    =>  strip_tags($_POST['title']),
                             ':content'  =>  strip_tags($_POST['content']),
                             ':news'     =>  $_POST['news'],
                             ':id'       =>  $_POST['id'],
                            
                            );


            if(isset($dbpath) & !empty($dbpath))
            {
                 $values[':pic'] = $dbpath;
            }  
            if(isset($dbpath) & !empty($dbpath))
            { 
                $values[':video'] = $dbpath;
            }  
            $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
                            
                            if($res)
                            {
                                
                                
                                header("location:talkofthetown");
                            }else
                            {
                                $errors[] = "Failed to Edit Post";
                            }
       
    }
 }

        

//Create csrf token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();


$sql = "SELECT * FROM users WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_SESSION['id']));
$user = $result->fetch(PDO::FETCH_ASSOC); 

$sql = "SELECT * FROM fanposts WHERE id=? AND uid={$_SESSION['id']}";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$postcount = $result->rowCount();
$fpost = $result->fetch(PDO::FETCH_ASSOC);
    if($postcount <= 0)
    {
        header("location: talkofthetown.php");
    }
 

include('includes/header.php'); 
include('includes/navigation.php'); 

?>







<div id="page-wrapper" style="min-height: 345px">
    
    <div class="row">
        <div class="container">
            <div class="panel panel-default">
                
                <div class="panel-body">
                    <?php
                        if(!empty($messages)){
                            echo "<div class='alert alert-success'>";
                            foreach ($messages as $message) {
                                echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;". $message ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                    <?php
                        if(!empty($errors)){
                            echo "<div class='alert alert-danger'>";
                            foreach ($errors as $error) {
                                echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;". $error ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    
   
        
        
                   

       
                    <div class="form-group" style="padding:10px;font-weight:bold">
                        <label>Lets share with the world</label>
                        <input class="form-control" style="border-radius:15px" name="title" placeholder="Leave your post title" value="<?php if(isset($fpost['title'])){echo $fpost['title'];} ?>">
                    </div>
        

                    <div class="form-group">
                        
                    <?php
                        if(isset($fpost['pic']) & !empty($fpost['pic']))
                        {
                            echo "<img src='".$fpost['pic']."' height='100px' width='200px'>";                      
                            echo "<a href='delete-pic.php?id=". $_GET['id'] ."&type=fanpost'>Delete Picture</a>";
                            }else{
                        ?>
                    <input type="file" name="pic" id="img" style="display:none;"/>
                    <label for="img" style="color:#041124;font-weight:bold;cursor:pointer"><i class="fa fa-picture-o" aria-hidden="true"></i> Upload Image</label>
                    <?php } ?>
                                                        
                        


                </div>

                <div class="form-group">
                        <?php

                        if(isset($fpost['video']) & !empty($fpost['video']))
                        {
                        echo "<video> <source src='".$fpost['video']."' ></video>";                           
                        echo "<a href='delete-video.php?id=". $_GET['id'] ."&type=fanpost'>Delete Video</a>";
                        }else
                        {
                        ?>
                    <input type="file" name="video" id="video" style="display:none;"/>
                    <label for="video" style="color:#041124;font-weight:bold;cursor:pointer"><i class="fa fa-file-video-o" aria-hidden="true"></i> Upload Video</label>
                    <?php } ?>

                </div>

                <div class="form-group">
                    <label style="font-weight:bold">Share with Us</label>
                    <textarea class="form-control" name="content" rows="10"><?php if(isset($fpost['content'])){echo $fpost['content'];} ?></textarea>
                </div>






        <div class="form-group">
            <label style="font-weight:bold">Category</label>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios8" value="football" <?php  if($fpost['news'] == 'football'){ echo "checked"; }  ?>> Football
                                                </label>
                                            </div>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios9" value="esports" <?php  if($fpost['news'] == 'esports'){ echo "checked";  } ?>> Esports
                                                </label>
                                            </div>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios10" value="tennis" <?php  if($fpost['news'] == 'tennis'){ echo "checked"; } ?>> Tennis
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios4" value="transfer" <?php  if($fpost['news'] == 'transfer'){ echo "checked";  } ?>> Transfer News
                                                </label>
                                            </div>
                                            
        </div>
     

    
        <input type="submit" class="btn" style="background:lightpink" value="Save" />
    
    </form>

        
      
                                        
       
    </div>
                        <!-- /.col-lg-6 (nested) -->   
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
      
    </div>
    <!-- /.row -->
</div>

<?php include('includes/footer.php'); ?>