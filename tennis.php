<link href="css/Style.css" rel="stylesheet">
<link href="css/all.css" rel="stylesheet">








<?php 
session_start();
require_once('includes/connect.php');
include('admin/includes/if-loggedin.php');
include('includes/header.php');
include('includes/navigation.php'); 



   
 function time_ago_in_php($timestamp){
  
  date_default_timezone_set("Asia/Kolkata");         
  $time_ago        = strtotime($timestamp);
  $current_time    = time();
  $time_difference = $current_time - $time_ago;
  $seconds         = $time_difference;
  
  $minutes = round($seconds / 60); // value 60 is seconds  
  $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
  $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
  $weeks   = round($seconds / 604800); // 7*24*60*60;  
  $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
  $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
                
  if ($seconds <= 60){

    return "Just Now";

  } else if ($minutes <= 60){

    if ($minutes == 1){

      return "One minute ";

    } else {

      return "$minutes mins ";

    }

  } else if ($hours <= 24){

    if ($hours == 1){

      return "An hour ago";

    } else {

      return "$hours hrs ";

    }

  } else if ($days <= 7){

    if ($days == 1){

      return "Yesterday";

    } else {

      return "$days days ";

    }

  } else if ($weeks <= 4.3){

    if ($weeks == 1){

      return "A week ago";

    } else {

      return "$weeks weeks ";

    }

  } else if ($months <= 12){

    if ($months == 1){

      return "A month ago";

    } else {

      return "$months months ";

    }

  } else {
    
    if ($years == 1){

      return "One Year ago";

    } else {

      return "$years yrs ";

    }
  }
}
?>

<!-------------------------- TOP POST PART ---------------------------------------------------------------------------->
  

<?php 

$sql = "SELECT * FROM posts WHERE status='published' and header='toppost' and news='tennis' ORDER BY created DESC";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);

?>


<h1 class="page-title" style="text-align:left;background:white;color:black;font-family:Anton;font-size:5rem;text-align:center">TENNIS</h1>
<nav class="navbar  navbar-expand-lg navbar-dark scrolling-navbar " style="font-family:Anton;background:white;color:black">
  
  <div class="container">
  
  
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  
  
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" >
      <li class="nav-item" >
        <a class="nav-link" href="tennis" style="color:black">Home</a>
      </li>



      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="true" style="color:black">Ranking
        </a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="tennisrank-mensingle">Men's Single</a>
          <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="#">Women's Single</a>
          <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="#">Men's Double</a>
          <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="#">Women's Double</a>
          
        </div>
      </li>
  
      <li class="nav-item">
        <a class="nav-link" href="tennis-events" style="color:black">Scheduled Events</a>
      </li>

  
      
      
      
     


     

      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="true" style="color:black">Grand Slam History
        </a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="grandslam-mensingle">Men's Single</a>
          <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="grandslam-womensingle">Women's Single</a>
          
        </div>
      </li>

      
    </ul>

    
    
  </div>

  
  </div>
  </nav>




  
<div class="container my-9" style="background:black"> 





<div class="card mb-3 w-100"  >
  <div class="row g-0">


    <?php foreach ($posts as $post) { ?>
  <div class="col-md-8 h-100 w-100" >
    <?php if(isset($post['pic']) & !empty($post['pic'])){?>

      <a href="single.php?id=<?php  echo $post['slug'];    ?>">
    <img class="img-fluid" src="<?php echo $post['pic']; ?>"
    alt=""></a>


    

    <?php }else{  ?>

    <img  class="img-fluid" src="http://placehold.it/750x300" alt="">

    <?php } ?>

  </div>
   
   
   
    <div class="col-md-4" style="background:black">
      <div class="card-body">
        
      <a href="single.php?id=<?php  echo $post['slug'];    ?>"><h5 class="card-title" style="font-family:Anton;font-size:2.5rem;text-transform:uppercase;color:white"><?php echo $post['title']; ?></h5></a>
        
      <p class="card-text">
        <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>   
                <i class="fas fa-pen-alt" style="color:yellow"></i>
        
        <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:yellow">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        <i style="color:yellow" class="fa fa-chevron-circle-right"></i>
         
        
        <span style="color:yellow"> <?php  echo  time_ago_in_php($post['created']); ?> </span>
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
        <h4 style="color:black;font-size:0.8rem;background:#15e8c1;padding:5px;border-radius:5px"> <i class='fas fa-futbol'></i><a style="color:black;font-weight:bold;font-size:0.8rem;background:#15e8c1;padding:5px" href="<?php echo ucfirst($cat['title']); ?>"><?php echo $cat['title'];?></a></h4> &nbsp; &nbsp;
         
         
         
      <?php } ?>
     </div>
     </div>





      </div>

      
    </div>




    <?php }  ?>


  </div>
  
</div>

</div>


<!-------------EDITORS CHOICE--------------------------->

