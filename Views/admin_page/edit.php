<?php
require_once(ROOT_PATH .'Controllers/RyokanController.php');
include (dirname(__FILE__) . '/admin_header.php' );

session_start();

$ryokan = new RyokanController();
$params = $ryokan->view();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $err = [];
    if (empty($_POST['name'])) {
        $err['name'] = '*名前を入力してください。';
    } 
    if (empty($_POST['description'])) {
        $err['description'] = '*概要を入力してください。';
    } 
    if (empty($_POST['introduction'])) {
        $err['introduction'] = '*紹介文を入力してください。';
    } 
    if (empty($_POST['access'])) {
        $err['access'] = '*アクセス情報を入力してください。';
    } 
    if (count($err) === 0) {
        $ryokan->editUp();
        header('Location: edit_comp.php');
        exit();
      }
}
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="/js/edit_script.js"></script>
<link rel="stylesheet" href="/css/ryokan_style.css">

        <h2>各種編集</h2>
        <form  action="edit.php?id=<?=$_GET['id']?>" method="post">
            <input type="hidden" name=id value =<?= $params['ryokan']["id"] ?>>
            <div class='up_data'>
                <div class='up_left'>
                    <div class='up_pre'>
                        <p>・旅館のある県名</p>
                        <select name="prefectures">
                            <option value="福岡県">福岡県</option>
                            <option value="大分県">大分県</option>
                            <option value="佐賀県">佐賀県</option>
                            <option value="長崎県">長崎県</option>
                            <option value="熊本県">熊本県</option>
                            <option value="宮崎県">宮崎県</option>
                            <option value="鹿児島県">鹿児島県</option>
                        </select>
                    </div>
                    <div class='up_img'>
                        <p>・旅館の写真</p>
                        <label>
                        <input type="file" id="myImage" name="image" required>
                        <img id="preview">
                        </label>   
                        <p class='up_selection'>*写真は再選択して下さい</p>
                    </div>
                    <div class='up_name'>
                        <p>・旅館の名前</p>
                        <p class="alert">
                        <?php if (isset($err['name'])) {
                        echo $err['name'];
                        }?>
                        </p>
                        <input type="text" name="name" value="<?php if (isset($_POST['name'])) {
                        echo $_POST['name'];
                        } else {
                            echo $params['ryokan']['name'];
                        }?>">
                    </div>
                    <div class='up_des'>
                        <p>・概要</p>
                        <p class="alert">
                        <?php if (isset($err['description'])) {
                        echo $err['description'];
                        }?>
                        </p>
                        <textarea type="text" name="description" wrap="soft"><?php if (isset($_POST['description'])) {
                        echo $_POST['description'];
                        } else {
                            echo $params['ryokan']['description'];
                        }?></textarea>
                    </div>
                </div>
                
                <div class='up_right'>
                    <div class='up_int'>
                        <p>・紹介文</p>
                        <p class="alert">
                        <?php if (isset($err['introduction'])) {
                        echo $err['introduction'];
                        }?>
                        </p>
                        <textarea type="text" name="introduction"><?php if (isset($_POST['namintroductione'])) {
                        echo $_POST['introduction'];
                        } else {
                            echo $params['ryokan']['introduction'];
                        }?></textarea>
                    </div>
                    <div class='up_access'>
                        <p>・アクセス</p>
                        <p class="alert">
                        <?php if (isset($err['access'])) {
                        echo $err['access'];
                        }?>
                        </p>
                        <textarea type="text" name="access"><?php if (isset($_POST['access'])) {
                        echo $_POST['access'];
                        } else {
                            echo $params['ryokan']['access'];
                        }?></textarea>
                    </div>   
                    <p>
                        <input class='up_post' class="edit" type="submit" name="submit" value="更新">
                    </p>
                </div>
                
            </div>
        </form>
        <div class='up_top'>
            <a href="../main_page/main.php">トップページに戻る</a>
        </div>      
    </body>
</html>