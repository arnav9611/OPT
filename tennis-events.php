<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php'); 


$sql = "SELECT * FROM tennisevent";
$result = $db->prepare($sql);
$result->execute();
$events = $result->fetchAll(PDO::FETCH_ASSOC);



    

?>
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
  



<!----MAIN BODY PART----->

<div class="container">
<h1 class="page-header" style="background:white; font-family:Anton;color:black;text-align:center;margin:2px;font-size:5rem">
Events </h1>


<?php 

$sql = "SELECT * FROM tennisevent WHERE month='feb'";
$result = $db->prepare($sql);
$result->execute();
$events = $result->fetchAll(PDO::FETCH_ASSOC);

?>



<div class="container my-9">

<h1 class="page-title" style="background:#091833;color:white;padding:5px;font-family:Anton;font-size:2rem" >September</h1>

<div class="row row-cols-1 row-cols-md-3" style="background:white">


<?php
 foreach ($events as $event) {
 ?>



<div class="col mb-4">
    <!-- Card --if same heigh needed put h-100 after card------>
    <div class="card h-100 " style="background:white;border-radius: 15px">
    

      
      <div class="view overlay">
      
<h1 style="background:white;color:black;font-family:Anton;padding:5px;text-align:center;border-radius: 15px">
        <?php echo $event['tournament']; ?></h1>

<?php if(isset($event['pic']) & !empty($event['pic'])){?>

    <img class="img-fluid" src="<?php echo $event['pic']; ?>"
          alt="">

  

<?php }else{  ?>

<img  class="img-fluid" src="http://placehold.it/750x300" alt="">

<?php } ?>



</div>

<div class="card-body">


  
    
    
    <p style="color:black"> <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $event['start']; ?> - <?php echo $event['end']; ?></p>
    <p style="color:black"> <i class='fas fa-map-marker-alt'></i> Place: <?php echo $event['place']; ?></p>  
    
    <p style="color:black"><i class="fa fa-trophy" aria-hidden="true"></i> Defending Champion:  <?php echo $event['champion']; ?></p>
     <p style="color:black"><i class="fas fa-money-bill-wave"></i> Prize Money: $<?php echo $event['money']; ?></p>
     <p style="color:black"><i class='fas fa-square'></i></i> Surface: <?php echo $event['surface']; ?></p>
     <p style="color:black"><i class='fas fa-user-friends'></i></i> Format: <?php echo $event['stage']; ?></p>
        
  </div>
<!----TOURNAMENT INFO ENDS--->
    
  
</div>

</div>
<!----GRID COLUMN ENDS------>

<?php } ?>

</div>

</div>

</div>


<?php include('includes/footer.php'); ?>

