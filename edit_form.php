<?php
$referer = $_SERVER["HTTP_REFERER"];
$url = 'contact.php';
if(!strstr($referer,$url)){
  header('Location: update.php');
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


// idを取得
$id = $_GET['id'];

// idが空の場合、リダイレクト
if(empty($id)){
  header("Location: contact.php");
  exit;
}


// 1.DB接続
require("dbc.php");

$dbh = dbConnect();


// id取得
$id = $_GET['id'];

if(empty($id)){
  exit('IDが不正です。');
}


try{
  // SQLの準備
  $sql = "SELECT * FROM contacts WHERE id = :id";
  // クエリ実行（データを取得）
  $stmt = $dbh->prepare($sql);
  $stmt->bindvalue(':id', (int)$id, PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  // idが存在しない場合、リダイレクト
  if (!$result) {
    header("Location: ./contact.php");
    exit;
  }

  // カラムの値をそれぞれ変数に代入
  $name = h($result['name']);
  $kana = h($result['kana']);
  $tel = h($result['tel']);
  $email = h($result['email']);
  $body = h($result['body']);

  } catch(PDOException $e) {
  exit($e);
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="chrome">
  <link rel="stylesheet" type="text/css" href="css/dbc.css?v=2">
  <link rel="stylesheet" type="text/css" href="css/update.css?v=2">
  <title>JOBPOP更新</title>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


  <script>
  $(function(){
    //  氏名
    $("#submit_btn").on('click',function(){
      if($(".name").val() === ''){
        $(".required-name").html('氏名は必須項目です*');
        return false;
      }else{
        $(".required-name").html('');
      }

      if($(".name").val().length >= 10){
        $(".count-name").html('*10文字以内で入力してください');
        return false;
      }else{
        $(".count-name").html('');
      }
    });

    //  フリガナ
    $("#submit_btn").on('click',function(){
      if($(".kana").val() === ''){
        $(".required-kana").html('*フリガナは必須項目です');
        return false;
      }else{
        $(".required-kana").html('');
      }

      if($(".kana").val().length >= 10){
        $(".count-kana").html('*10文字以内で入力してください');
        return false;
      }else{
        $(".count-kana").html('');
      }
    });

    //  電話番号
    $("#submit_btn").on('click', function(){
      if(!$("input[name = 'tel']").val().trim() == ""){
        if(!$("input[name = 'tel']").val().match(/^[0-9０-９]+$/)){
          $(".error-tel").html("*数字で入力してください");
          return false;
        }
      }else if($("input[name = 'name']").val().trim() == ""){
        $(".error-tel").html('');
      }
    });


    //  メールアドレス
    $("#submit_btn").on('click',function(){
      if($(".email").val() === ''){
        $(".required-email").html('*メールアドレスは必須項目です');
        return false;
      }else{
        $(".required-email").html('');
      }

      if(!$(".email").val().match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)){
        $(".error-email").html('*メールアドレスは正しい形式で入力してください');
        return false;
      }else{
        $(".error-email").html('');
      }
    });

    //  お問い合わせ内容
    $("#submit_btn").on('click',function(){
      if(!$(".content").val().trim() === ""){
        $(".required-content").html('');
      }else if($(".content").val().trim() === ""){
        $(".required-content").html('*お問い合わせ内容は必須項目です');
        return false;
      }
    });
  });
  </script>

</head>
  <body>
    <?php
    require("headder.php");
    ?>

    <form id="update-form" name="form" action="update.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <dl class="clearfix">
        <dt>氏名<span class="red">*</span></dt>
        <dd>
          <input id="name" type="text" name="name" class="name" value="<?php echo $name; ?>">
          <p class="red required-name"></p>
          <p class="red count-name"></p>
          <p class="red">
          <?php
          if(isset($error_msg['name'])){
            echo $error_msg['name'];
          }
          ?>
          </p>
        </dd>


        <dt>フリガナ<span class="red">*</span></dt>
        <dd>
          <input id="kana" type="text" name="kana"  class="kana" value="<?php echo $kana; ?>">
          <p class="red required-kana"></p>
          <p class="red count-kana"></p>
          <p class="red">
            <?php
            if(isset($error_msg['kana'])){
              echo $error_msg['kana'];
            }
            ?>
          </p>
        </dd>


        <dt>電話番号</dt>
        <dd>
          <input id="tel" type="text" name="tel"  class="tel" value="<?php echo $tel; ?>">
          <p class="red error-tel"></p>
          <p class="red">
            <?php
            if(isset($error_msg['tel'])){
              echo $error_msg['tel'];
            }
            ?>
          </p>
        </dd>

        <dt>メールアドレス<span class="red">*</span></dt>
        <dd>
          <input id="email" type="text" name="email"  class="email" value="<?php echo $email; ?>">
          <p class="red required-email"></p>
          <p class="red error-email"></p>
          <p class="red">
            <?php
            if(isset($error_msg['email'])){
              echo $error_msg['email'];
            }
            ?>
          </p>
        </dd>
      </dl>


      <h2>１.お問い合わせ内容をご記入ください<span class="red">*</span></h2>
      <dl>
        <dd>
          <textarea name="content" class="content"><?php echo $body; ?></textarea>
          <p class="red required-content"></p>
          <p class="red">
            <?php
            if(isset($error_msg['content'])){
              echo $error_msg['content'];
            }
            ?>
          </p>
        </dd>
      </dl>


      <div id="btn">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        <input type="submit" name="submit" value="更新" id="submit_btn">
      </div>
    </form>


    <?php
    require("footer.php");
    ?>

  </body>
</html>
