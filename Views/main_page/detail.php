<?php
session_start();
require_once(ROOT_PATH .'/Models/function.php');
require_once(ROOT_PATH .'Controllers/RyokanController.php');
$ryokan = new RyokanController();
$params = $ryokan->view();
$ryokan = $params['ryokan'];

$n_id = '';
$dbPostData = ''; 
$dbPostGoodNum = ''; 

if(!empty($_GET['id'])){
  // 投稿IDのGETパラメータを取得
  $n_id = $_GET['id'];
  // DBから投稿データを取得
  $data = new post();
  $dbPostData = $data->getPostData($n_id);
  // DBからいいねの数を取得
  $dbPostGoodNum = count($data->getGood($n_id));
}

if(isset($_SESSION['login_user']["role"]) && (!$_SESSION['login_user']["role"] == 1)) {
  include (dirname(__FILE__) . '/header.php' ); 
} else {
  include (dirname(__FILE__, 2) . '/admin_page/admin_header.php' ); 
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/js/script.js"></script>
<link rel="stylesheet" href="/css/ryokan_style.css">
<link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">


    <h2>旅館詳細情報</h2>
    <div class='detail_data'>
      <img class='detail_img' src="/img/<?=$ryokan['image']; ?>" alt="旅館の画像">
      <div class='detail_inf'>
        <p class='detail_name'><?=$ryokan['name'] ?></p>
        <p class='detail_int_label'>・旅館の紹介</p>
        <p class='detail_int'><?=$ryokan['introduction'] ?></p>
        <p class='detail_access_label'>・アクセス</p>
        <p class='detail_access'><?=$ryokan['access'] ?></p>
        <?php if(isset($_SESSION['login_user']["role"]) && ($_SESSION['login_user']["role"] == 1)):?>
          <div class='operation'>
            <a class='edit' href="../admin_page/edit.php?id=<?=$ryokan['id'] ?>">編集</a>
            <a class="delete" href="../admin_page/delete.php?id=<?=$ryokan['id'] ?>">削除</a>
          </div>
        <?php elseif(isset($_SESSION['login_user']["role"]) && ($_SESSION['login_user']["role"] == 0)):?>
          <section class="post" data-postid="<?php echo $n_id; ?>">
            <div class="btn-good <?php if($data->isGood($_SESSION['login_user']['id'], $dbPostData['id'])) echo 'active'; ?>">
              <!-- 自分がいいねした投稿にはハートのスタイルを常に保持する -->
              <i class="fa-heart fa-lg px-16
                <?php
                  if($data->isGood($_SESSION['login_user']['id'],$dbPostData['id'])){ //いいね押したらハートが塗りつぶされる
                      echo ' active fas';
                  }else{ //いいねを取り消したらハートのスタイルが取り消される
                      echo ' far';
                  }; ?>">
              </i>
              <span class='iine_count'><?php echo $dbPostGoodNum ?></span>
            </div>
          </section>
        <?php endif; ?>
      </div>
    </div>
    
    <?php if (!empty($_SERVER['HTTP_REFERER'])) : ?>
      <a class='detail_return' href="<?php echo $_SERVER['HTTP_REFERER']; ?>">戻る</a>
    <?php endif; ?>
  </body>
</html>