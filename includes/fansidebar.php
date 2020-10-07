<?php 

require_once('connect.php');

include('admin/includes/if-loggedin.php');
include('header.php');
?>






<div class="col-md-4">

<h5  style="background:white;color:black;font-family:Anton;font-size:3rem;text-align:center;padding:10px">OFFPITCH tALKS NEWS </h5>

<?php


  $postsql = "SELECT * FROM posts WHERE status='published'  and news='football'  ORDER BY created  DESC ";
  $postresult = $db->prepare($postsql);
  $postresult->execute();
  $postres = $postresult->fetchAll(PDO::FETCH_ASSOC);
?>

  <div class="card my-4">
  <h5  style="background:white;color:#b30b1e;font-family:Anton;font-size:3rem;text-align:center;padding:10px;text-decoration:underline">FOOTBALL</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          <ul class="list-unstyled mb-0">
            <?php foreach ($postres as $post) { ?>


            <li>
           
              <a style="color:black;padding-top:10px; font-weight: 700;justify-content:center;font-size:1.2rem;line-height: 1.375rem;" href="single?id=<?php echo $post['slug']; ?>"><?php echo $post['title']; ?></a>
              <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>  
               <p class="card-text" style="color:grey">
                by
        
        <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:grey">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        
        
        
          |
          <small style="color:grey;justify-content:center"> 
           &nbsp;<?php  
          $created = date_create($post['created']);
        
        echo $created = date_format($created," d M Y"); ?></small>
        </p>
              
              
              
              
              <hr >
            </li>
            <?php } ?>
          </ul>
          <a href="index" style="color:#b30b1e;font-weight:bold"> View All Football News <i class="fa fa-chevron-circle-right"></i> </a>
        </div>
      </div>
    </div>
  </div>

  <?php


  $postsql = "SELECT * FROM posts WHERE status='published' and   news='esports'  ORDER BY created  DESC ";
  $postresult = $db->prepare($postsql);
  $postresult->execute();
  $postres = $postresult->fetchAll(PDO::FETCH_ASSOC);
?>

  <div class="card my-4">
  <h5  style="background:white;color:#b30b1e;font-family:Anton;font-size:3rem;text-align:center;padding:10px;text-decoration:underline">ESPORTS</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          <ul class="list-unstyled mb-0">
            <?php foreach ($postres as $post) { ?>


            <li>
            
              <a style="color:black;padding-top:10px; font-weight: 700;justify-content:center;font-size:1.2rem;line-height: 1.375rem;" href="single?id=<?php echo $post['slug']; ?>"><?php echo $post['title']; ?></a>
              <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>  
               <p class="card-text" style="color:grey">
                by
        
        <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:grey">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        
        
        
          |
          <small style="color:grey;justify-content:center"> 
           &nbsp;<?php  
          $created = date_create($post['created']);
        
        echo $created = date_format($created," d M Y"); ?></small>
        </p>
              
              
              
              
              <hr >
            </li>
            <?php } ?>
          </ul>
          <a href="esports" style="color:#b30b1e;font-weight:bold"> View All Esports News <i class="fa fa-chevron-circle-right"></i> </a>
        </div>
      </div>
    </div>
  </div>
            


  <?php


$postsql = "SELECT * FROM posts WHERE status='published' and   news='tennis'  ORDER BY created  DESC ";
$postresult = $db->prepare($postsql);
$postresult->execute();
$postres = $postresult->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card my-4">
<h5  style="background:white;color:#b30b1e;font-family:Anton;font-size:3rem;text-align:center;padding:10px;text-decoration:underline">TENNIS</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled mb-0">
          <?php foreach ($postres as $post) { ?>


          <li>
          
            <a style="color:black;padding-top:10px; font-weight: 700;justify-content:center;font-size:1.2rem;line-height: 1.375rem;" href="single?id=<?php echo $post['slug']; ?>"><?php echo $post['title']; ?></a>
            <?php 
              
              $usersql = "SELECT * FROM users WHERE id=?";
              $userresult = $db->prepare($usersql);
              $userresult->execute(array($post['uid']));
              $user = $userresult->fetch(PDO::FETCH_ASSOC);
              
              ?>  
             <p class="card-text" style="color:grey">
              by
      
      <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:grey">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
      
      
      
        |
        <small style="color:grey;justify-content:center"> 
         &nbsp;<?php  
        $created = date_create($post['created']);
      
      echo $created = date_format($created," d M Y"); ?></small>
      </p>
            
            
            
            
            <hr >
          </li>
          <?php } ?>
        </ul>
        <a href="tennis" style="color:#b30b1e;font-weight:bold"> View All Tennis News <i class="fa fa-chevron-circle-right"></i> </a>
      </div>
    </div>
  </div>
</div>




<?php


$postsql = "SELECT * FROM posts WHERE status='published' and   news='transfer'  ORDER BY created  DESC ";
$postresult = $db->prepare($postsql);
$postresult->execute();
$postres = $postresult->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card my-4">
<h5  style="background:white;color:#b30b1e;font-family:Anton;font-size:3rem;text-align:center;padding:10px;text-decoration:underline">TRANSFER NEWS</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled mb-0">
          <?php foreach ($postres as $post) { ?>


          <li>
          
            <a style="color:black;padding-top:10px; font-weight: 700;justify-content:center;font-size:1.2rem;line-height: 1.375rem;" href="single?id=<?php echo $post['slug']; ?>"><?php echo $post['title']; ?></a>
            <?php 
              
              $usersql = "SELECT * FROM users WHERE id=?";
              $userresult = $db->prepare($usersql);
              $userresult->execute(array($post['uid']));
              $user = $userresult->fetch(PDO::FETCH_ASSOC);
              
              ?>  
             <p class="card-text" style="color:grey">
              by
      
      <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:grey">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
      
      
      
        |
        <small style="color:grey;justify-content:center"> 
         &nbsp;<?php  
        $created = date_create($post['created']);
      
      echo $created = date_format($created," d M Y"); ?></small>
      </p>
            
            
            
            
            <hr >
          </li>
          <?php } ?>
        </ul>
        <a href="transfer" style="color:#b30b1e;font-weight:bold"> View All Football Transfer News <i class="fa fa-chevron-circle-right"></i> </a>
      </div>
    </div>
  </div>
</div>











</div>