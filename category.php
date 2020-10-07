<link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@661&display=swap" rel="stylesheet">

<?php
session_start(); 
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php');






// get the number of total posts from posts table
$sql = "SELECT * FROM post_categories INNER JOIN posts ON post_categories.pid=posts.id INNER JOIN categories ON post_categories.cid=categories.id WHERE categories.slug=? AND posts.status='published'";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$totalres = $result->rowCount();






// fetch the results
$sql = "SELECT posts.title, posts.pic, posts.content, posts.slug, posts.id, posts.created, posts.uid FROM post_categories INNER JOIN posts ON post_categories.pid=posts.id INNER JOIN categories ON post_categories.cid=categories.id WHERE categories.slug=? AND posts.status='published' ORDER BY posts.created DESC";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$postcount = $result->rowCount();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);
 ?>


 <?php
$catsql = "SELECT * FROM categories WHERE slug=?";
$catresult = $db->prepare($catsql);
$catresult->execute(array($_GET['id']));
$catres = $catresult->fetch(PDO::FETCH_ASSOC);
?>


<h1 class="page-title" style="text-align:center;background:orange;color:black;font-family:Anton;font-size:5rem" > <?php echo $catres['title']; ?></h1>






<div class="container my-9" style="background:white"> 
<div class="row row-cols-1 row-cols-md-3" style="white">

      <?php
        if($postcount >= 1)
        {
          
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



  



          <?php  } }else 
          {
            echo "<h2> No Articles for this category</h2>";
          } 
          
          
          ?>


          </div>



        
          </div>

          
      
          

          

        </div>

       

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <?php include('includes/footer.php'); ?>