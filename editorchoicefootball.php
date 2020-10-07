<link href="css/Style.css" rel="stylesheet">
<link href="css/all.css" rel="stylesheet">








<?php 
session_start();
require_once('includes/connect.php');
include('admin/includes/if-loggedin.php');
include('includes/header.php');
include('includes/navigation.php'); 

?>

<?php 
$sql = "SELECT * FROM posts WHERE status='published' and header='editorchoice' and news='esports'  ORDER BY created  DESC  ";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);


?>



<h1 class="page-title" style="text-align:center;background:#19181c;color:yellow;font-family:Anton;font-size:5rem" >EDITOR's CHOICE</h1>






<div class="container my-9" style="background:white"> 
<div class="row row-cols-1 row-cols-md-3" style="white">

      <?php
        
          
            foreach ($posts as $post) 
             { ?>
     
    <div class="col mb-4" >
  
    <div class="card  " style="background:white;border-radius:15px">
    

      
      <div class="view overlay" style="border-radius:15px 15px 0 0" >

          
            <?php if(isset($post['pic']) & !empty($post['pic'])){  ?>

              <img class="card-img-top"  src="<?php echo $post['pic']; ?>" alt="">
            
            
        <a href="single.php?id=<?php  echo $post['slug'];    ?>">
          <div class="mask rgba-white-slight"></div>
        </a>
            <?php }else{  ?>

              <img class="card-img-top" src="http://placehold.it/750x300" alt="">

            <?php } ?>
        </div>
            
      <div class="card-body" >

        
            <a href="single.php?id=<?php  echo $post['slug'];    ?>"><h4 class="card-title" style="color:black;font-family:Anton;text-align:center;font-size:2rem;"><?php echo $post['title']; ?></h4></a>
            
          
         
              
            <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>   
               
                <i class="fas fa-pen-alt" style="color:grey"></i>
                
        
        <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:grey;text-align:right">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        
        | 
          <small style="color:grey;justify-content:center;font-size:0.8rem"> 
          <?php  
          $created = date_create($post['created']);
        
        echo $created = date_format($created," d M Y"); ?></small>
        </p>

      </div>



    
  </div>
</div>



  



          <?php  } 
          
          
          ?>


          </div>



        
          </div>

          
      
          

          

        </div>

       

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <?php include('includes/footer.php'); ?>