<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php'); 



$sql = "SELECT * FROM points WHERE league='premierleague' ORDER BY points DESC";
$result = $db->prepare($sql);
$result->execute();
$points = $result->fetchAll(PDO::FETCH_ASSOC);
    

?>


<div id="page-wrapper" style="min-height: 345px;">
            <div class="row">

      
                <div class="col-lg-12">
                    <h1 class="page-header" style="background:#3f0947;font-family:Anton;color:white;text-align:center;margin:2px"> Premier League </h1>
                
                </div>
                
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                

                    <div class="panel panel-default">
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                 
                                <table class="table table-hover" >
                                    <thead style="background:black;color:white;font-weight:700;font-family:Anton;font-size:2rem">
                                        <tr>
                                            <th style="font-size:1.5rem">Position</th>
                                            <th style="font-size:1.5rem">Club</th>
                                            <th style="font-size:1.5rem">Played</th>
                                            <th style="font-size:1.5rem">Won</th>
                                            <th style="font-size:1.5rem">Draw</th> 
                                            <th style="font-size:1.5rem">Lost</th>   
                                            <th style="font-size:1.5rem">GF</th>
                                            <th style="font-size:1.5rem">GA</th>
                                            <th style="font-size:1.5rem">GD</th>
                                            <th style="font-size:1.5rem">Points</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                 
                                    
                                    <?php
                                        foreach ($points as $pointstb) {
                                            ?>
                                     
                                        <tr >
                                            <td style="font-weight:bold;font-size:1rem"><?php echo $pointstb['pos']; ?></td>
                                            <td style="font-weight:bold;font-size:1rem"><?php echo $pointstb['club']; ?></td>
                                            <td style="font-weight:bold;font-size:1rem"><?php echo $pointstb['mp']; ?></td>
                                            <td style="font-weight:bold;font-size:1rem"><?php echo $pointstb['win']; ?></td>
                                            <td style="font-weight:bold;font-size:1rem"><?php echo $pointstb['draw']; ?></td>
                                            <td style="font-weight:bold;font-size:1rem"><?php echo $pointstb['lost']; ?></td>
                                            <td style="font-weight:bold;font-size:1rem"><?php echo $pointstb['gf']; ?></td>
                                            <td style="font-weight:bold;font-size:1rem"><?php echo $pointstb['ga']; ?></td>
                                            <td style="font-weight:bold;font-size:1rem"><?php echo $pointstb['gd']; ?></td>
                                            <td style="font-weight:bold;font-size:1rem"><?php echo $pointstb['points']; ?></td>
                                            
                                            
                                         
                                        </tr>
                                        
                                     <?php } ?>
                        
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <?php include('includes/footer.php'); ?>