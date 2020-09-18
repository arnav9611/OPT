<link href="css/Style.css" rel="stylesheet">
<link href="css/all.css" rel="stylesheet">







<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php'); 

// get number of per page results from settings table



// fetch the results
$sql = "SELECT * FROM posts WHERE status='published' and header='toppost' and news='esports' ORDER BY created DESC";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);

?>


<h1 class="page-title">E-SPORTS</h1>


<!-------------------------- Blog PART ---------------------------------------------------------------------------->
                      
          
            
  <div class="blog-post">
        


 <?php foreach ($posts as $post) 
        { ?>
    
    
    <?php if(isset($post['pic']) & !empty($post['pic'])){?>

      <img class="blog-post__img" src="<?php echo $post['pic']; ?>" alt="">
            
      <?php }else{  ?>

      <img  class="blog-post__img" src="http://placehold.it/750x300" alt="">

      <?php } ?>
   

 <!----------------------------------BODY POST-------------------------------------------------------------->           
     
 <div class="blog-post__info">

      <h1 class="blog-post__title"> <?php echo $post['title']; ?></h1>


      <p class="blog-post__text"><?php echo $post['slug']; ?></p>
            <?php
              $sql = "SELECT * FROM comments WHERE pid=? AND status='approved'";
              $result = $db->prepare($sql);
              $result->execute(array($post['id']));
              $commentcount = $result->rowCount();
              if($commentcount >= 0){
            ?>
           <!---- <a href="#" class="blog-post__cta"><?php echo $commentcount; ?> Comments</a>------------>
            <?php } ?>
            <a href= "single.php?id=<?php  echo $post['slug'];    ?>"  class="blog-post__cta">&rarr; </a>
      
            
<!---------------------------------DATE AND CREATOR PART---------------------------------------------------->
            
          <div class="blog-post__date">
              <span> <?php  echo  $post['created'];?></span>
                <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>             <!-----Date---------------------->
                <a href="user-posts.php?id=<?php echo $user['id']; ?>"><?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }
                else{echo $user['username']; } ?></a>
            
          </div>






</div>
   
<?php }  ?>


</div>        <!----------END OF MAIN BLOG_POST DIV------------------->



<!-----------------editor choice for eSPorts--------------------------->


<?php 
$sql = "SELECT * FROM posts WHERE status='published' and header='editorchoice' and news='esports'  ORDER BY created  DESC LIMIT 4 ";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);


?>



<div class="wrapper">


<h1 class="page-title" style="text-align:center;background:black;color:yellow" >EDITOR's CHOICE</h1>

<!----------foreach starts here--------->
<?php foreach ($posts as $post) { ?>
    
  <div class="card">

    
  
       
    
  <div class="card-banner"> 
    <!---- CATEGORY PART--->
<?php 
    
  $catsql = "SELECT * FROM categories";
  $catresult = $db->prepare($catsql);
  $catresult->execute();
  $catres = $catresult->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($catres as $cat) { ?>
      <a class="category-tag" href="category.php?id=<?php echo $cat['title']; ?>"><?php echo $cat['title']; ?></a>


      <?php } ?>





      <!-------IMAGE PART-------------------->
      <?php if(isset($post['pic']) & !empty($post['pic'])){?>

            <img class="banner-img" src="<?php echo $post['pic']; ?>" alt="">
      
      <?php }else{  ?>

            <img  class="banner-img" src="http://placehold.it/750x300" alt="">

      <?php } ?>
      
    </div> 
    
    
    <!------TITLE----->
    
    <div class="card-body">
                                   
        <h2 class="blog-title"> <?php echo $post['title']; ?></h2>
        <a href= "single.php?id=<?php  echo $post['slug'];    ?>"  class="blog-post__cta">&rarr; </a>
    </div>
     
     <hr></hr>
     <!------------DATE------------------------>
     <div class="card-profile">
     
        <h3 class="blog-hashtag"><p> Posted on<?php  echo  $post['created'];?></p></h3>
        
        
        
        
         <!------------NAME------------------------>
        <div class="card-profile-info">
        <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>  

              <a  class="profile-name" href="user-posts.php?id=<?php echo $user['id']; ?>"><?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }
                else{echo $user['username']; } ?></a>
        </div>
     </div>
  
  
  <!------------end of -card and wrapper------------>
  </div>
  

    
  
  <!--------php code-------------->
  <?php }  ?>


</div>



<!-------------------CAROUSEL PART--------------------------------------------->
<div class="page-wrapper">
  <div class="post-slider">
      
    <h1 class="slider-title" style="font-family:Anton;
                                    text-align:center;
                                    font-size:5rem;
                                    color:black;
                                    text-transform:uppercase;
                                    margin:30px auto;
                                    background:deepskyblue;
                                    color:black"> 
                                    Trending Posts
    </h1>

    <i class="fas fa-chevron-left prev"></i>
      <i class="fas fa-chevron-right next"></i>
         
         <!---------foreach--------------->
          <div class="post-wrapper">
            
          
             <div class="post">
             <div class="post-info">
                  <h4 style="font-family:Anton;text-align:center;margin:5px"> kjhkjjhjj kjkjm,m, lklklkl lklkl kjkjk kjkjkjkj kjkjkjk kjkjkjk kjkjk jkjkjkj</h4>
                  <i class="far fa-user"> Arnav Kumar Nath</i>
                  &nbsp;
                  <h4> Created on </h4>
                </div>   
             <img src="https://static01.nyt.com/images/2019/04/16/sports/16onsoccerweb-2/merlin_153612873_5bb119b9-8972-4087-b4fd-371cab8c5ba2-superJumbo.jpg" alt="" class="slider-image">

                
            </div>


            <div class="post">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/Lionel_Messi_in_2018.jpg/220px-Lionel_Messi_in_2018.jpg" alt="" class="slider-image">

                <div class="post-info">
                  <h4 style="font-family:Anton;text-align:center;margin:5px"> Tit asdasd asdasdas asdasdas asdasd le</h4>
                  <i class="far fa-user"> Arnav Kumar Nath</i>
                  &nbsp;
                  <h4> Created on </h4>
                </div>
            </div>


            <div class="post">
            <div class="post-info">
                  <h4 style="font-family:Anton;text-align:center;margin:5px;color:black;text-transform:uppercase"> Pogba eyes Real Madrid trasfer admist corona</h4>
                  
                </div>    
            <img src="https://i.guim.co.uk/img/media/c5ec218bff3ffa76670323021878bb4886deda48/0_177_5328_3198/master/5328.jpg?width=1200&height=1200&quality=85&auto=format&fit=crop&s=c22dd7d78f6a72dbdc812533000b6d11" alt="" class="slider-image">

                
            </div>


            <div class="post">
                <img src="https://i.insider.com/5f454a4242f43f001ddfee74?width=1100&format=jpeg&auto=webp" alt="" class="slider-image">

                <div class="post-info">
                  <h4 style="font-family:Anton;text-align:center;margin:5px"> Titlas;ld;asld;als;dla;sdl;asld asdasd asdasd e</h4>
                  <i class="far fa-user"> Arnav Kumar Nath</i>
                  &nbsp;
                  <h4> Created on </h4>
                </div>
            </div>
          
          
          
          </div>


        <!----------php syntax--------->
        
      </div>
</div>




  

<?php include('includes/footer.php'); ?>



<script src="vendor/jquery/main.js"></script>
<script src="vendor/slick.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>