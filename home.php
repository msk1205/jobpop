<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>JOBPOP 特定労働者派遣事業 東京都豊島区東池袋</title>
<link rel="stylesheet" type="text/css" href="css/base.css?v=2">
<link rel="stylesheet" type="text/css" href="css/home.css?v=2">

<script type="text/javascript" src="js/jquery.js"></script>

</head>
<body>
<div id="wrapper">

<?php
require("headder.php");
?>


  <div id="contents" class="clearfix">
    <div id="top">
      <div id="slider">
        <img class="catchcopy1" src="img/catchcopy.png" alt="キャッチコピー">
        <img class="catchcopy2" src="img/catchcopy2.png" alt="キャッチコピー">
      </div>
    </div>
    <img src="img/title.png" alt="タイトル">
  </div>


  <div id="bottom" class="clearfix">
    <ul>
      <li>
        <a href="whats.php">
          <img src="img/btn01.png" alt="ボタン">
        </a>
        <p class="text">ジョブポップとはこういう会社です。</p>
        <p class="more">more</p>
      </li>

      <li>
        <a href="company.php">
          <img src="img/btn02.png" alt="ボタン">
        </a>
        <p class="text">会社概要</p>
        <p class="more">more</p>
      </li>

      <li>
        <a href="recruit.php">
          <img src="img/btn03.png" alt="ボタン">
        </a>
        <p class="text">随時スタッフ募集しています。</p>
        <p class="more">more</p>
      </li>

      <li>
        <a href="q_and_a.php">
          <img src="img/btn04.png" alt="ボタン">
        </a>
        <p class="text">よくある質問Q＆A</p>
        <p class="more">more</p>
      </li>

      <li>
        <a href="contact.php">
          <img src="img/btn05.png" alt="ボタン">
        </a>
        <p class="text">ジョブポップへのお問い合わせ</p>
        <p class="more">more</p>
      </li>
    </ul>
  </div>

<?php
require("footer.php");
?>


</div>

</body>

<script>
$(function(){
  top_movie();
})

  function top_movie(){
    $("img.catchcopy1").delay(2000).fadeIn(3000, function(){
      $("img.catchcopy1").delay(10000).fadeOut(2000, function(){
        $("img.catchcopy2").fadeIn(3000, function(){
          $("img.catchcopy2").delay(10000).fadeOut(2000, function(){
            top_movie();
          });
        });
      });
    });
  }

</script>
</html>
