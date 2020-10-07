<?php 

require_once('connect.php');

include('admin/includes/if-loggedin.php');
include('header.php');
?>






<div class="col-md-4">



<?php






$postsql = "SELECT * FROM posts WHERE status='published' and  header='recent'   ORDER BY created  DESC ";
  $postresult = $db->prepare($postsql);
  $postresult->execute();
  $postres = $postresult->fetchAll(PDO::FETCH_ASSOC);


 ?>

  <div class="card my-4">
  <h5  style="background:white;color:black;font-family:Anton;font-size:2.2rem;text-align:center;padding:10px;text-decoration:underline">Recent Articles</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          <ul class="list-unstyled mb-0">
            <?php 
            
            
            
            
            foreach ($postres as $post) { ?>


            <li>
            
              <a style="color:black;padding-top:10px; font-weight: 700;justify-content:center;font-size:1.3rem;line-height: 1.375rem;" href="single?id=<?php echo $post['slug']; ?>"><?php echo ucfirst($post['title']); ?></a>
              <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>  
               <p class="card-text" style="color:grey">
               
        
        <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:grey">by  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        
        
        
          |
          <small style="color:grey;justify-content:center"> 
           &nbsp;<?php  
          $created = date_create($post['created']);
        
        echo $created = date_format($created," d M Y"); ?></small>
        </p>
        <div class ="col md-2">
      
      <div class="row ">
      <?php 
      $catsql = "SELECT categories.title FROM categories INNER JOIN post_categories ON post_categories.cid=categories.id WHERE post_categories.pid=?";
      $catresult = $db->prepare($catsql);
      $catresult->execute(array($post['id']));
      $catres = $catresult->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <?php foreach ($catres as $cat) { ?>
        <h4 style="color:black;font-size:0.7rem;background:#15e8c1;padding:5px;border-radius:5px"> <i class='fas fa-futbol'></i><a style="color:black;font-weight:bold;font-size:0.7rem;background:#15e8c1;padding:5px" href="category.php?id=<?php echo ucfirst($cat['title']); ?>"><?php echo $cat['title'];?></a></h4> &nbsp; &nbsp;
         
         
         
      <?php } ?>
      
   
        
        </div>
        
        </div>
              
              
              
              <hr >
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <?php


  $postsql = "SELECT * FROM posts WHERE status='published' and  header='editorchoice'   ORDER BY created  DESC ";
  $postresult = $db->prepare($postsql);
  $postresult->execute();
  $postres = $postresult->fetchAll(PDO::FETCH_ASSOC);
?>

  <div class="card my-4" >
  <h5  style="background:white;color:black;font-family:Anton;font-size:3rem;text-align:center;padding:10px">Editor's Choice</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          <ul class="list-unstyled mb-0">
            <?php foreach ($postres as $post) { ?>


            <li>
            <?php if(isset($post['pic']) & !empty($post['pic'])){?>


          <a href="single?id=<?php  echo $post['slug'];    ?>"><img style="border-radius:10px"class="img-fluid" src="<?php echo $post['pic']; ?>"
              alt=""></a>



      


        <?php }else{  ?>

        <img  class="img-fluid" src="http://placehold.it/750x300" alt="">

          <?php } ?>


          <div class="card-body-main" style="padding:10px">
              <a style="color:black; font-weight: 700;justify-content:center;font-size:1.2rem;line-height: 1.375rem;" href="single?id=<?php echo $post['slug']; ?>"><?php echo ucfirst($post['title']); ?></a>
              <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>  
               <p class="card-text" style="color:grey">
                
        
        <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:grey">by  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        
        
        
          |
          <small style="color:grey;justify-content:center"> 
           &nbsp;<?php  
          $created = date_create($post['created']);
        
        echo $created = date_format($created," d M Y"); ?></small>
        </p>
              
        <div class ="col md-2">
      
      <div class="row ">
      <?php 
      $catsql = "SELECT categories.title FROM categories INNER JOIN post_categories ON post_categories.cid=categories.id WHERE post_categories.pid=?";
      $catresult = $db->prepare($catsql);
      $catresult->execute(array($post['id']));
      $catres = $catresult->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <?php foreach ($catres as $cat) { ?>
        <h4 style="color:black;font-size:0.8rem;background:#15e8c1;padding:5px;border-radius:5px"> <i class='fas fa-futbol'></i><a style="color:black;font-weight:bold;font-size:0.8rem;background:#15e8c1;padding:5px" href="category.php?id=<?php echo ucfirst($cat['title']); ?>"><?php echo $cat['title'];?></a></h4> &nbsp; &nbsp;
         
         
         
      <?php } ?>
      
   
        
        </div>
        
        </div>
              
              
              <hr >
              
              </div>
            </li>
            <?php } ?>
          </ul>
          <a href="index" style="color:#b30b1e;font-weight:bold"> View All Editor Choice News <i class="fa fa-chevron-circle-right"></i> </a>
        </div>
      </div>
    </div>
  </div>
            



            

</div>