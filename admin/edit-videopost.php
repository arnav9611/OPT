<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/check-subscriber.php');

if (isset($_POST) & !empty($_POST)) 
{
    if(empty($_POST['title'])){$errors[]="Title Field is Required";}
    if(empty($_POST['content'])){$errors[]="Content Field is Required";}
    

    
 //CSRF Validation
    if(isset($_POST['csrf_token'])){
        if($_POST['csrf_token'] === $_SESSION['csrf_token']){
        }else{
            $errors[] = "Problem with CSRF Token Verification";
        }
       }
       else{
           $errors[] = "Problem with CSRF Token Validation";
       }

       $max_time = 60*60*24; // in seconds
       if(isset($_SESSION['csrf_token_time'])){
           $token_time = $_SESSION['csrf_token_time'];
           if(($token_time + $max_time) >= time() ){
           }else{
               $errors[] = "CSRF Token Expired";
               unset($_SESSION['csrf_token']);
               unset($_SESSION['csrf_token_time']);
           }
       }else{
               
               unset($_SESSION['csrf_token']);
               unset($_SESSION['csrf_token_time']);
           }

           if(empty($errors)){

            if(isset($_FILES) & !empty($_FILES)){
                $name = $_FILES['video']['name'];
                $size = $_FILES['video']['size'];
                $type = $_FILES['video']['type'];
                $tmp_name = $_FILES['video']['tmp_name'];

                if(isset($name) && !empty($name)){
                    if($type == "video/mp4"){
                        $location = "../media/";
                        $filename = time() . $name;
                        $uploadpath = $location.$filename;
                        $dbpath = "media/" . $filename;
                        move_uploaded_file($tmp_name, $uploadpath);
                    }else{
                        $errors[] = "Only Upload mp4 files";
                    }
                }
            }



            $sql = "UPDATE videoposts SET title=:title, content=:content, status=:status, news=:news,header=:header,slug=:slug, ";
            if(isset($dbpath) & !empty($dbpath)){ $sql .="video=:video, "; }  
            $sql .= "updated=NOW() WHERE id=:id";
            
            $result = $db->prepare($sql);
            $values = array(':title'    => $_POST['title'],
                            ':content'  => $_POST['content'],
                            ':status'   => $_POST['status'],
                            ':news'     => $_POST['news'],
                            ':header'   => $_POST['header'],
                            ':slug'     => $_POST['slug'],
                            ':id'       => $_POST['id'],
                            );
            if(isset($dbpath) & !empty($dbpath)){ $values[':video'] = $dbpath;}   ///Otherwise it shows NO Image after updating
                            
                             $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
                            
                             if($res){

                                //  removing non selected categories from post_categories table
                                $pid = $_POST['id'];
                                foreach ($_POST['categories'] as $category) {
                                    $catsql = "SELECT * FROM post_categories WHERE pid=:pid AND cid=:cid";
                                    $catresult = $db->prepare($catsql);
                                    $values = array(':pid'      => $pid,
                                                    ':cid'      => $category,
                                                    );
                                    $catresult->execute($values);
                                    $catcount = $catresult->rowCount();
                                    if($catcount == 1){}else{
                                        $sql = "INSERT INTO post_categories (pid, cid) VALUES (:pid, :cid)";
                                        $result = $db->prepare($sql);
                                        $values = array(':pid'  => $pid,
                                                        ':cid'  => $category
                                                        );
                                        $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
                                    }
                                }
                                header("location: view-videoposts.php");
                            }else{
                                $errors[] = "Failed to Add Category";
                            }
                        }
                    }
//Create csrf token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();






$sql = "SELECT * FROM users WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_SESSION['id']));
$user = $result->fetch(PDO::FETCH_ASSOC); 

if($user['role'] == 'administrator'){
    $sql = "SELECT * FROM videoposts WHERE id=?";
    $result = $db->prepare($sql);
    $result->execute(array($_GET['id']));
    $post = $result->fetch(PDO::FETCH_ASSOC);       
}elseif($user['role'] == 'editor'){
    $sql = "SELECT * FROM videoposts WHERE id=? AND uid={$_SESSION['id']}";
    $result = $db->prepare($sql);
    $result->execute(array($_GET['id']));
    $postcount = $result->rowCount();
    $post = $result->fetch(PDO::FETCH_ASSOC);
    if($postcount <= 0){
        header("location: view-videoposts.php");
    }
} 

