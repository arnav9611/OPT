<?php 




include('includes/check-login.php'); 




//This is the template for our commenting system, the comments are populated by executing the show_comments() function along with the comments associative array variable that we previously defined.
function show_comments($comments, $parent_id = -1) {
    $html = '';
    if ($parent_id != -1) {
        // If the comments are replies sort them by the "submit_date" column
        array_multisort(array_column($comments, 'created'), SORT_ASC, $comments);
    }


    // Iterate the comments using the foreach loop
    foreach ($comments as $comment) {
        if ($comment['parent_id'] == $parent_id) {
            // Add the comment to the $html variable
            $html .= '
            <div class="comment">
                <div>
                   
                    <span class="date">' . $comment['created'] . '</span>
                </div>
                <p class="content">' . nl2br(htmlspecialchars($comment['comment'], ENT_QUOTES)) . '</p>
                <a class="reply_comment_btn" href="#" data-comment-id="' . $comment['id'] . '">Reply</a>
                ' . show_write_comment_form($comment['id']) . '
                
                
                <div class="replies">
                ' . show_comments($comments, $comment['id']) . '
                </div>
            </div>
            ';
        }
    }
    return $html;
}




// This function is the template for the write comment form
//function will show the form that visitors can use to write and submit comments.

function show_write_comment_form($parent_id = -1) {
    $html = '
    <div class="write_comment" data-comment-id="' . $parent_id . '">
        <form>
            <input name="parent_id" type="hidden" value="' . $parent_id . '">
            
            <textarea name="comment" placeholder="" required></textarea>
            <button type="submit">Comment</button>
        </form>
    </div>
    ';
    return $html;
}




if (isset($post['id'])) {
    // Check if the submitted form variables exist
    if (isset( $_POST['comment'])) 
    {
        // POST variables exist, insert a new comment into the MySQL comments table (user submitted form)
        $sql='INSERT INTO comments (pid,uid, parent_id, comment, created) VALUES (:pid,:uid,:parent_id,:comment,NOW())';
        $result = $db->prepare($sql);
        $values = array(
            ':pid'      => $_POST['pid'],
            ':uid'      => $_POST['uid'],
            ':parent_id'=>$_POST['parent_id'],
            ':comment'  => strip_tags($_POST['comment'])  

          
            
            );

        $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
        exit('Your comment has been submitted!');
   
   
   
    }
  
   
    // Get all comments by the Page ID ordered by the submit date
    $sql = 'SELECT * FROM comments WHERE pid = ? ORDER BY created DESC';
    $result = $db->prepare($sql);
    $result->execute([ $post['id'] ]);
    $comments = $result->fetchAll(PDO::FETCH_ASSOC);
    
    
   
    
    
    // Get the total number of comments
    $sql = 'SELECT COUNT(*) AS total_comments FROM comments WHERE pid = ?';
    $result = $db->prepare($sql);
    $result->execute([ $post['id'] ]);
    $comments_info = $result->fetch(PDO::FETCH_ASSOC);
} 




?>


<div class="comment_header">
    <span class="total"><?php echo $comments_info['total_comments']?> Talks</span>
    <a href="#" class="write_comment_btn" data-comment-id="-1">Write Comment</a>
</div>

<?=show_write_comment_form()?>

<?=show_comments($comments)?>