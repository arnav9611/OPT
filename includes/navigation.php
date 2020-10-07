 
 
 
 
 <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@661&display=swap" rel="stylesheet">
    
 
 
 
 
    <?php
    
   
     include('header.php');
   
   
     ?>

     
   <script  src="../vendor/jquery/jquery.min.js"></script>
   <script  src="../vendor/jquery/jquery.js"></script>
   
   
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
     
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
   
     <!-- JQuery -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <!-- Bootstrap tooltips -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
   <!-- Bootstrap core JavaScript -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
   <!-- MDB core JavaScript -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
   
   
   
   
   
   
    
   
   
     <nav class="navbar  navbar-expand-lg navbar-dark scrolling-navbar white" style="font-family:'Grenze Gotisch', cursive;background:white;justify-content:center">
     <a class="navbar-brand" href="index" style="font-size:3.3rem;color:black;border:4px solid black;text-align:center;padding:2px">OFFPITCH tALKS</a>
     
     
     
    
   
   
    
   
   
    <ul class="navbar-nav ml-auto nav-flex-icons">
         
     
   
   
   
   
         <li class="nav-item">
         <a class="nav-link waves-effect waves-light">
             <i class="fab fa-facebook" style="color:black;font-size:1.5rem"> </i>
           </a>
           </li>
   
   
   
       <li class="nav-item">
           <a class="nav-link waves-effect waves-light">
             <i class="fab fa-twitter " style="color:black;font-size:1.5rem"> </i>
           </a>
           </li>
   
   
   
           <!--Instagram-->
       <li class="nav-item">
       <a class="nav-link waves-effect waves-light">
             <i class="fab fa-instagram " style="color:black;font-size:1.5rem"> </i>
           </a>
       </li>
   
   
   
       <li class="nav-item">
           <a class="nav-link waves-effect waves-light">
               <i class="fab fa-youtube " style="color:black;font-size:1.5rem"></i>
           </a>
       </li>
   
   
   
   
   
         <li class="nav-item">
         <?php 
         $catsql = "SELECT * FROM categories";
         $catresult = $db->prepare($catsql);
         $catresult->execute();
         $catres = $catresult->fetchAll(PDO::FETCH_ASSOC);
       ?>
     
     <select  style="background:white;color:black;font-family:Anton;margin:3px" class="browser-default custom-select" onchange="location = this.value;">
     <option style="background:white;color:black;border-radius:15px" selected value="index">Search News for <i class="	fas fa-sort-down" style="color:black"></i>  </option> 
   
     <?php foreach ($catres as $cat) {?>
   
     <option style="background:white;color:black;border-radius:15px" value="category?id=<?php echo ucfirst($cat['title']); ?>" ><?php echo $cat['title']; ?></option>
     <?php } ?>
   </select>
   
   
   
   
         </li>
       </ul>
     </nav>
     
     
     
     
     
     <nav class="mb-1 navbar navbar-expand-lg navbar-dark " style="font-family:Anton;background:#041124">
     
   
     
     
     
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
       aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     
     
     
     
     <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
       <ul class="navbar-nav mr-auto">
         <li class="nav-item ">
           <a class="nav-link" href="index" style="">Football</a>
           
         </li>
         <li class="nav-item">
           <a class="nav-link" href="esports" style="">Esports</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="tennis" style="">Tennis</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="transfer" style="">Football Transfer</a>
         </li>
   
   
         <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
             aria-expanded="true">Football Leagues
           </a>
           <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
             <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="premierleague">Premier League</a>
             <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="#">La Liga</a>
             <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="#">France Ligue 1</a>
             <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="#">Serie A</a>
             <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="#">Bundesliga</a>
             <a class="dropdown-item" style="font-size:1rem;font-family:Anton" href="#">Indian Super League</a>
           </div>
         </li>
        
         <li class="nav-item">
           <a class="nav-link" href="videos" style="">Videos</a>
         </li>
   
         <li class="nav-item">
           <a class="nav-link" href="foundation" style="">Foundation</a>
         </li>
   
         <li class="nav-item">
           <a class="nav-link" href="talkofthetown" style="">Talk of the Town</a>
         </li>
   
         <li class="nav-item">
           <a class="nav-link" href="register" style="">Sign Up</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="login" style="">Login</a>
         </li>
   <!-------------ENDS------------------->
       </ul>
   
       
       
     
   
     
    
   
   
     <!-----CATEGORY SELECT BOX----->
     
     
   
   
   
   
         <?php
           if(isset($_SESSION['id']) & !empty($_SESSION['id']))
     
             {
       // display logged in user details
                   $sql = "SELECT * FROM users WHERE id=?";
                   $result = $db->prepare($sql);
                   $result->execute(array($_SESSION['id']));
                   $user = $result->fetch(PDO::FETCH_ASSOC); 
         ?>
        
      
   <ul class="nav navbar-nav navbar-right">
    <li class="nav-item dropdown" style="background:#041124;color:white;border-radius:15px">
     <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="true" style="color:white;border-radius:15px">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
   
        <div class="dropdown-menu dropdown-primary" style="" aria-labelledby="navbarDropdownMenuLink">
        
        <a class="dropdown-item" style="font-size:1rem" href="viewposts"><i class="fa fa-file-text-o"></i> View my tALKS</a>
        <a class="dropdown-item" style="font-size:1rem" href="logout"><i class='far fa-frown' style='font-size:14px'></i> Logout</a>
     <?php } ?>
     
     
     </li>
   
    </ul>
   
    </div>
   
    </nav>
   
    
    
    
   