<?php 
$sql = "SELECT * FROM posts WHERE status='published' and header='editorchoice' and news='tennis'  ORDER BY created  DESC LIMIT 4 ";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="container my-9"> 
<h1 class="page-title" style="text-align:center;background:#19181c;color:yellow;font-family:Anton;font-size:5rem" >EDITOR's CHOICE</h1>


<div class="row row-cols-1 row-cols-md-3" style="background:white">


  

<?php foreach ($posts as $post) { ?>
<!--------php---------------------------------------------------------------------------------------------------->
  
<div class="col mb-4">
    <!-- Card --if same heigh needed put h-100 after card------>
    <div class="card h-100 " style="background:#19181c">
    

      
      <div class="view overlay">


      <?php if(isset($post['pic']) & !empty($post['pic'])){?>


        <img class="card-img-top" src="<?php echo $post['pic']; ?>"
          alt="">

        <a href="single.php?id=<?php  echo $post['slug'];    ?>">
          <div class="mask rgba-white-slight"></div>
        </a>

        <?php }else{  ?>

        <img  class="card-img-top" src="http://placehold.it/750x300" alt="">

        <?php } ?>

      </div>

    
      <div class="card-body">
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
        <a href="single.php?id=<?php  echo $post['slug'];    ?>"><h4 class="card-title" style="color:white;font-family:Anton;text-align:center;font-size:2rem"><?php echo $post['title']; ?></h4></a>
        <!--Text-->
        
                <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>   
                <i class="fas fa-pen-alt" style="color:yellow"></i>
        
        <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:yellow">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        
        
       
        
          <small style="justify-content:center"> &nbsp; <i style="color:yellow" class="fa fa-chevron-circle-right"></i>
          <?php  
           
        
        ?>
        
        <span style="color:yellow;font-size:0.8rem"> <?php  echo  time_ago_in_php($post['created']); ?> </span>
    

      </div>




    </div>
    <!-- Card -->
  </div>



  
  <?php }  ?>

</div>


</div>


<!-----------------------------------------------TRENDING POSTS----------------------------->
<?php 
$sql = "SELECT * FROM posts WHERE status='published' and header='recent' and news='tennis'  ORDER BY created  DESC LIMIT 4 ";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="container">

<div class="row">

  <!-- Post Content Column -->
  <div class="col-lg-8">

<h1 class="page-title" style="text-align:center;background:lightblue;color:black;font-family:Anton;font-size:5rem" >TRENDING POSTS</h1>

<!-- News jumbotron -->
<div class="jumbotron text-center hoverable p-4" >

  <!-- Grid row -->
  <div class="row">


  <?php foreach ($posts as $post) { ?>

    <!-- Grid column -->
    <div class="col-md-4 offset-md-1 mx-3 my-3">

      <!-- Featured image -->
      <div class="view overlay h-100 w-100" style="">
      
      
      <?php if(isset($post['pic']) & !empty($post['pic'])){?>


        <a href="single.php?id=<?php  echo $post['slug'];    ?>"><img class="img-fluid" src="<?php echo $post['pic']; ?>"
          alt=""></a>


        
              
        

<?php }else{  ?>

<img  class="img-fluid" src="http://placehold.it/750x300" alt="">

<?php } ?>

        
      </div>

    </div>
    
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-7 text-md-left ml-3 mt-3"  >


<!----------START OF LIKE -DISLIKE SYSTEM-------------------------->
    
       
   
<!--------------------END OF LIKE-DISLIKE SYSTEM--------------------------------------------------->







      <a href="single.php?id=<?php  echo $post['slug'];    ?>"><h4 class="h4 mb-4" style="font-family:Anton;color:black;text-transform:uppercase;font-size:2rem"><?php echo $post['title']; ?></h4></a>
      
      <!----CATEGORY BLOCK STARTS----->
      
      
      <div class ="col md-2">
      
      <div class="row ">
      <?php 
      $catsql = "SELECT categories.title FROM categories INNER JOIN post_categories ON post_categories.cid=categories.id WHERE post_categories.pid=?";
      $catresult = $db->prepare($catsql);
      $catresult->execute(array($post['id']));
      $catres = $catresult->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <?php foreach ($catres as $cat) { ?>
        <h4 style="color:black;font-size:0.7rem;background:#15e8c1;padding:5px;border-radius:5px"> <i class='fas fa-futbol'></i><a style="color:black;font-weight:bold;font-size:0.8rem;background:#15e8c1;padding:5px" href="category.php?id=<?php echo ucfirst($cat['title']); ?>"><?php echo $cat['title'];?></a></h4> &nbsp; &nbsp;
         
         
         
      <?php } ?>
      
   
        
        </div>
        
        </div>
    
    <!----CATEGORY BLOCK ENDS----->
      

      <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>  
               <p class="card-text" style="color:darkgrey;font-weight:bold">
               
        
        <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.9rem;color:grey">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        
        
        
        <i style="color:black" class="fa fa-chevron-circle-right"></i>
          <small style="color:grey;justify-content:center;font-size:0.8rem"> 
           &nbsp;<?php  
           echo  time_ago_in_php($post['created']); ?></small>
        </p>
      

      <hr>
      
      





    </div>

    
  <?php }  ?>
    


      
  

  </div>
  
  <!-- Grid row -->


  
  
  
