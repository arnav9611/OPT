<link href="css/Style.css" rel="stylesheet">
<link href="css/all.css" rel="stylesheet">


<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php'); 

// get number of per page results from settings table
$rppsql = "SELECT * FROM settings WHERE name='resultsperpage'";
$rppresult = $db->prepare($rppsql);
$rppresult->execute();
$rpp = $rppresult->fetch(PDO::FETCH_ASSOC);
$perpage = $rpp['value'];

if(isset($_GET['page']) & !empty($_GET['page'])){
  $curpage = $_GET['page'];
}else{
  $curpage = 1;
}
// get the number of total posts from posts table
$sql = "SELECT * FROM posts WHERE status='published'";
$result = $db->prepare($sql);
$result->execute();
$totalres = $result->rowCount();
// create startpage, nextpage, endpage variables with values
$endpage = ceil($totalres/$perpage);
$startpage = 1;
$nextpage = $curpage + 1;
$previouspage = $curpage - 1;
$start = ($curpage * $perpage) - $perpage;


// fetch the results
$sql = "SELECT * FROM posts WHERE status='published' and header='transfer' and news='football' ORDER BY created DESC LIMIT $start, $perpage";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);
// add the pagination links
?>


<h1 class="page-title">Transfer News</h1>
  <div class="content clearfix">

    
    <div class="main-content">
     

      
      <?php
        foreach ($posts as $post) {
      ?>

         
                       
          
   <!-------------------------- Blog PIC PART ---------------------------------------------------------------------------->          
          <div class="post">
        
              <?php if(isset($post['pic']) & !empty($post['pic']))
              {?>

              <img  src="<?php echo $post['pic']; ?>" alt="" class="post-image">
            
              <?php }else{  ?>

              <img class="post-image" src="http://placehold.it/750x300" alt="">

              <?php } ?>

            </div>
 <!----------------------------------BODY POST-------------------------------------------------------------->           
         
            <div class="post-preview">
              <h1 class=""><?php echo $post['title']; ?></h1>
            
                <p class="preview-text"><?php echo $post['slug']; ?></p>
            
            
            <?php
              $sql = "SELECT * FROM comments WHERE pid=? AND status='approved'";
              $result = $db->prepare($sql);
              $result->execute(array($post['id']));
              $commentcount = $result->rowCount();
              if($commentcount >= 0)
              {
                ?>

            <!--------<a href="#" class="blog-post__cta"><?php echo $commentcount; ?> Comments</a>------->
               <?php } ?>
              <a href= "single.php?id=<?php  echo $post['slug'];    ?>"  class="blog-post__cta">Read the Article &rarr;</a>
            
            
              
            
<!---------------------------------DATE AND CREATOR PART---------------------------------------------------->
            
            <div class="post-date">
               <span> <?php  echo $post['created'];?></span>
                <?php 
                
                $usersql = "SELECT * FROM users WHERE id=?";
                $userresult = $db->prepare($usersql);
                $userresult->execute(array($post['uid']));
                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                
                ?>             <!-----Date---------------------->
                
                <a href="user-posts.php?id=<?php echo $user['id']; ?>"><?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
                
              </div>
<!-------------------------------------------------------------------------------------------------------------->
      
        </div>
        <?php }  ?> 
      </div>

    

         

        



    
      
    





        
      

   
<?php include('includes/footer.php'); ?>