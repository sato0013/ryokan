<?php

include (dirname(__FILE__) . '/header_login.php' ); 
require_once(ROOT_PATH .'/Models/User.php');

session_start();

$err = $_SESSION;

?>

<link rel="stylesheet" href="/css/style.css">

        <div class="login_form">
            <form action="user_completion.php" method="post">
                <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                <div class='user_data'>
                    <div>
                        <p>名前</p>
                            <?php if(isset($err['name'])): ?>
                                    <div class="alert"><?php echo $err['name']; ?></div>
                                <?php endif; ?>
                            <input type="text" name="name">
                    </div>
                    <div>
                        <p>メールアドレス</p>
                            <?php if(isset($err['email'])): ?>
                                <div class="alert"><?php echo $err['email']; ?></div>
                            <?php endif; ?>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <p>パスワード</p>
                            <?php if(isset($err['password'])): ?>
                                <div class="alert"><?php echo $err['password']; ?></div>
                            <?php endif; ?>
                        <input type="password" name="password">
                    </div>
                    <div>
                        <p>パスワード確認</p>
                            <?php if(isset($err['password_conf'])): ?>
                                <div class="alert"><?php echo $err['password_conf']; ?></div>
                            <?php endif; ?>
                        <input type="password" name="password_conf">
                    </div>
                    <div class="button">
                        <input class="signup_button" type="submit" name="submit" value="登録する">  
                        <a href="login.php">戻る</a>
                    </div>
                </div>       
            </form>
        </div>
    </body>
</html>
