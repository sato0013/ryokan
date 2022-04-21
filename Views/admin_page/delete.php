<?php
require_once(ROOT_PATH .'Controllers/RyokanController.php');
include (dirname(__FILE__) . '/admin_header.php' );

session_start();

$ryokan = new RyokanController();
$ryokan->ryokan_delete($_GET["id"]);
?>

<link rel="stylesheet" href="/css/ryokan_style.css">

        <div class='up_comp'>
            <h2>削除が完了しました。</h2>
            <a href="../main_page/main.php">トップページに戻る</a>
        </div>  
    </body>
</html>