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
                    <h1 class="page-header"> Premier League Table Season 2020-21</h1>
                
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                

                    <div class="panel panel-default">
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                 
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Position</th>
                                            <th>Club</th>
                                            <th>Played</th>
                                            <th>Won</th>
                                            <th>Draw</th> 
                                            <th>Lost</th>   
                                            <th>GF</th>
                                            <th>GA</th>
                                            <th>GD</th>
                                            <th>Points</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                 
                                    
                                    <?php
                                        foreach ($points as $pointstb) {
                                            ?>
                                     
                                        <tr>
                                            <td><?php echo $pointstb['pos']; ?></td>
                                            <td><?php echo $pointstb['club']; ?></td>
                                            <td><?php echo $pointstb['mp']; ?></td>
                                            <td><?php echo $pointstb['win']; ?></td>
                                            <td><?php echo $pointstb['draw']; ?></td>
                                            <td><?php echo $pointstb['lost']; ?></td>
                                            <td><?php echo $pointstb['gf']; ?></td>
                                            <td><?php echo $pointstb['ga']; ?></td>
                                            <td><?php echo $pointstb['gd']; ?></td>
                                            <td><?php echo $pointstb['points']; ?></td>
                                            
                                            
                                         
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