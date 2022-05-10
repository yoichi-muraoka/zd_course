<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";

// ログイン認証
$student = $_SESSION["login"];
auth_confirm();


// アップロード処理
if(isset($_POST["upload_button"])) {
    $upfolder = "s" . substr($student["zdid"], 4);
    $upfile = $_FILES["upfile"];
    for($i = 0; $i < count($upfile["name"]); $i++) {
        if($upfile["error"][$i] == UPLOAD_ERR_OK) {
            $tmp = $upfile["tmp_name"][$i];
            $moved = $upfolder . "/" . $upfile["name"][$i];
            move_uploaded_file($tmp, $moved);
        }
    }
}

// ファイル削除
if(isset($_POST["delete_button"])) {
    $delete = $_POST["delete"];
    if($delete != null) {
        foreach($delete as $d) {
            unlink($d);
        }
    }
}


// ファイル一覧
$upfolder = "s" . substr($student["zdid"], 4);
$files = glob($upfolder . "/*");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Java Course</title>
  <link rel="stylesheet" href="/zd_course/css/styles.css">
</head>
</head>
<body>
<header class="admin-header">
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <h1>自己紹介</h1>
      </div>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="nav navbar-nav navbar-right mt10">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-user"></span>
              [<?php h($student["zdid"]); ?>]
              <?php h($student["name"]); ?>さん
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="/zd_course/logout.php">ログアウト</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>
<div class="container admin-container">
  <main>
    <p><a href="index.php" class="btn btn-primary">自己紹介を見る</a></p>
    <hr>
    <h2>自己紹介ファイルをアップロード</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <p><input type="file" name="upfile[]"></p>
        <p><input type="file" name="upfile[]"></p>
        <p><input type="file" name="upfile[]"></p>
        <input class="btn btn-success" type="submit" name="upload_button" value="アップロード">
    </form>
    
    <?php if(count($files) > 0): ?>
      <hr>
      <h2>アップロード済みのファイル</h2>
      <form action="" method="post">
      <ul style="list-style:none; padding-left:0;">
        <?php foreach($files as $file): ?>
        <li>
            <label>
            <input type="checkbox" name="delete[]" value="<?php h($file); ?>">
            <?php h($file); ?>
            </label>
        </li>
        <?php endforeach; ?>
      </ul>
      <input type="submit" class="btn btn-danger" name="delete_button" value="チェックしたファイルを削除">
      </form>
    <?php endif;?>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
</body>
</html>