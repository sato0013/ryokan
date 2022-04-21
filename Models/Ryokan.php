<?php
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/Models/function.php');

class Ryokan extends Db {
    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }

    /**
     * ryokanテーブルから福岡県のデータを取得
     */
    public function hukuoka_inf($page = 0) {
      $sql = 'SELECT * FROM ryokan WHERE prefectures = "福岡県"';
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    /**
     * ryokanテーブルから大分県のデータを取得
     */
    public function oita_inf($page = 0) {
      $sql = 'SELECT * FROM ryokan WHERE prefectures = "大分県"';
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    /**
     * ryokanテーブルから佐賀県のデータを取得
     */
    public function saga_inf($page = 0) {
      $sql = 'SELECT * FROM ryokan WHERE prefectures = "佐賀県"';
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    /**
     * ryokanテーブルから長崎県のデータを取得
     */
    public function nagasaki_inf($page = 0) {
      $sql = 'SELECT * FROM ryokan WHERE prefectures = "長崎県"';
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    /**
     * ryokanテーブルから熊本県のデータを取得
     */
    public function kumamoto_inf($page = 0) {
      $sql = 'SELECT * FROM ryokan WHERE prefectures = "熊本県"';
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    /**
     * ryokanテーブルから宮崎県のデータを取得
     */
    public function miyazaki_inf($page = 0) {
      $sql = 'SELECT * FROM ryokan WHERE prefectures = "宮崎県"';
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    /**
     * ryokanテーブルから鹿児島県のデータを取得
     */
    public function kagosima_inf($page = 0) {
      $sql = 'SELECT * FROM ryokan WHERE prefectures = "鹿児島県"';
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    /**
     * ryokanテーブルから全データ数を取得
     */
    public function countAll():Int {
      $sql = 'SELECT count(*) as count FROM ryokan';
      $sth = $this->dbh->prepare($sql);
      $sth->execute();
      $count = $sth->fetchColumn();
      return $count;
    }

    /**
     * ryokanテーブルから指定のidに一致するデータを取得
     */
    public function findById($id = 0):Array {
      $sql = 'SELECT * FROM ryokan';
      $sql .= ' WHERE id = :id';
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->execute();
      $result = $sth->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    /**
     * 旅館の情報を編集する
     */
    public function update($id) {
      try {
        $sql = 'UPDATE ryokan SET name = :name, prefectures =:prefectures, description = :description, introduction = :introduction, 
        access = :access, image = :image WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->BindParam(":id",$_POST['id'], PDO::PARAM_INT);
        $sth->BindParam(":name",$_POST['name'], PDO::PARAM_STR);
        $sth->BindParam(":prefectures",$_POST['prefectures'], PDO::PARAM_STR);
        $sth->BindParam(":description",$_POST['description'], PDO::PARAM_STR);
        $sth->BindParam(":introduction",$_POST['introduction'], PDO::PARAM_STR);
        $sth->BindParam(":access",$_POST['access'], PDO::PARAM_STR);
        $sth->BindParam(":image",$_POST['image'], PDO::PARAM_STR);
        $result = $sth->execute();
        return $result;
      } catch(PDOException $e) {
        echo $e->getMessage();
      }
    }

    /**
     * 旅館を登録する
     */
    public function register($ryokanData) {
      $sql = 'INSERT INTO ryokan(name, prefectures, description, introduction, access, image) VALUES (?, ?, ?, ?, ?, ?)';
      $sth = $this->dbh->prepare($sql);

      $arr = [];
      $arr[] = $ryokanData['name'];
      $arr[] = $ryokanData['prefectures'];
      $arr[] = $ryokanData['description'];
      $arr[] = $ryokanData['introduction'];
      $arr[] = $ryokanData['access'];
      $arr[] = $ryokanData['image'];

      try {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($arr);
        return true;
      } catch(PDOException $e) {
      echo $e->getMessage();
      }
    }

    /**
     * 旅館の登録を削除する
     */
    public function delete() {
      try {
        $sql = 'DELETE FROM ryokan WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':id', (int)$_GET['id'], \PDO::PARAM_INT);
        $result = $sth->execute();
        return $result;
      } catch (PDOException $e) {
        echo $e->getMessage();
      } 
    }
  }
?>