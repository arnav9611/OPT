<?php 
require_once('includes/connect.php');
include('includes/check-login.php');

include('includes/header.php'); 
include('includes/navigation.php');  



    $sql = "SELECT * FROM fanposts WHERE uid=?";
    $result = $db->prepare($sql);
    $result->execute(array($_SESSION['id']));
    $totalres = $result->rowCount();


?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding:20px;font-size:1.4rem;font-weight:bold">
                            Talk of the Town Posts
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="font-weight:bold">Post No</th>
                                            <th style="font-weight:bold">Post Title</th>
                                            
                                            <th style="font-weight:bold">Category</th>   
                                            
                                            <th style="font-weight:bold">Time of Post</th>
                                            
                                            <th style="font-weight:bold">Do you want to?</th>
                                        </tr>
                                    </thead>
                                    <tbody>

  <!----------------------ADMIN CAN SEE ALL AND EDITOR CAN SEE ONLY HIS POST---------------------------------->
                                <?php 
                                    $sql = "SELECT * FROM users WHERE id=?";
                                    $result = $db->prepare($sql);
                                    $result->execute(array($_SESSION['id']));
                                    $user = $result->fetch(PDO::FETCH_ASSOC); 
                                    
                                    
                                        $sql = "SELECT * FROM fanposts WHERE uid=?";
                                        $result = $db->prepare($sql);
                                        $result->execute(array($_SESSION['id'])); 
                                        $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                   
                                   
                                   
                                        foreach ($res as $fpost) {
                                    // TODO : Only user with administrator privillages or user who created the article can only edit or delete post

                                    
                                ?>
                                <tr>
                                    <td><?php echo $fpost['id']; ?></td>
                                    <td><?php echo ucfirst($fpost['title']); ?></td>
                                    
                                    
                                    <td><?php echo ucfirst($fpost['news']); ?></td>
                                    
                                    <td>
                                    <?php 
        
                                         $created = date_create($fpost['created']);
        
                                        echo $created = date_format($created,"d M, Y ");
         
                                    ?>
                                    </td>
                                    
                                    <td><a style="color:green;font-weight:bold" href="editpost.php?id=<?php echo $fpost['id']; ?>">Edit</a> | <a style="color:red;font-weight:bold" href="delete-item.php?id=<?php echo $fpost['id']; ?>&item=fanpost">Delete</a></td>
                                </tr>
                                <?php } ?>
                                        
                                   
                                    </tbody>
                                </table>
                            </div>
                           
                           
                           
                            <!-- /.table-responsive -->
                        
                        
                        
                      
                </div>
                <!-- /.panel-body -->
            </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>

</div>

<?php include('includes/footer.php'); ?>