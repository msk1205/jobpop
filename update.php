<?php
$referer = $_SERVER["HTTP_REFERER"];
$url = 'edit_form.php';
if(!strstr($referer,$url)){
  header('Location: contact.php');
 exit;
}

$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
  // 生成したトークンをセッションに保存
$_SESSION['csrf_token'] = $csrf_token;


// @param string $str 対象の文字列
// @returnstring 処理された文字列
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


$id = h($_POST['id']);
$name = h($_POST['name']);
$kana = h($_POST['kana']);
$tel =  h($_POST['tel']);
$email = h($_POST['email']);
$body = h($_POST['content']);



// 1.DB接続
require("dbc.php");


$sql = "UPDATE contacts SET name=:name, kana=:kana, tel=:tel, email=:email, body=:body WHERE id = :id";


$dbh = dbConnect();

try {
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':kana', $kana, PDO::PARAM_STR);
  $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':body', $body, PDO::PARAM_STR);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);

  $stmt->execute();

  header("Location: contact.php");
  exit;

  } catch(PDOException $e) {
  exit($e);
}


?>
