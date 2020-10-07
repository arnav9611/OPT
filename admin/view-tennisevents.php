<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');


include('includes/header.php');
 include('includes/navigation.php'); ?>

        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Welcome to View Tennis Event Section</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:black;color:white">
                            Tennis Events
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tournament</th>
                                            <th>Place</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Defending Champion</th> 
                                            <th>Surface</th>   
                                            <th>Prize Money</th>
                                            <th>Pic</th>
                                            <th>Month</th>
                                            
                                            <th>Opeartions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                             $sql = "SELECT * FROM tennisevent";
                                             $result = $db->prepare($sql);
                                             $result->execute();
                                             $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                             foreach ($res as $tevent) {
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $tevent['id']; ?></td>
                                            <td><?php echo $tevent['tournament']; ?></td>
                                            <td><?php echo $tevent['place']; ?></td>
                                            <td><?php echo $tevent['start']; ?></td>
                                            <td><?php echo $tevent['end']; ?></td>
                                            <td><?php echo $tevent['champion']; ?></td>
                                            <td><?php echo $tevent['surface']; ?></td>
                                            <td><?php echo $tevent['money']; ?></td>
                                            <td><?php if(isset($tevent['pic']) & !empty($tevent['pic'])){ echo "Yes"; }else{ echo "No"; } ?></td>
                                            <td><?php echo $tevent['month']; ?></td>
                                            
                                            <td>
                                                <a href="edit-tennisevent.php?id=<?php echo $tevent['id']; ?>">Edit</a> |
                                                <a href="delete-item.php?id=<?php echo $tevent['id']; ?>&item=tennisevent">Delete</a> 


                                        </td>
                                        </tr>
                                             <?php }?>