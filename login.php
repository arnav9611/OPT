<?php 
session_start();
require_once('includes/connect.php');

include('includes/header.php');
include('includes/navigation.php');
?>


 <div class="col-md-4 offset-md-4" >

<?php
  if(isset($_SESSION['id']) & !empty($_SESSION['id']))
  {
    // display logged in user details
    $sql = "SELECT * FROM users WHERE id=?";
    $result = $db->prepare($sql);
    $result->execute(array($_SESSION['id']));
    $user = $result->fetch(PDO::FETCH_ASSOC); 
?>
  
  <div  >
    
    <div  style="color:black;background:white;font-size:1.5rem;text-align:center">
      Welcome<strong> <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?>
      </strong>
       <h4 style="font-size:1.3rem;color:black;font-weight:700"> Visit <a href="talkofthetown" style="font-size:1.3rem;font-weight:700;color:red"> Talk of the Town </a>to share your views</h4>
      <?php 
        if(($user['role'] == 'administrator') || ($user['role'] == 'editor'))
        {
          echo "<a href='http://localhost/OPT/admin/dashboard.php'".$user['role']."</a>";
          echo ucfirst($user['role']); 
        }elseif($user['role'] == 'subscriber')
        {
          echo "<a href='http://localhost/OPT/index'".$user['role']."</a>";
        }
      
      ?>
      
    </div>
  </div>


<?php }else{ ?>
  <?php
  $userregsql = "SELECT * FROM settings WHERE name='userreg'";
  $userregresult = $db->prepare($userregsql);
  $userregresult->execute();
  $userreg = $userregresult->fetch(PDO::FETCH_ASSOC);
  if($userreg['value'] == 'yes')
  {
    // Create CSRF token
    $token = md5(uniqid(rand(), TRUE));
    $_SESSION['csrf_token'] = $token;
    $_SESSION['csrf_token_time'] = time();
      ?>

  <div class="card my-4" style="border-radius:15px" >
    <h5 class="card-header" style="background:#cf4c38;font-family:Anton;color:white;border-radius:15px 15px 0 0;">Login</h5>
    <div class="card-body" style="background:white;border-radius:15px;">
      <form role="form" method="post" action="admin/login.php">
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
          <fieldset>
              <div class="form-group">
                  <input class="form-control" style="border-radius:15px" placeholder="E-mail or User Name" name="email" type="text" autofocus>
              </div>
              <div class="form-group">
                  <input class="form-control" style="border-radius:15px" placeholder="Password" name="password" type="password" value="">
              </div>
              
              <input type="submit" class="btn" style='background:#cf4c38;color:white;font-weight:700;border-radius:15px;letter-spacing:0.7px' value="Login" />
          </fieldset>
      </form>
    </div>
  </div>
  <div >
<p style="font-weight:500;"> Not a member yet ? |
<a href="register" style="color:#cf4c38;text-decoration:underline"> Become an OffPitcher </a>
</p>
</div>

<?php } } ?>










</div>


<?php include('includes/footer.php'); ?>