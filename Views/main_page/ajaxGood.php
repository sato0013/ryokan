<?php
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/Models/function.php');

session_start();

if(isset($_POST['postId'])){
    $n_id = $_POST['postId'];
}

$post = new post();
$count_id = $post->getGood($n_id);
try {
    $dbh = dbConnect();
    $sql = 'SELECT * FROM good WHERE user_id = :u_id AND name_id = :n_id';
    $data = array(':u_id' => $_SESSION['login_user']['id'], ':n_id' => $n_id);
    $sth = $dbh->prepare($sql);
    $sth->execute($data);
    $result = $sth->rowCount();

    if(!empty($result)) {
    $sql = 'DELETE FROM good WHERE user_id = :u_id AND name_id = :n_id';
    $data = array(':u_id' => $_SESSION['login_user']['id'], ':n_id' => $n_id);
    $sth = $dbh->prepare($sql);
    $sth->execute($data);
    echo count($post->getGood($n_id));
    } else {        
        $sql = 'INSERT INTO good (user_id, name_id, created_at) VALUES (:u_id, :n_id, :date)';
        $data = array(':u_id' => $_SESSION['login_user']['id'], ':n_id' => $n_id, ':date' => date('Y-m-d H:i:s'));
        $sth = $dbh->prepare($sql);
        $sth->execute($data);
        echo count($post->getGood($n_id));
    } 
} catch (PDOException $e) {
    echo $e->getMessage();
}  

?>