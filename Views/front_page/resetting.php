<?php
include (dirname(__FILE__) . '/header_login.php' ); 
require_once(ROOT_PATH .'/Models/User.php');

session_start();

$errs = $_SESSION;

?>

<link rel="stylesheet" href="/css/style.css">

        <div class="login_form">
            <form action="pass_completion.php" method="post">
                <div class='user_data'>
                    <div>
                        <p>名前</p>
                            <?php if(isset($errs['name'])): ?>
                                <div class="alert"><?php echo $errs['name']; ?></div>
                            <?php endif; ?>
                        <input type="text" name="name">
                    </div>
                    <div>
                        <p>メールアドレス</p>
                            <?php if(isset($errs['email'])): ?>
                                <div class="alert"><?php echo $errs['email']; ?></div>
                            <?php endif; ?>
                        <input type="mail" name="email">
                    </div>
                    <div>
                        <p>新しいパスワード</p>
                            <?php if(isset($errs['password'])): ?>
                                <div class="alert"><?php echo $errs['password']; ?></div>
                            <?php endif; ?>
                        <input type="password" name="password">
                    </div>
                    <div>
                        <p>パスワード確認</p>
                            <?php if(isset($errs['password_conf'])): ?>
                                <div class="alert"><?php echo $errs['password_conf']; ?></div>
                            <?php endif; ?>
                        <input type="password" name="password_conf">
                    </div>
                    <p>
                        <?php if(isset($errs['err_msg'])): ?>
                            <div class="alert"><?php echo $errs['err_msg']; ?></div>
                        <?php endif; ?>
                    </p>
                    <div class="button">
                        <input class="signup_pass" type="submit" name="submit" value="パスワード再設定">
                        <?php $_SESSION = array();?>
                        <a href="login.php">戻る</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>