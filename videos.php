<link href="css/Style.css" rel="stylesheet">
<link href="css/all.css" rel="stylesheet">








<?php 
session_start();
require_once('includes/connect.php');
include('admin/includes/if-loggedin.php');
include('includes/header.php');
include('includes/navigation.php'); 

?>

<!-------------------------- TOP POST PART ---------------------------------------------------------------------------->
  

<?php 

$sql = "SELECT * FROM videoposts WHERE status='published' and header='toppost' and news='esports' ORDER BY created DESC";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container my-9" style="background:black"> 

<h1 class="page-title" style="text-align:left;background:white;color:black;font-family:Anton;font-size:5rem">TOP VIDEOS</h1>



<div class="card mb-3 w-100"  >
  <div class="row g-0">


    <?php foreach ($posts as $post) { ?>
  <div class="col-md-8 h-100 w-100" >
    <?php if(isset($post['video']) & !empty($post['video'])){?>

      <a href="videosingle?id=<?php  echo $post['slug'];    ?>">
    <video class="img-fluid" controls muted>
        <source src="<?php echo $post['video']; ?>" > 
    
    </video>
   </a>


    

    <?php }else{  ?>

    <video  class="img-fluid">
        <source src="http://placehold.it/750x300" alt=""> 
    </video>

    <?php } ?>

  </div>
   
   
   
    <div class="col-md-4" style="background:black">
      <div class="card-body">
        
      <a href="videosingle?id=<?php  echo $post['slug']; ?>"><h5 class="card-title" style="font-family:Anton;font-size:2.5rem;text-transform:uppercase;color:white"><?php echo $post['title']; ?></h5></a>
        
      
      
        <p class="card-text">
        <i class="far fa-clock"></i>
          <small class="text-muted"> <?php  echo  $post['created'];?></small>
        </p>
      </div>
    </div>




    <?php }  ?>


  </div>
</div>

</div>


<?php include('includes/footer.php'); ?>