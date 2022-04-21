<?php
require_once(ROOT_PATH .'/database.php');

class Db {
  protected $dbh;

  public function __construct($dbh = null) {
    if(!$dbh) {
      try {
        $this->dbh = new PDO(
          'mysql:dbname='.DB_NAME.
          ';host='.DB_HOST, DB_USER, DB_PASSWD
        );
      } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
      }
    } else {
      $this->dbh = $dbh;
    }
  }
}

function dbConnect(){
  $dsn = 'mysql:dbname=ryokan;host=localhost;charset=utf8';
	$user = 'root';
	$password = 'stsk0313';
	$options = array(
		// SQL実行失敗時にはエラーコードのみ設定
		PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
		// デフォルトフェッチモードを連想配列形式に設定
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		// バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
		// SELECTで得た結果に対してもrowCountメソッドを使えるようにする
		PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
	);
	// PDOオブジェクト生成（DBへ接続）
	$dbh = new PDO($dsn, $user, $password, $options);
	return $dbh;
}
?>
