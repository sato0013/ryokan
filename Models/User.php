<?php
require_once(ROOT_PATH .'/Models/Db.php');

class User extends Db {
    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }

    //ユーザを登録する
    public function createUser($userData) {
        $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

        // ユーザデータを配列に入れる
        $arr = [];
        $arr[] = $userData['name'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);

        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($arr);
            return true;
        } catch(\Exception $e) {
            echo $e; // エラーを出力
            return false;
        }
    }

    //emailからユーザを取得
    public function loginEmail($email) {
        $sql = 'SELECT * FROM users WHERE email = :email';
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':email', $email, PDO::PARAM_STR);
            $sth->execute();
            $user = $sth->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (\Exception $e) {
            return false;
        }
    }

    //ログイン処理
    public function login($email, $password) {
        $result = false;
        //ユーザをemailから検索して取得
        $user = $this->loginEmail($email);

        if (!$user) {
            $_SESSION['msg'] = '*メールアドレスまたはパスワードが違います。';
            return $result;
        }

        //パスワード照会
        if (password_verify($password, $user['password'])) {
        // ログイン成功
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        } else {
            $_SESSION['msg'] = 'メールアドレスまたはパスワードが違います。';
            return $result;//false
        }
    }

    public function checkLogin() {
        $result = false;
    
        // セッションにログインユーザが入っていなかったらfalse
        if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
          return $result = true;
        }
    
        return $result;
    
      }

    //パスワードを再設定
    public function update_pass($name, $email, $password) {
        $result = false;

        //ユーザをemailから検索して取得
        $user = $this->loginEmail($email);

        if (!$user) {
            $_SESSION['err_msg'] = '*名前またはメールアドレスが違います。';
            return $result;
        } elseif ($user['name'] !== $name) {
            $_SESSION['err_msg'] = '*名前またはメールアドレスが違います。';
            return $result;
        }

        $pass = $this->pass($user['id'], $password);
    }   

    //パスワードをアップデート
    public function pass($id, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $sql = 'UPDATE users SET password = :password WHERE id = :id';
            $sth = $this->dbh->prepare($sql);
            $sth->BindParam(":id",$id, PDO::PARAM_INT);
            $sth->BindParam(":password",$hashed_password, PDO::PARAM_STR);
            $result = $sth->execute();
            return $result;
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
    }
}