<?php
session_start();

if(isset($_SESSION['login_user']["role"]) && (!$_SESSION['login_user']["role"] == 1)) {
  include (dirname(__FILE__) . '/header.php' ); 
} else {
  include (dirname(__FILE__, 2) . '/admin_page/admin_header.php' ); 
}

require_once(ROOT_PATH .'Controllers/RyokanController.php');
$ryokan_all = new RyokanController();
$paramas = $ryokan_all->index();
$ryokan = $paramas['miyazaki'];
?>

<link rel="stylesheet" href="/css/ryokan_style.css">

        <div class='ryokan_titel'>
          <h2>宮崎県の温泉旅館</h2>
          <?php if(isset($_SESSION['login_user']["role"]) && (!$_SESSION['login_user']["role"] == 0)):?>
          <div class='ryokan_register'>
           <a href="../admin_page/ryokan_signup.php">新規登録はこちら</a>
          </div>
          <?php endif; ?>  
        </div>      
        <?php foreach($ryokan as $inf): ?>
          <div class='ryokan_data'>
          <p><img class='ryokan_img' src="/img/<?=$inf['image']; ?>" alt="旅館の画像"></p>
            <div class='ryokan_inf'>
              <p class='ryokan_name'><?=$inf['name'] ?></p>
              <p class='ryokan_des'><?=$inf['description'] ?></p>
              <a class='ryokan_detail' href="detail.php?id=<?=$inf['id'] ?>">詳細はこちら</a>
            </div>       
          </div>
        <?php endforeach; ?>     
        <a class='return' href="main.php">戻る</a>
    </body>
</html>