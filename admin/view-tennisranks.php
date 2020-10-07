<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');


include('includes/header.php');
 include('includes/navigation.php'); ?>

        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Welcome to View Tennis Ranks Section</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:black;color:white">
                            Tennis Ranks
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Position</th>
                                            <th>Country</th>
                                            <th>Player </th>
                                            <th>Points</th>
                                            <th>Header</th> 
                                            
                                            <th>Opeartions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                             $sql = "SELECT * FROM tennisrank";
                                             $result = $db->prepare($sql);
                                             $result->execute();
                                             $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                             foreach ($res as $rank) {
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $rank['id']; ?></td>
                                            <td><?php echo $rank['pos']; ?></td>
                                            <td><?php echo $rank['country']; ?></td>
                                            <td><?php echo $rank['name']; ?></td>
                                            <td><?php echo $rank['points']; ?></td>
                                            <td><?php echo $rank['header']; ?></td>
                                            
                                            
                                            <td>
                                                <a href="edit-tennisrank.php?id=<?php echo $rank['id']; ?>">Edit</a> |
                                                <a href="delete-item.php?id=<?php echo $rank['id']; ?>&item=rank">Delete</a> 


                                        </td>
                                        </tr>
                                             <?php }?>