include('includes/header.php');
include('includes/navigation.php');
?>

<div id="page-wrapper" style="min-height: 345px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Video Post</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit  Video Post 
                </div>
                <div class="panel-body">
                    <?php
                        if(!empty($messages))
                        {
                            echo "<div class='alert alert-success'>";
                            foreach ($messages as $message) {
                                echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;". $message ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                    <?php
                        if(!empty($errors)){
                            echo "<div class='alert alert-danger'>";
                            foreach ($errors as $error) {
                                echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;". $error ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <div class="form-group">
                                    <label>Edit Article Title</label>
                                    <input class="form-control" name="title" placeholder="Edit Article Title" value="<?php if(isset($post['title'])){ echo $post['title'];} ?>">
                                </div>

                                <div class="form-group">
                                    <label>Edit Article Content</label>
                                    <textarea class="form-control" name="content" rows="3"><?php if(isset($post['content'])){ echo $post['content'];} ?></textarea>
                                </div>
                                
                               
                               
                                <div class="form-group">
                                    <?php
                                        if(isset($post['video']) & !empty($post['video'])){
                                            echo "<video  controls> <source src='../".$post['video']."' ></video>";
                                            echo "<a href='delete-video.php?id=". $_GET['id'] ."&type=videopost'>Delete Video</a>";
                                        }else{
                                    ?>
                                    <label>Change Featured Video</label>
                                    <input type="file" name="video">
                                    <?php } ?>
                                </div>

                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php 
                                                // TODO : Select Existing Categories from Database Values
                                            $sql = "SELECT * FROM categories";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                            $res = $result->fetchAll(PDO::FETCH_ASSOC);

                                            $catsql = "SELECT * FROM post_categories WHERE pid=?";
                                            $catresult = $db->prepare($catsql);
                                            $catresult->execute(array($_GET['id']));
                                            $categories = $catresult->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                            <label>Change Categories</label>
                                            <select multiple="" name="categories[]" class="form-control">
                                            <?php
                                                foreach ($res as $cat) {
                                                    if(in_array($cat['id'], array_column($categories, 'cid'))){$selected = "selected"; }else{ $selected = ""; }
                                                    echo "<option value='".$cat['id']."'". $selected .">".$cat['title']."</option>";
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">


                                            <label>Change Article Status</label>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios1" value="draft" <?php if($post['status'] == 'draft'){ echo "checked"; } ?>>Draft
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios2" value="review" <?php if($post['status'] == 'review'){ echo "checked"; } ?>>Pending Review
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios3" value="published" <?php if($post['status'] == 'published'){ echo "checked"; } ?>>Published
                                                
                                                </label>
                                            </div>
                                       
                                       
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Article News Type</label>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios8" value="football" <?php  if($post['news'] == 'football'){ echo "checked"; }  ?>>Football
                                                </label>
                                            </div>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios9" value="esports" <?php  if($post['news'] == 'esports'){ echo "checked"; }  ?>>Esports
                                                </label>
                                            </div>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios10" value="tennis" <?php  if($post['news'] == 'tennis'){ echo "checked"; }  ?>>Tennis
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="news" id="optionsRadios3" value="transfer" <?php  if($post['news'] == 'transfer'){ echo "checked"; }  ?>>Transfer News 
                                                </label>
                                            </div>

                                            
                                        
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Article Header</label>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="header" id="optionsRadios1" value="toppost" <?php  if($post['header'] == 'toppost'){ echo "checked"; } ?> >Top Post
                                                </label>
                                            </div>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="header" id="optionsRadios2" value="recent" <?php  if($post['header'] == 'recent'){ echo "checked"; }  ?>>Recent Articles
                                                </label>
                                            </div>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="header" id="optionsRadios3" value="editorchoice" <?php  if($post['header'] == 'editorchoice'){ echo "checked"; }  ?>>Editor's Choice
                                                </label>
                                            </div>
                                            
                                        
                                        
                                        </div>
                                    </div>          

                                </div>
                               
                               
                                <div class="form-group">
                                    <label>Change Article Slug</label>
                                    <input class="form-control" name="slug" placeholder="Enter Article Slug Here" value="<?php if(isset($post['slug'])){ echo $post['slug'];} ?>">
                                </div>
                                <input type="submit" class="btn btn-success" value="Submit" />
                            </form>
                            
                        </div>
                        <!-- /.col-lg-6 (nested) -->   
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<?php include('includes/footer.php'); ?>