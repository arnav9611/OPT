<?php 

require_once('connect.php');

include('admin/includes/if-loggedin.php');
include('header.php');


?>

<div class="col-md-4">

<?php
  if(isset($_SESSION['id']) & !empty($_SESSION['id']))
  {
    // display logged in user details
    $sql = "SELECT * FROM users WHERE id=?";
    $result = $db->prepare($sql);
    $result->execute(array($_SESSION['id']));
    $user = $result->fetch(PDO::FETCH_ASSOC); 
?>
  
  <div class="card my-4">
    <h5 class="card-header">User</h5>
    <div class="card-body">
      Welcome  <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?> 

       
      <?php 
        if(($user['role'] == 'administrator') || ($user['role'] == 'editor'))
        {
          echo "<a href='http://localhost/OPT/admin/dashboard.php'".$user['role']."</a>";
          echo $user['role']; 
        }elseif($user['role'] == 'subscriber')
        {
          echo "<a href='http://localhost/OPT/index.php'".$user['role']."</a>";
        }
      
      ?>
      <br>
      <a href="http://localhost/OPT/logout.php">Logout</a>
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
?>
  
  <div class="card my-4">
    <h5 class="card-header">Login</h5>
    <div class="card-body">
      <form role="form" method="post" action="admin/login.php">
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
      $_SESSION['csrf_token_time'] = time();
        <fieldset>
              <div class="form-group">
                  <input class="form-control" placeholder="E-mail or User Name" name="email" type="text" autofocus>
              </div>
              <div class="form-group">
                  <input class="form-control" placeholder="Password" name="password" type="password" value="">
              </div>
              <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" />
          </fieldset>
      </form>
    </div>
  </div>
<?php } } ?>
</div>