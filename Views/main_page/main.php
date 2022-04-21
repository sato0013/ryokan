<?php
session_start();
require_once(ROOT_PATH .'/Models/User.php');

unset($_SESSION['err']);

//バリデーション
if (!isset($_SESSION['login_user'])) {
  $err = [];
  if (!$email = filter_input(INPUT_POST, 'email')) {
    $err['login_email'] = '*メールアドレスを入力してください。';
  }
  if (!$password = filter_input(INPUT_POST, 'password')) {
    $err['login_password'] = '*パスワードを入力してください。';
  }
  
  if (count($err) > 0) {
    $_SESSION = $err;
    header('Location: ../front_page/login.php');
    return;
  }

  //ログイン成功時の処理
  $user = new User();
  $result = $user->login($email, $password);
  //ログイン失敗時の処理
  if (!$result) {
    header('Location: ../front_page/login.php');
    return;
  }
}

if(isset($_SESSION['login_user']["role"]) && (!$_SESSION['login_user']["role"] == 1)) {
  include (dirname(__FILE__) . '/header.php' ); 
} else {
  include (dirname(__FILE__, 2) . '/admin_page/admin_header.php' ); 
}
?>

<link rel="stylesheet" href="/css/main_style.css">

        <p class="heading">各県をクリックして温泉旅館を探しましょう</p>
        <div class='map'>
          <ul class='map_list'>
            <li class='map_hukuoka'><a href="hukuoka.php">福岡県</a></li>
            <li class='map_hukuoka_sub'><div class='hukuoka_line'></div></li>
            <li class='map_saga'><a href="saga.php">佐賀県</a><div class='saga_line'></div></li>
            <li class='map_nagasaki'><a href="nagasaki.php">長崎県</a><div class='nagasaki_line'></div></li>
            <li class='map_kumamoto'><a href="kumamoto.php">熊本県</a><div class='kumamoto_line'></div></li>
            <li class='map_oita'><a href="oita.php">大分県</a></li>
            <li class='map_oita_sub'><div class='oita_line'></div></li>
            <li class='map_miyazaki'><a href="miyazaki.php">宮崎県</a></li>
            <li class='map_miyazaki_sub'><div class='miyazaki_line'></div></li>
            <li class='map_kagosima'><a href="kagosima.php">鹿児島県</a><div class='kagosima_line'></div></li>
          </ul>
          <ul class='map_eng'>
            <li class='map_hukuoka_eng'><a href="hukuoka.php">Fukuoka</a></li>
            <li class='map_saga_eng'><a href="saga.php">Saga</a></li>
            <li class='map_nagasaki_eng'><a href="nagasaki.php">Nagasaki</a></li>
            <li class='map_kumamoto_eng'><a href="kumamoto.php">Kumamoto</a></li>
            <li class='map_oita_eng'><a href="oita.php">Oita</a></li>
            <li class='map_miyazaki_eng'><a href="miyazaki.php">Miyazaki</a></li>
            <li class='map_kagosima_eng'><a href="kagosima.php">Kagosima</a></li>
          </ul>
        </div>
        <div class='main_img'>
          <img src="../../img/kyuusyuu.png" alt="">
        </div>
    </body>
</html>