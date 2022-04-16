<?php
session_start();

$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;


$referer = $_SERVER["HTTP_REFERER"];
$url = 'confirm.php';
if(!strstr($referer,$url)){
  header('Location: contact.php');
 exit;
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>JOBPOPお問い合わせ</title>
<link rel="stylesheet" type="text/css" href="css/base.css?v=2">
<link rel="stylesheet" type="text/css" href="css/complete.css?v=2">
<script type="text/javascript" src="js/jquery.js"></script>

</head>
<body>
<div id="wrapper">

<?php
require("headder.php");
?>


  <div id="contents" class="clearfix">
    <p class="complete">お問い合わせが完了いたしました。</p>
    <a class="complete_link" href="home.php">トップへ戻る</a>
  </div>


<?php
require("footer.php");
?>
</div>



</body>
</html>
