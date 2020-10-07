







<?php 
session_start();
require_once('includes/connect.php');
include('admin/includes/if-loggedin.php');
include('includes/header.php');
include('includes/navigation.php'); 

?>

<!-------------------------- TOP POST PART ---------------------------------------------------------------------------->
  

<?php 

$sql = "SELECT * FROM posts WHERE status='published' and header='toppost' and news='esports' ORDER BY created DESC";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container my-9" style="background:black"> 

<h1 class="page-title" style="text-align:left;background:white;color:black;font-family:Anton;font-size:5rem">E-SPORTS</h1>



<div class="card mb-3 w-100"  >
  <div class="row g-0">


    <?php foreach ($posts as $post) { ?>
  <div class="col-md-8 h-100 w-100" >
    <?php if(isset($post['pic']) & !empty($post['pic'])){?>

      <a href="<?php echo $post['slug'];?>">
    <img class="img-fluid" src="<?php echo $post['pic']; ?>"
    alt=""></a>


    

    <?php }else{  ?>

    <img  class="img-fluid" src="http://placehold.it/750x300" alt="">

    <?php } ?>

  </div>
   
   
   
    <div class="col-md-4" style="background:black">
      <div class="card-body">
        
      <a href="<?php echo $post['slug'];?>"><h5 class="card-title" style="font-family:Anton;font-size:2.5rem;text-transform:uppercase;color:white"><?php echo $post['title']; ?></h5></a>
     
        
      
      
        <p class="card-text">
        <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>   
                <i class="fas fa-pen-alt" style="color:yellow"></i>
        
                <a style="font-size:0.8rem;color:yellow" href="<?php echo $user['username']; ?>">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
          |
          <small style="color:yellow">
           <?php 
          
            $created = date_create($post['created']);
        
            echo $created = date_format($created,"D, d M Y"); 
          ?>
          
          </small>
        </p>
      </div>
    </div>




    <?php }  ?>


  </div>
</div>

</div>


<!-------------EDITORS CHOICE--------------------------->

<?php 
$sql = "SELECT * FROM posts WHERE status='published' and header='editorchoice' and news='esports'  ORDER BY created  DESC LIMIT 4 ";
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
    <div class="card h-100 " style="background:#19181c;border-radius: 15px">
    

      
      <div class="view overlay">


      <?php if(isset($post['pic']) & !empty($post['pic'])){?>


        <img class="card-img-top" src="<?php echo $post['pic']; ?>"
          alt="">


        <a href="<?php echo $post['slug'];    ?>">
          <div class="mask rgba-white-slight"></div>
        </a>

        <?php }else{  ?>

        <img  class="card-img-top" src="http://placehold.it/750x300" alt="">

        <?php } ?>

      </div>

    
      <div class="card-body">

        
        <a href="<?php echo $post['slug'];?>"></a>
        <h4 class="card-title" style="color:white;font-family:Anton;text-align:center;font-size:1.5rem">
            <?php echo $post['title']; ?>
        </h4>
        
        <!--Text-->
        
                <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>   
                <i class="fas fa-pen-alt" style="color:yellow"></i>
        
        <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:yellow">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
         
          <small style="color:grey;justify-content:center"> 
           &nbsp; | <?php  
          $created = date_create($post['created']);
        
        echo $created = date_format($created," d M Y"); ?></small>
      </div>
        
      


    </div>
    <!-- Card -->
  </div>



  
  <?php }  ?>
  
</div>

<a 
href="editorchoicefootball" 
style="font-family:Anton;color:#b30b1e;font-weight:700;font-size:1rem;"> 
View All Editor's Choice News <i class="fa fa-chevron-circle-right"></i> 
</a>

</div>


