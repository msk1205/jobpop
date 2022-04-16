<?php
// 1.DB接続
// 引数：なし
// 返り値：接続結果を返す
function dbConnect(){
  $dsn = 'mysql:host=localhost;dbname=jobpop;charset=utf8';
  $user = 'jobpop_user';
  $pass = 'mskitty1412';

  try {
    $dbh = new PDO($dsn, $user, $pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES => false,
    ]);

  } catch(PDOException $e){
    echo '接続失敗'. $e->getMessage();
    exit();
  }
  return $dbh;
}

?>
