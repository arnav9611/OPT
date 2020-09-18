<?php 
session_start();
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

         

            $sql = "INSERT INTO points ( id,pos,club, mp, win, draw, lost, gf,ga,gd,points,league) 
                    VALUES ( :id,:post,:club, :mp, :win, :draw, :lost, :gf,:ga,:gd,:points,:league)";
            $result = $db->prepare($sql);
            $values = array(':id'      => $_POST['id'],
                             ':pos'    => $_POST['pos'],
                            ':club'    => $_POST['club'],
                            ':mp'      => $_POST['mp'],
                            ':win'     => $_POST['win'],
                            ':draw'    => $_POST['draw'],
                            ':lost'    => $_POST['lost'],
                            ':gf'      => $_POST['gf'],
                            ':ga'      => $_POST['ga'],
                            ':gd'      => $_POST['gd'],
                            ':points'  => $_POST['points'],
                            ':league'  => $_POST['league']
                            
                            
                            );
                            
                            
                            $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
                            
                            
                            if($res)
                            {
                                // After inserting the article, insert category id and article id into post_categories table
                                
                                header("location: view-points.php");
                            }else
                            {
                                $errors[] = "Failed to Add Points";
                            }
                        }



                    
//Create csrf token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();



include('includes/header.php'); 
include('includes/navigation.php'); 


?>


        
      <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Point</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Points
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
                            <label>Position</label>
                            <input type="number" class="form-control" name="pos" placeholder="Position" value="<?php if(isset($_POST['pos'])){echo $_POST['pos'];} ?>">
                        </div>
                                 
                        
                        <div class="form-group">
                                            <label>Enter Team Name</label>
                                            <input class="form-control" name="club" placeholder="Enter Team Name " value="<?php if(isset($_POST['club'])){echo $_POST['club'];} ?>">
                                        </div>
                                        
                         
                                        <div class="form-group">
                            <label>Matches Played</label>
                            <input type="number" class="form-control" name="mp" placeholder="Matches Played" value="<?php if(isset($_POST['mp'])){echo $_POST['mp'];} ?>">
                        </div>

                        <div class="form-group">
                            <label>Wins</label>
                            <input type="number" class="form-control" name="win" placeholder="Matches Won" value="<?php if(isset($_POST['win'])){echo $_POST['win'];} ?>">
                        </div>

                        <div class="form-group">
                            <label>Draw</label>
                            <input type="number" class="form-control" name="draw" placeholder="Matches Drawn" value="<?php if(isset($_POST['draw'])){echo $_POST['draw'];} ?>">
                        </div>

                        <div class="form-group">
                            <label>Lost</label>
                            <input type="number" class="form-control" name="lost" placeholder="Matches Lost" value="<?php if(isset($_POST['lost'])){echo $_POST['lost'];} ?>">
                        </div>
                        <div class="form-group">
                            <label>Total Goal Scored</label>
                            <input type="number" class="form-control" name="gf" placeholder="Goal Scored" value="<?php if(isset($_POST['gf'])){echo $_POST['gf'];} ?>">
                        </div>

                        <div class="form-group">
                            <label>Total Goals Conceeded</label>
                            <input type="number" class="form-control" name="ga" placeholder="Goals Conceeded" value="<?php if(isset($_POST['ga'])){echo $_POST['ga'];} ?>">
                        </div>

                        <div class="form-group">
                            <label>Goals Difference</label>
                            <input type="number" class="form-control" name="gd" placeholder="Goals Difference" value="<?php if(isset($_POST['gd'])){echo $_POST['gd'];} ?>">
                        </div>
                        <div class="form-group">
                            <label>Points</label>
                            <input type="number" class="form-control" name="points" placeholder="Points" value="<?php if(isset($_POST['points'])){echo $_POST['points'];} ?>">
                        </div>



                                       
                                       
                                       
                                       
                                        <div class="row">
                                            
                                            
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>League</label>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="league" id="optionsRadios1" value="premierleague" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['league'] == 'premierleague'){ echo "checked"; } } ?>>Premier League
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="league" id="optionsRadios2" value="laliga" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['league'] == 'laliga'){ echo "checked"; } } ?>>La Liga
                                                        </label>
                                                    </div>
                                                    
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="league" id="optionsRadios3" value="frenchleague" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['league'] == 'frenchleague'){ echo "checked"; } } ?>>French Ligue
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