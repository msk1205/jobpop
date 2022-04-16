<?php
session_start();

$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
  // 生成したトークンをセッションに保存
$_SESSION['csrf_token'] = $csrf_token;


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
<link rel="stylesheet" type="text/css" href="css/contact.css?v=2">
<link rel="stylesheet" type="text/css" href="css/dbc.css?v=2">
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
<div id="wrapper">

<?php
require("headder.php");
?>


  <div id="contents" class="clearfix">
    <h1>Contact</h1>
    <h2>下記の項目をご記入の上送信ボタンを押してください</h2>

    <p id="text">
      送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
      なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。<br>
      <span class="red">*</span>は必須項目となります。
    </p>



    <form id="contact-form" name="form" action="confirm.php" method="post">
      <dl class="clearfix">
        <dt>氏名<span class="red">*</span></dt>
        <dd>
          <input id="name" type="text" name="name" class="name" value="<?php echo isset($_POST['name']) ? h($_POST['name']) : ''; ?>">
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
          <input id="kana" type="text" name="kana"  class="kana" value="<?php echo isset($_POST['kana']) ? h($_POST['kana']) : ''; ?>">
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
          <input id="tel" type="text" name="tel"  class="tel" value="<?php echo isset($_POST['tel']) ? h($_POST['tel']) : ''; ?>">
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
          <input id="email" type="text" name="email"  class="email" value="<?php echo isset($_POST['email']) ? h($_POST['email']) : ''; ?>">
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
          <textarea name="content" class="content"><?php echo isset($_POST['content']) ? h($_POST['content']) : ''; ?></textarea>
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
        <input type="submit" name="submit" value="送信" id="submit_btn">
      </div>
    </form>

<?php
require("dbc.php");

// 取得したデータを表示
$contactData = getAllContact();



// データを取得する
// 引数：なし
// 返り値：取得したデータを返す
function getAllContact(){
  $dbh = dbConnect();

  // SQLの準備
  $sql = 'SELECT * FROM contacts';

  // SQLの実行
  $stmt = $dbh->query($sql);

  // SQLの結果を受け取る
  $result = $stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;

  $dbh = null;
}

?>

  <div class="db_table">
    <table>
      <h3>contactsテーブル</h3>
      <tbody>
        <tr>
          <th>id</th>
          <th>氏名</th>
          <th>フリガナ</th>
          <th>電話番号</th>
          <th>メールアドレス</th>
          <th class="body_1">お問い合わせ内容</th>
          <th>お問い合わせ日時</th>
          <th>更新</th>
          <th>削除</th>
        </tr>
        <?php foreach($contactData as $column): ?>

        <?php
        $column['id'] = h($column['id'], ENT_QUOTES, 'UTF-8');
        $column['name'] = h($column['name'], ENT_QUOTES, 'UTF-8');
        $column['kana'] = h($column['kana'], ENT_QUOTES, 'UTF-8');
        $column['email'] = h($column['email'], ENT_QUOTES, 'UTF-8');
        $column['body'] = h($column['body'], ENT_QUOTES, 'UTF-8');
        $column['created_at'] = h($column['created_at'], ENT_QUOTES, 'UTF-8');
         ?>

        <tr>
          <th><?php echo h($column['id']) ?></th>
          <th><?php echo h($column['name']) ?></th>
          <th><?php echo h($column['kana']) ?></th>
          <th><?php echo h($column['tel']) ?></th>
          <th><?php echo h($column['email']) ?></th>
          <th class="body_2"><?php echo h($column['body']) ?></th>
          <th><?php echo h($column['created_at']) ?></th>
          <th><a href="edit_form.php?id=<?php echo h($column['id']) ?>">更新</a></th>
          <th><a href="delete.php?id=<?php echo h($column['id']) ?>" onclick="return confirm('本当に削除してもよろしいですか？')">削除</a></th>
        </tr>
        <?php endforeach;  ?>
      </tbody>
    </table>
  </div>


<?php
require("footer.php");
?>
</div>
</body>


</html>