<!-----------------------------------------------TRENDING POSTS----------------------------->
<?php 
$sql = "SELECT * FROM posts WHERE status='published' and header='recent' and news='esports'  ORDER BY created  DESC LIMIT 4 ";
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
      <div class="view overlay " style="">
      
      
      <?php if(isset($post['pic']) & !empty($post['pic'])){?>


        <a href="single.php?id=<?php  echo $post['slug'];    ?>"><img class="img-fluid  w-100" src="<?php echo $post['pic']; ?>"
          alt=""></a>


        
              
        

<?php }else{  ?>

<img  class="img-fluid" src="http://placehold.it/750x300" alt="">

<?php } ?>

        
      </div>

    </div>
    
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-7 text-md-left ml-3 mt-3"  >

      
     

      <a href="single.php?id=<?php  echo $post['slug'];    ?>"><h4 class="h4 mb-4" style="font-family:Anton;color:black;font-size:1.5rem;"><?php echo ucfirst($post['title']); ?></h4></a>
      
      <!----CATEGORY BLOCK STARTS----->


      <?php
        $sql = "SELECT * FROM categories WHERE pid=? ";
        $result = $db->prepare($sql);
        $result->execute(array($post['id']));
        $catres = $result->fetchAll(PDO::FETCH_ASSOC);
        ?>
      
      <?php foreach ($catres as $cat) { ?>
        <h4> <?php echo $catres['title'];?></h4>
         
         
         
      <?php } ?>
         
         
         
               
        
      
 
    <!----CATEGORY BLOCK ENDS----->
      

      <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>  
               <p class="card-text" style="color:grey">
               
        
        <a href="user-posts.php?id=<?php echo $user['id']; ?>" style="font-size:0.8rem;color:grey">  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        
        
        
          |
          <small style="color:grey;justify-content:center"> 
           &nbsp;<?php  
          $created = date_create($post['created']);
        
        echo $created = date_format($created," d M Y"); ?></small>
        </p>
      

      <hr >
      
      





    </div>

    
  <?php }  ?>
    


      
  

  </div>
  
  <!-- Grid row -->


  
  
  
</div>








</div>

<!-----POINTS TABLE----->
<?php 

$sql = "SELECT * FROM points WHERE league='premierleague' ORDER BY points DESC";
$result = $db->prepare($sql);
$result->execute();
$points = $result->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-4">
<div class="btn-group">
    <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:black;color:white;font-family:Anton">Premier League</button>

    <div class="dropdown-menu">
        <option class="dropdown-item"  style="background:black;color:white;font-family:Anton">La Liga</option>
        <option class="dropdown-item" href="#" style="background:black;color:white;font-family:Anton">France Ligue1</option>
        <option class="dropdown-item" href="#" style="background:black;color:white;font-family:Anton">Serie A</option>
        <option class="dropdown-item" href="#" style="background:black;color:white;font-family:Anton">Bundesliga</option>
        <option class="dropdown-item" href="#" style="background:black;color:white;font-family:Anton">ISL</option>
        </div>
</div>
<h1 class="page-header" style="background:#3f0947;font-family:Anton;color:white;text-align:center;margin:2px">

<img   src="https://www.thesportsdb.com/images/media/league/logo/4c377s1535214890.png" style="height:70px ">  </h1>
<div class="panel panel-default">
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                 
                                <table class="table table-hover" >
                                    <thead style="background:lightblue;color:black;font-weight:700;font-family:Anton;font-size:2rem">
                                        <tr>
                                            <th style="font-size:1rem">Position</th>
                                            <th style="font-size:1rem">Club</th>
                                            <th style="font-size:1rem">Played</th>
                                            
                                            <th style="font-size:1rem">Points</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                 
                                    
                                    <?php
                                        foreach ($points as $pointstb) {
                                            ?>
                                     
                                        <tr >
                                        <td style="font-weight:bold;font-size:0.8rem"><?php echo $pointstb['pos']; ?></td>
                                            <td style="font-weight:bold;font-size:0.8rem"><?php echo $pointstb['club']; ?></td>
                                            <td style="font-weight:bold;font-size:0.8rem"><?php echo $pointstb['mp']; ?></td>
                                           
                                            <td style="font-weight:bold;font-size:0.8rem"><?php echo $pointstb['points']; ?></td>
                                            
                                            
                                         
                                        </tr>
                                        
                                     <?php } ?>
                        
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                    </div>
                                    <a href="premierleague" style="color:red;font-weight:bold"> View Full Table <i class='fas fa-caret-right'></i></a>

                                    <!----END OF POINTS TABLE---->

</div>



</div>    



      <!-----FOR THE CONTAINER ---->


   


</div>



<?php include('includes/footer.php'); ?>



