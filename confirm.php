<?php
session_start();

$referer = $_SERVER["HTTP_REFERER"];
$url = 'contact.php';
if(!strstr($referer,$url)){
  header('Location: complete.php');
 exit;
}


// @param string $str 対象の文字列
// @returnstring 処理された文字列
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>JOBPOPお問い合わせ</title>
<link rel="stylesheet" type="text/css" href="css/base.css?v=2">
<link rel="stylesheet" type="text/css" href="css/confirm.css?v=2">
<script type="text/javascript" src="js/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<body>
<div id="wrapper">

<?php
require("headder.php");
?>


  <div id="comfirm_form" class="clearfix">
    <form action="contact.php" method="post">


      <div class="form-wrap">
        <div class="form-content">
            <p>氏名：<?php echo isset($_POST['name']) ? h($_POST['name']) : '';?></p>
        </div>

        <div class="form-content">
            <p>フリガナ：<?php echo isset($_POST['kana']) ? h($_POST['kana']) : '';?></p>
        </div>

        <div class="form-content">
            <p>電話番号：<?php echo isset($_POST['tel']) ? h($_POST['tel']) : '';?></p>
        </div>

        <div class="form-content">
            <p>メールアドレス：<?php echo isset($_POST['email']) ? h($_POST['email']) : '';?></p>
        </div>

        <div class="form-content">
            <p class="space">お問い合わせ内容：<br><?php echo isset($_POST['content']) ? h($_POST['content']) : '';?></p>
        </div>
      </div>

      <input type="hidden" name="name" value="<?php echo h($_POST['name']);?>">
      <input type="hidden" name="kana" value="<?php echo h($_POST['kana']);?>">
      <input type="hidden" name="tel" value="<?php echo h($_POST['tel']);?>">
      <input type="hidden" name="email" value="<?php echo h($_POST['email']);?>">
      <input type="hidden" name="content" value="<?php echo h($_POST['content']);?>">


      <p class="check"><br>これでよろしいですか？</p>

      <input class="return-btn" type="submit" name="submit" value="戻る">
    </form>
  </div>


  <div>
    <form method="post" action="complete.php">
      <input type="hidden" name="name" value="<?php echo h($_POST['name']);?>">
      <input type="hidden" name="kana" value="<?php echo h($_POST['kana']);?>">
      <input type="hidden" name="tel" value="<?php echo h($_POST['tel']);?>">
      <input type="hidden" name="email" value="<?php echo h($_POST['email']);?>">
      <input type="hidden" name="content" value="<?php echo h($_POST['content']);?>">

      <div id="btn">
        <input type="submit" name="submit" value="送信" id="submit_btn">
      </div>
    </form>
  </div>

<?php
require("footer.php");
?>
</div>
</body>
</html>
