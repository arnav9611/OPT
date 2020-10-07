<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');


include('includes/header.php');
 include('includes/navigation.php'); ?>

        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Welcome to View GrandSlams Section</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background:black;color:white">
                            GrandSlams
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Year</th>
                                            <th>Winner</th>
                                            <th>Runner Up</th>
                                            <th>Prize Money</th> 
                                            <th>Score</th>   
                                            <th>Header</th>
                                            
                                            <th>Opeartions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                             $sql = "SELECT * FROM grandslam";
                                             $result = $db->prepare($sql);
                                             $result->execute();
                                             $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                             foreach ($res as $grand) {
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $grand['id']; ?></td>
                                            <td><?php echo $grand['name']; ?></td>
                                            <td><?php echo $grand['year']; ?></td>
                                            <td><?php echo $grand['winner']; ?></td>
                                            <td><?php echo $grand['runnerup']; ?></td>
                                            <td><?php echo $grand['money']; ?></td>
                                            <td><?php echo $grand['score']; ?></td>
                                            <td><?php echo $grand['header']; ?></td>
                                            
                                            
                                            <td>
                                                <a href="edit-grandslam.php?id=<?php echo $grand['id']; ?>">Edit</a> |
                                                <a href="delete-item.php?id=<?php echo $grand['id']; ?>&item=grand">Delete</a> 


                                        </td>
                                        </tr>
                                             <?php }?>