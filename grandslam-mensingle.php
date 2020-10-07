<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php'); 



$sql = "SELECT * FROM grandslam WHERE header='atpsingle' ORDER BY year DESC";
$result = $db->prepare($sql);
$result->execute();
$grands = $result->fetchAll(PDO::FETCH_ASSOC);
    

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
                                            <th style="font-size:1rem">Tournament</th>
                                            <th style="font-size:1rem">Year</th>
                                            <th style="font-size:1rem">Winner</th>
                                            <th style="font-size:1rem">Match Score</th>
                                            <th style="font-size:1rem">Runner Up</th>
                                            <th style="font-size:1rem">Total Prize Money</th> 
                                               
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                 
                                    
                                    <?php
                                        foreach ($grands as $grand) {
                                            ?>
                                     
                                        <tr >
                                            <td style="font-size:0.8rem;font-weight:bold"><?php echo $grand['name']; ?></td>
                                            <td style="font-size:0.8rem"><?php echo $grand['year']; ?></td>
                                            <td style="font-size:0.8rem"><?php echo $grand['winner']; ?></td>
                                            <td style="font-size:0.8rem"><?php echo $grand['score']; ?></td>
                                            <td style="font-size:0.8rem"><?php echo $grand['runnerup']; ?></td>
                                            <td style="font-size:0.8rem">$<?php echo $grand['money']; ?></td>
                                         
                                           
                                            
                                            
                                         
                                        </tr>
                                        
                                     <?php } ?>
                        
                                        </tbody>
                                        </table>
                                        <h6 style="font-family:Anton;font-size:0.8rem"> Last Updated on <?php echo $grand['created']; ?> </h6>
                                        </div>
                                        </div>
                                    </div>
                                    </div>


  <div class="col-md-4">

  <div class="card">
        <div class="card-header" style="background:lightblue;color:white;margin:2px">
             MOST GRAND SLAM TITLES (MEN)
  </div>
  <div class="card-body">
  <p class="card-text">
    1. Roger Federer(SUI) &nbsp; &nbsp; &nbsp; &nbsp;  20
    </p>
    <p class="card-text">
     2. Rafael Nadal(ESP) &nbsp; &nbsp; &nbsp; &nbsp;   19
    </p>
    <p class="card-text">
     3. Novak Djokovic(SRB) &nbsp; &nbsp;  17
    </p>
    <p class="card-text">
      4. Pete Sampras(USA) &nbsp; &nbsp;&nbsp;  14
    </p>
    <p class="card-text">
      5. Roy Emerson(AUS) &nbsp; &nbsp;&nbsp;&nbsp;  12
    </p>
    <p class="card-text">
      6. Bjorn Borg(SWE) &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  11
    </p>
    <p class="card-text">
      7. Rodney Laver(AUS) &nbsp; &nbsp;  11
    </p>
    <p class="card-text">
      8. William Tilden(USA) &nbsp; &nbsp;  10
    </p>
    <p class="card-text">
      9. Frederick Perry(ENG) &nbsp; &nbsp;  8
    </p>
    <p class="card-text">
      10. Andre Agassi(USA) &nbsp; &nbsp;  8
    </p>
    
  </div>
 
</div>



<!---SIDEBAR DIV----ADD EVERYTHING ABOVE--->
</div>


                                
                            </div>
                    </div>
                    <?php include('includes/footer.php'); ?>