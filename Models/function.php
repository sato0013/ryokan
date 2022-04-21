<?php
require_once(ROOT_PATH .'/Models/Db.php');

class post extends Db {
    public function __construct($dbh = null) {
      parent::__construct($dbh);
    }
    
    function getPostData($n_id){
        //echo '投稿情報を取得します。';
        //echo '投稿ID：'.$n_id;
        try{
            $sql = 'SELECT * FROM ryokan WHERE id = :n_id'; 
            $data = array(':n_id' => $n_id);
            // クエリ実行
            $sth = $this->dbh->prepare($sql);
            $sth->execute($data);
    
            if($sth){
                return $sth->fetch(PDO::FETCH_ASSOC);
            }else{
                return false;
            }
        }catch(Exception $e){
            error_log('エラー発生：'.$e->getMessage());
        }
    }

    function getGood($n_id){
        //echo ' いいねを取得します';
        try {
            $sql = 'SELECT name_id FROM good WHERE name_id = :n_id';
            $data = array(':n_id' => $n_id);
            // クエリ実行
            $sth = $this->dbh->prepare($sql);
            $sth->execute($data);
            
            if($sth){
                return $sth->fetchAll();
            }else{
                return false;
            }
        } catch (Exception $e) {
            error_log('エラー発生：'.$e->getMessage());
        }
    }

    function isGood($u_id, $n_id){
        //echo('いいねした情報があるか確認');
        //echo('ユーザーID'.$u_id);
        //echo('投稿ID：'.$n_id);
    
        try {
            $sql = 'SELECT * FROM good WHERE name_id = :n_id AND user_id = :u_id';
            $data = array(':u_id' => $u_id, ':n_id' => $n_id);
            // クエリ実行
            $sth = $this->dbh->prepare($sql);
            $sth->execute($data);
    
            if($sth->rowCount()){
                //debug('お気に入りです');
                return true;
            }else{
                //debug('特に気に入ってません');
                return false;
            }
    
        } catch (Exception $e) {
            error_log('エラー発生:' . $e->getMessage());
        }
    }

    /**
     * いいねした投稿をマイページに表示する
     */
    public function mypost($u_id) {
        try {
            $sql ='SELECT r.id, r.name, r.image FROM ryokan AS r INNER JOIN good AS g ON r.id = g.name_id WHERE g.user_id = :u_id';
            $data = array(':u_id' => $u_id);
            $sth = $this->dbh->prepare($sql);
            $sth->execute($data);

            if($sth){
                return $sth->fetchAll();
            }else{
                return false;
            }
        } catch (Exception $e) {
            error_log('エラー発生：'.$e->getMessage());
        }
    }
}

?>