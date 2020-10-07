<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');


include('includes/header.php');
 include('includes/navigation.php'); ?>

        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Welcome to View Points Table Section</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:black;color:white">
                            Points Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Position</th>
                                            <th>Club</th>
                                            <th>MP</th>
                                            <th>W</th>
                                            <th>D</th> 
                                            <th>L</th>   
                                            <th>GF</th>
                                            <th>GA</th>
                                            <th>GD</th>
                                            <th>Points</th>
                                            <th>League</th>
                                            <th>Opeartions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                             $sql = "SELECT * FROM points";
                                             $result = $db->prepare($sql);
                                             $result->execute();
                                             $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                             foreach ($res as $point) {
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $point['id']; ?></td>
                                            <td><?php echo $point['pos']; ?></td>
                                            <td><?php echo $point['club']; ?></td>
                                            <td><?php echo $point['mp']; ?></td>
                                            <td><?php echo $point['win']; ?></td>
                                            <td><?php echo $point['draw']; ?></td>
                                            <td><?php echo $point['lost']; ?></td>
                                            <td><?php echo $point['gf']; ?></td>
                                            <td><?php echo $point['ga']; ?></td>
                                            <td><?php echo $point['gd']; ?></td>
                                            <td><?php echo $point['points']; ?></td>
                                            <td><?php echo $point['league']; ?></td>
                                            
                                            <td>
                                                <a href="edit-point.php?id=<?php echo $point['id']; ?>">Edit</a> |
                                                <a href="delete-item.php?id=<?php echo $point['id']; ?>&item=point">Delete</a> 


                                        </td>
                                        </tr>
                                             <?php }?>