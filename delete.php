<?php
$referer = $_SERVER["HTTP_REFERER"];
$url = 'contact.php';
if(!strstr($referer,$url)){
  header('Location: contact.php');
 exit;
}


// 1.DB接続
require("dbc.php");

$dbh = dbConnect();

// idを取得
$id = $_GET['id'];

// idが空の場合、リダイレクト
if(empty($id)){
  exit('IDが不正です。');
}


// SQLの準備
$sql = "DELETE FROM contacts WHERE id = $id";
// クエリ実行（データを取得）
$res = $dbh->query($sql);

$res = null;
$dbh = null;
header('Location: ./contact.php');


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="chrome">
  <link rel="stylesheet" type="text/css" href="css/home.css?v=2">
  <link rel="stylesheet" type="text/css" href="css/delete.css?v=2">
  <title>JOBPOP削除</title>
</head>
  <body>
    <?php
    require("headder.php");
    ?>

    <div id="db_delete">
      <table>
        <h3>削除が完了しました。</h3>
        <a class="complete_link" href="home.php">トップへ戻る</a>
      </table>
    </div>


  </body>
</html>
