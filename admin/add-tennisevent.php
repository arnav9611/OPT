<?php 

require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/check-subscriber.php');


if (isset($_POST) & !empty($_POST))
 {
     if(empty($_FILES['pic']['name']))
    {
        $errors[] = "You Should Upload a Pic File";
    }
   

    
 //CSRF Validation------------------------------------------------------------------------------------
    if(isset($_POST['csrf_token']))
    {
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



           if(empty($errors)){

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
                        $location = "../media/";
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


            $sql = "INSERT INTO tennisevent (tournament,stage,place,month,start,end,money,surface,champion, pic) 
            VALUES (:tournament,:stage,:place,:month,:start,:end,:money,:surface,:champion, :pic)";
    $result = $db->prepare($sql);
    $values = array(
                    ':tournament'    => $_POST['tournament'],
                    ':stage'         => $_POST['stage'],
                    ':place'         => $_POST['place'],
                    ':month'         => $_POST['month'],
                    ':start'         => $_POST['start'],
                    ':end'           => $_POST['end'],
                    ':money'         => $_POST['money'],
                    ':surface'       => $_POST['surface'],
                    ':champion'      => $_POST['champion'],
                   
                    ':pic'            => $dbpath
                    
                    );
                    
                            
                            
                            $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
                            
                            
                            if($res)
                            {
                                // After inserting the article, insert category id and article id into post_categories table
                                
                                header("location: view-tennisevents.php");
                            }else
                            {
                                $errors[] = "Failed to Add Events";
                            }
                        }

                    }

                    
//Create csrf token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();



include('includes/header.php'); 
include('includes/navigation.php'); 


?>


    
<div id="page-wrapper" style="min-height: 345px;" >
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="">Add New Tennis Event</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:black;color:white">
                            Create a New Tennis Event Here
                        </div>
                        <div class="panel-body">
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



                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">


                                        <div class="form-group">
                                            <label>Tournament Name</label>
                                            <input class="form-control" name="tournament" placeholder="" value="<?php if(isset($_POST['tournament'])){echo $_POST['tournament'];} ?>">
                                        </div>
                                        
                                        
                                        
                                       
                                        
                                        
                                        <div class="form-group">
                                            <label>Featured Image</label>
                                            <input type="file" name="pic">
                                        </div>

                                        <div class="form-group">
                                            <label>Tournament Stage Info</label>
                                            <textarea class="form-control" name="stage" rows="10"><?php if(isset($_POST['stage'])){echo $_POST['stage'];} ?></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Location of Event</label>
                                            <input class="form-control" name="place" placeholder="" value="<?php if(isset($_POST['place'])){echo $_POST['place'];} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input class="form-control" name="start" placeholder="" value="<?php if(isset($_POST['start'])){echo $_POST['start'];} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input class="form-control" name="end" placeholder="" value="<?php if(isset($_POST['end'])){echo $_POST['end'];} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Defending Champion</label>
                                            <input class="form-control" name="champion" placeholder="" value="<?php if(isset($_POST['champion'])){echo $_POST['champion'];} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Court Surface</label>
                                            <input class="form-control" name="surface" placeholder="" value="<?php if(isset($_POST['surface'])){echo $_POST['surface'];} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Tournament Prize Money</label>
                                            <input type="number" class="form-control" name="money" placeholder="" value="<?php if(isset($_POST['money'])){echo $_POST['money'];} ?>">
                                        </div>





                                        <div class="row">
                                            
                                            
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Choose Month of the Event</label>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios1" value="jan" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'jan'){ echo "checked"; } } ?>>January
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios2" value="feb" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'feb'){ echo "checked"; } } ?>>February
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios3" value="mar" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'mar'){ echo "checked"; } } ?>>March
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios4" value="apr" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'apr'){ echo "checked"; } } ?>>April
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios4" value="may" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'may'){ echo "checked"; } } ?>>May
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios4" value="june" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'june'){ echo "checked"; } } ?>>June
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios4" value="july" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'july'){ echo "checked"; } } ?>>July
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios4" value="aug" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'aug'){ echo "checked"; } } ?>>August
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios4" value="sept" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'sept'){ echo "checked"; } } ?>>September
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios4" value="oct" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'oct'){ echo "checked"; } } ?>>October
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios4" value="nov" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'nov'){ echo "checked"; } } ?>>November
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="month" id="optionsRadios4" value="dec" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['month'] == 'dec'){ echo "checked"; } } ?>>December
                                                        </label>
                                                    </div>



                                                </div>
                                            </div>
                                     </div>
                                       
                                       
                                       <!------RADIO COLUMN ENDS--->
                                        
                                        
                                        
                                        
                                        <input type="submit" class="btn  btn-success btn-block" value="Submit" />
                                    
                                    
                                    
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




