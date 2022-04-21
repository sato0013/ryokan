<?php
session_start();
include (dirname(__FILE__) . '/header.php' ); 
require_once(ROOT_PATH .'/Models/function.php');

if(!isset($_SESSION['login_user'])) {
    header('Location: /front_page/login.php');
}

$u_id = '';

if(!empty($_SESSION['login_user']['id'])){
    $u_id = $_SESSION['login_user']['id'];
    $post = new post();
    $mypost_data = $post->mypost($u_id);
}
?>

<link rel="stylesheet" href="/css/ryokan_style.css">

        <h2>いいねした旅館一覧</h2>
        <div class='mypost'>
            <?php foreach($mypost_data as $data):?>
            <div class='mypost_data'>
                <p class='mypost_name'><?php echo $data['name'];?></p>
                <img class='mypost_img' src="/img/<?=$data['image']; ?>" alt="旅館の画像">
            </div>
            <?php endforeach;?>
        </div>
        <a class='mypost_return' href="main.php">戻る</a>
    </body>
</html>