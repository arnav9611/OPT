<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php'); 



$sql = "SELECT * FROM tennisrank WHERE header='atpsingle' ORDER BY points DESC";
$result = $db->prepare($sql);
$result->execute();
$ranks = $result->fetchAll(PDO::FETCH_ASSOC);
    

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


      
                    
                
               
                
  <div class="container">

<div class="row">

  <!-- Post Content Column -->
  <div class="col-lg-8">
                
  <h1 class="page-header" style="background:white;color:black;margin:2px;font-family:Anton;text-decoration:underline;font-size:1.9rem"> Men's Single  </h1>
                
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                 
                                <table class="table table-hover" >
                                    <thead style="background:white;color:#17a39a;font-weight:700;">
                                        <tr >
                                            <th style="font-size:1rem">Rank</th>
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
                                            <td style="font-size:0.8rem"><?php echo $rank['pos']; ?></td>
                                            <td style="font-size:0.8rem"><?php echo $rank['name']; ?></td>
                                            <td style="font-size:0.8rem"><?php echo $rank['country']; ?></td>
                                            <td style="font-size:0.8rem"><?php echo $rank['points']; ?></td>
                                            
                                         
                                           
                                            
                                            
                                         
                                        </tr>
                                        
                                     <?php } ?>
                        
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

<!-----SDIEBAR----->
  <div class="col-md-4">

  



<!---SIDEBAR DIV----ADD EVERYTHING ABOVE--->
</div>


                                
                            </div>
                    </div>
                    <?php include('includes/footer.php'); ?>