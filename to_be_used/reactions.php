 <?php 
  function get ($pid, $uid) {
  get() : get post likes & dislikes
  // PARAM $postID : the post ID
  //       $userID : optional, get the user's reaction to the post

    $sql = "SELECT `reaction`, COUNT(`reaction`) `total` FROM `reactions` WHERE `post_id`=? GROUP BY `reaction`";
    $data = [$postID];

    // This will arrange the number of likes & dislikes by their code
    // Example $total[0] = 123, $total[1] = 456 - There are 123 dislikes and 456 likes
    $total = $this->fetch($sql, $data, "reaction", "total");

    // Optional - Get user's reaction to the post
    // This will append the user's reaction to $total
    // Example, if the user likes the post $total['u'] = 1
    if (is_numeric($userID)) {
      $previous = $this->previous($postID, $userID);
      if ($previous!=false) {
        $total['u'] = $previous['reaction'];
      }
    }

    return $total;
  }

  function previous ($postID, $userID) {
  // previous() : get give user's previous reaction to the post

    $sql = "SELECT * FROM `reactions` WHERE `post_id`=? AND `user_id`=?";
    $data = [$postID, $userID];
    $previous = $this->fetch($sql, $data);
    return count($previous)==0 ? false : $previous[0] ;
  }

  function update ($postID, $userID, $react) {
  // update() : update user reaction to post

    // Get previous reaction
    $previous = $this->previous($postID, $userID);

    // No previous reaction - add new
    if ($previous==false) {
      return $this->add($postID, $userID, $react);
    } else {
      // Remove old reaction first
      $pass = $this->remove($postID, $userID);

      // Add new reaction only if it is different from the previous
      if ($pass && $previous['reaction']!=$react) {
        $pass = $this->add($postID, $userID, $react);
      }

      // Return result
      return $pass;
    }
  }

  function add ($postID, $userID, $react) {
  // add() : add a new reaction

    $sql = "INSERT INTO `reactions` (`post_id`, `user_id`, `reaction`) VALUES (?, ?, ?)";
    $data = [$postID, $userID, $react];
    return $this->exec($sql, $data);
  }

  function remove ($postID, $userID) {
  // remove() : remove reaction

    $sql = "DELETE FROM `reactions` WHERE `post_id`=? AND `user_id`=?";
    $data = [$postID, $userID];
    return $this->exec($sql, $data);
  }
}
?>