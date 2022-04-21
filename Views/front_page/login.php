<?php
include (dirname(__FILE__) . '/header_login.php' ); 
require_once(ROOT_PATH .'/Models/User.php');

session_start();
unset($_SESSION['login_user']);

$err = $_SESSION;

$_SESSION = array();
session_destroy();

?>

<link rel="stylesheet" href="/css/style.css">

        <div class="login_form">
            <form action="../main_page/main.php" method="post">
                <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                <div class='user_data'>
                    <div class='user_email'>
                        <p>メールアドレス</p>
                            <?php if(isset($err['login_email'])): ?>
                                <div class="alert"><?php echo $err['login_email']; ?></div>
                            <?php endif; ?>
                        <input type="mail" name="email">
                    </div>
                    <div>
                        <p>パスワード</p>
                            <?php if(isset($err['login_password'])): ?>
                                <div class="alert"><?php echo $err['login_password']; ?></div>
                            <?php endif; ?>
                        <input type="password" name="password">
                    </div>
                    <p>
                        <?php if(isset($err['msg'])): ?>
                            <div class="alert"><?php echo $err['msg']; ?></div>
                        <?php endif; ?>
                    </p>
                    <div class='signup'>
                        <input class="login_button" type="submit" value="ログイン">
                        <a href="signup.php">新規登録</a>
                    </div>
                    <div class="reset">
                        <a href="resetting.php">パスワードを忘れた方はこちら</a>
                    </div>
                </div>
                      
            </form>
        </div>
    </body>
</html>