</div>







</div>


<!-----POINTS TABLE----->
<?php 

$sql = "SELECT * FROM tennisrank WHERE header='atpsingle' ORDER BY points DESC LIMIT 10";
$result = $db->prepare($sql);
$result->execute();
$ranks = $result->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-4">
<h1 class="page-header" style="background:black;font-family:Anton;color:white;text-align:center;margin:2px">
ATP SINGLE  </h1>
                <div class="panel panel-default">
                        
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                 
                                <table class="table table-hover" >
                                    <thead style="background:lightblue;color:black;font-weight:700;font-family:Anton;font-size:2rem">
                                        <tr>
                                            <th style="font-size:1rem"> Rank</th>
                                            
                                            <th style="font-size:1rem">Player</th>
                                            <th style="font-size:1rem">Country</th>
                                            
                                            <th style="font-size:1rem">Points</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                 
                                    
                                    <?php
                                        foreach ($ranks as $rank) {
                                            ?>
                                     
                                        <tr style="border-bottom:1px solid lightblue">
                                            <td style="font-weight:bold;font-size:0.8rem;text-align:center"><?php echo $rank['pos']; ?></td>
                                            
                                            <td style="font-weight:bold;font-size:0.8rem"><?php echo $rank['name']; ?></td>
                                            <td style="font-weight:bold;font-size:0.8rem"><?php echo $rank['country']; ?></td>
                                            <td style="font-weight:bold;font-size:0.8rem"><?php echo $rank['points']; ?></td>
                                            
                                            
                                         
                                        </tr>
                                        
                                     <?php } ?>
                        
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <a href="tennisrank-mensingle" style="color:red;font-weight:bold"> View  Men's Single Table <i class='fas fa-caret-right'></i></a>
                                    




                                    
<?php 

$sql = "SELECT * FROM tennisrank WHERE header='wtasingle' ORDER BY points DESC LIMIT 20";
$result = $db->prepare($sql);
$result->execute();
$ranks = $result->fetchAll(PDO::FETCH_ASSOC);

?>

<h1 class="page-header" style="background:black; font-family:Anton;color:lightblue;text-align:center;margin:2px">
WTA SINGLE </h1>
<div class="panel panel-default">
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                 
                                <table class="table table-hover" >
                                    <thead style="background:lightblue;color:black;font-weight:700;font-family:Anton;font-size:2rem">
                                        <tr>
                                            <th style="font-size:1rem"> Rank</th>
                                            
                                            <th style="font-size:1rem">Player</th>
                                            <th style="font-size:1rem">Country</th>
                                            
                                            <th style="font-size:1rem">Points</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                 
                                    
                                    <?php
                                        foreach ($ranks as $rank) {
                                            ?>
                                     
                                        <tr >
                                            <td style="font-weight:bold;font-size:0.8rem;text-align:center"><?php echo $rank['pos']; ?></td>
                                            
                                            <td style="font-weight:bold;font-size:0.8rem"><?php echo $rank['name']; ?></td>
                                            <td style="font-weight:bold;font-size:0.8rem"><?php echo $rank['country']; ?></td>
                                            <td style="font-weight:bold;font-size:0.8rem"><?php echo $rank['points']; ?></td>
                                            
                                            
                                         
                                        </tr>
                                        
                                     <?php } ?>
                        
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                        <a href="tennisrank-womensingle" style="color:red;font-weight:bold"> View Full Table <i class='fas fa-caret-right'></i></a>




<!----------------TODAYS MATCHES COLUMN------------------>
<h1 class="page-header" style="background:black; font-family:Anton;color:lightblue;text-align:center;margin:2px">
Todays Matches </h1>

<div class="card">
        <div class="card-header" style="background:black;color:white">
             US Open
  </div>
  <div class="card-body">
    <h5 class="card-title">5pm</h5>
    <p class="card-text">
     Rafael Nadal
    </p>
    <p class="card-text">
      Novak Djokovic
    </p>
    
  </div>
</div>


<div class="card">
  <div class="card-header" style="background:black;color:white">
      US Open &nbsp; &nbsp; &nbsp; &nbsp;  Quarter Finals
  </div>
  <div class="card-body">
    <h5 class="card-title">8pm &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Score</h5>
    <p class="card-text">
     Rafael Nadal
    </p>
    <p class="card-text">
      Novak Djokovic
    </p>
    
  </div>
  
</div>

 <!---column part of POINTS TABLE ADD ABOVE THIS LINE REMOVING COL LG-8-->
 
 
 
 
 </div>






 <!-----FOR THE ROW AND COL---->

</div>
</div>  

      <!-----FOR THE CONTAINER ---->
</div>

</div>

<?php include('includes/footer.php'); ?>



<script src="likedislike.js"></script>