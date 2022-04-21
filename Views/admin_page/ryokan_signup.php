<?php
require_once(ROOT_PATH .'Controllers/RyokanController.php');
require_once(ROOT_PATH .'Models/Ryokan.php');

include (dirname(__FILE__) . '/admin_header.php' );

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
   if (empty($_POST['image'])) {
       $err['image'] = '*画像ファイルが選択されていません。';
   }
   if (count($err) > 0) {
       $_SESSION['err'] = $err;
     }
   if (count($err) === 0) {
       header('Location: register.php');
       $ryokan = new Ryokan();
       $hasCreated = $ryokan->register($_POST);
   }
}

?>

<link rel="stylesheet" href="/css/ryokan_style.css">

         <h2>新規登録</h2>
         <form action="ryokan_signup.php" method="POST">
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
                     <input type="file" name="image" required>
                  </div>
                  <div class='up_name'>
                     <p>・旅館の名前</p>
                     <p class="alert">
                     <?php if (isset($_SESSION['err']['name'])) {
                     echo $_SESSION['err']['name'];
                     }?>
                     </p>
                     <input type="name" name="name" value='<?php echo htmlspecialchars(@$_POST['name']);?>'>
                  </div>
                  <div class='up_des'>
                     <p>・概要</p>
                     <p class="alert">
                     <?php if (isset($_SESSION['err']['description'])) {
                     echo $_SESSION['err']['description'];
                     }?>
                     </p>
                     <textarea type="name" name="description" rows='2'><?php echo htmlspecialchars(@$_POST['description']);?></textarea>
                  </div>
               </div>
               
               <div class='up_right'>
                  <div class='up_int'>
                     <p>・紹介文</p>
                     <p class="alert">
                     <?php if (isset($_SESSION['err']['introduction'])) {
                     echo $_SESSION['err']['introduction'];
                     }?>
                     </p>
                     <textarea type="name" name="introduction" rows='5'><?php echo htmlspecialchars(@$_POST['introduction']);?></textarea>
                  </div>
                  <div class='up_access'>
                     <p>・アクセス</p>
                     <p class="alert">
                     <?php if (isset($_SESSION['err']['access'])) {
                     echo $_SESSION['err']['access'];
                     }?>
                     </p>
                     <textarea type="name" name="access" rows='5'><?php echo htmlspecialchars(@$_POST['access']);?></textarea>
                  </div>  
                  <p>
                     <input class='up_post' type="submit" name="submit" value="登録する">
                  </p>    
               </div> 
            </div>   
         </form>
         <div class='up_top'>
            <a href="../main_page/main.php">トップページに戻る</a>
         </div>
    </body>
</html>