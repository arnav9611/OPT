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

         
           $sql = "UPDATE grandslam SET name=:name,year=:year, winner=:winner, runnerup=:runnerup,
           money=:money,score=:score,header=:header WHERE id=:id";
            $result = $db->prepare($sql);
            $values = array(':id'          => $_POST['id'],
                            ':name'          => $_POST['name'],
                            ':year'    => $_POST['year'],
                            ':winner'      => $_POST['winner'],
                            ':runnerup'     => $_POST['runnerup'],
                            ':money'    => $_POST['money'],
                            ':score'    => $_POST['score'],
                            ':header'    => $_POST['header']
                            
                            );
                            
                            
                            $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
                            
                            
                            if($res)
                            {
                                
                                
                                header("location: view-grandslams.php");
                            }else
                            {
                                $errors[] = "Failed to EDIT grandslam";
                            }
                        }



                    
//Create csrf token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();



include('includes/header.php'); 
include('includes/navigation.php'); 

$sql = "SELECT * FROM grandslam WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$grand = $result->fetch(PDO::FETCH_ASSOC);
?>


        
      <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Grand Slam</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Grand Slam
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
                            <label>Year</label>
                            <input type="number" class="form-control" name="year" placeholder="Year" value="<?php if(isset($grand['year'])){echo $grand['year'];} ?>">
                        </div>
                              
                        
                        <div class="form-group">
                                            <label>Enter Grand Slam Name</label>
                                            <input class="form-control" name="name" placeholder="Enter Grand Slam Name " value="<?php if(isset($grand['name'])){echo $grand['name'];} ?>">
                                        </div>

                        <div class="form-group">
                                            <label>Enter Winner Name</label>
                                            <input class="form-control" name="winner" placeholder="Enter Winner Name " value="<?php if(isset($grand['winner'])){echo $grand['winner'];} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Runner Up Name</label>
                                            <input class="form-control" name="runnerup" placeholder="Enter Runner Up Name " value="<?php if(isset($grand['runnerup'])){echo $grand['runnerup'];} ?>">
                                        </div>

                                          
                                    <div class="form-group">
                            <label>Total Prize Money</label>
                            <input type="number" class="form-control" name="money" placeholder="Enter Prize Money" value="<?php if(isset($grand['money'])){echo $grand['money'];} ?>">
                        </div>
                    

                          
                        <div class="form-group">
                            <label>Match Score</label>
                            <input  class="form-control" name="score" placeholder="Enter Match Score" value="<?php if(isset($grand['score'])){echo $grand['score'];} ?>">
                        </div>




                                       
                                       
                                       
                                       
                                        <div class="row">
                                            
                                            
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Mens or Womens</label>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="header" id="optionsRadios1" value="atpsingle" <?php if($grand['header'] == 'atpsingle'){ echo "checked"; }  ?>>ATP Single
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="header" id="optionsRadios2" value="atpdouble" <?php  if($grand['header'] == 'atpdouble'){ echo "checked";  } ?>>ATP Double
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="header" id="optionsRadios3" value="wtasingle" <?php if($grand['header'] == 'wtasingle'){ echo "checked";  } ?>>WTA Single
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="header" id="optionsRadios4" value="wtadouble" <?php  if($grand['header'] == 'wtadouble'){ echo "checked";  } ?>>WTA Double
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