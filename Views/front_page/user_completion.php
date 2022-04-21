<?php
include (dirname(__FILE__) . '/header_login.php' ); 

require_once(ROOT_PATH .'/Models/User.php');

session_start();

//バリデーション
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $err = [];
  if(!$name = filter_input(INPUT_POST, 'name')) {
      $err['name'] = '*名前を入力してください。';
    }
  if(!$email = filter_input(INPUT_POST, 'email')) {
    $err['email'] = '*メールアドレスを入力してください。';
  }
  $password = filter_input(INPUT_POST, 'password');
  // 正規表現
  if (!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)) {
    $err['password'] = '*パスワードは英数字8文字以上で入力してください。';
  }
  $password_conf = filter_input(INPUT_POST, 'password_conf');
  if ($password !== $password_conf) {
    $err['password_conf'] = '*パスワードが異なっています。';
  }
}

if (count($err) > 0) {
  $_SESSION = $err;
  header('Location: signup.php');
  return;
}

if (count($err) === 0) {
  // ユーザを登録する処理
  $user = new User();
  $hasCreated = $user->createUser($_POST);
}
//登録失敗時の処理
if (!$hasCreated) {
  header('Location: signup.php');
  return;
}
?>

<link rel="stylesheet" href="/css/style.css">

        <div class='login_form'>
          <section class="comp">
              <h2>新規登録が完了しました。</h2>
              <div>
                  <a href="login.php">ログイン画面に戻る</a>
              </div>
          </section>
        </div>
        
    </body>
</html>
