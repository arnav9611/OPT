<?php 

require_once('../includes/connect.php');
include('includes/check-login.php');



//Empty Fields Validation-----------------------------------------------------------------------------

if (isset($_POST) & !empty($_POST))
 {
   

    
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

         

           $sql = "UPDATE tennisrank SET pos=:pos,country=:country, name=:name, points=:points,
           header=:header WHERE id=:id";
            $result = $db->prepare($sql);
            $values = array(':id'          => $_POST['id'],
                            ':pos'          => $_POST['pos'],
                            ':country'      => $_POST['country'],
                            ':name'         => $_POST['name'],
                            ':points'       => $_POST['points'],
                            ':header'    => $_POST['header']
                            
                            
                            );
                            
                            
                            $res = $result->execute($values);
                            
                            
                            if($res)
                            {
                                
                                
                                header("location: view-tennisranks.php");
                            }else
                            {
                                $errors[] = "Failed to Edit Rank";
                            }
                        }



                    
//Create csrf token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();



include('includes/header.php'); 
include('includes/navigation.php'); 

$sql = "SELECT * FROM tennisrank WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$rank = $result->fetch(PDO::FETCH_ASSOC);

?>


        
      <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit  Rank</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Rank
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
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                        
                                    
                                     
                                    <div class="form-group">
                            <label>Position</label>
                            <input type="number" class="form-control" name="pos" placeholder="Position" value="<?php if(isset($rank['pos'])){echo $rank['pos'];} ?>">
                        </div>
                              
                        
                        <div class="form-group">
                                            <label>Enter Country</label>
                                            <input class="form-control" name="country" placeholder="Enter Country " value="<?php if(isset($rank['country'])){echo $rank['country'];} ?>">
                                        </div>

                        <div class="form-group">
                                            <label>Enter Player Name</label>
                                            <input class="form-control" name="name" placeholder="Enter Player Name " value="<?php if(isset($rank['name'])){echo $rank['name'];} ?>">
                                        </div>
                                        
                         
                    <div class="form-group">
                        <label>Points</label>
                            <input type="number" class="form-control" name="points" placeholder="Points" value="<?php if(isset($rank['points'])){echo $rank['points'];} ?>">
                        </div>

                        




                                       
                                       
                                       
                                       
                                        <div class="row">
                                            
                                            
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>ATP or WTA</label>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="header" id="optionsRadios1" value="atpsingle" <?php  if($rank['header'] == 'atpsingle'){ echo "checked"; } ?>>ATP Single
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="header" id="optionsRadios2" value="atpdouble" <?php if($rank['header'] == 'atpdouble'){ echo "checked";  } ?>>ATP Double
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="header" id="optionsRadios3" value="wtasingle" <?php if($rank['header'] == 'wtasingle'){ echo "checked";  } ?>>WTA Single
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="header" id="optionsRadios4" value="wtadouble" <?php  if($rank['header'] == 'wtadouble'){ echo "checked";  } ?>>WTA Double
                                                        </label>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                     </div>
                                       
                                       
                                       
                                        
                                        
                                        
                                        
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