<?php
session_start();
require_once "utility/include.php";

// 変数の初期化
$loginId = "";

if($_SERVER["REQUEST_METHOD"] === "POST") {
  $loginId = $_POST["id"];
  $loginPass = $_POST["pass"];

  // 入力値のバリデーション
  $isValidated = true;
  if($loginId === "") {
    $idError = "ログインIDを入力してください。";
    $isValidated = false;
  }

  if($loginPass === "") {
    $passError = "パスワードを入力してください。";
    $isValidated = false;
  }

  // 入力に問題がなければ、ログインIDに該当するデータを取得
  if($isValidated == true) {
    try {
      $student = get_student_by_zdid($loginId);
    } catch(PDOException $e) {
      echo $e->getMessage();
      exit;
    }

    // パスワードのチェック
    if(!$student) {
      // ログインIDに該当するユーザーデータは存在しない(IDが間違っている)
      $loginError = "ログインIDまたはパスワードに誤りがあります。";
    } elseif(!check_password($loginPass, $student["pass"])) {
      // パスワードが間違っている
      $loginError = "ログインIDまたはパスワードに誤りがあります。";
    } else {
      // IDとパスワードの両方が正しい
      session_regenerate_id();
      set_auth_info($student["zdid"], $student["name"], "student");
      header("Location: student/index.php");
      exit;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ログイン</title>
<link rel="stylesheet" href="/zd_course/css/styles.css">
</head>
<body>
<header class="admin-header">
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="navbar-header">
        <h1><?php h(COURSE_NAME); ?></h1>
      </div>
    </nav>
  </div>
</header>
<div class="container admin-container">
  <main>
    <h2>ログイン</h2>
    <p>ログインIDとパスワードを入力し、ログインボタンを押してください。</p>

    <?php if(isset($idError)): ?>
      <p class="alert alert-danger"><?php h($idError); ?></p>
    <?php endif; ?>
    <?php if(isset($passError)): ?>
      <p class="alert alert-danger"><?php h($passError); ?></p>
    <?php endif; ?>
    <?php if(isset($loginError)): ?>
      <p class="alert alert-danger"><?php h($loginError); ?></p>
    <?php endif; ?>

    <form action="" method="post">
    <table class="login-table">
      <tr>
        <th>ログインID</th>
        <td><input type="text" name="id" value="<?php h($loginId); ?>"></td>
      </tr>
      <tr>
        <th>パスワード</th>
        <td><input type="password" name="pass"></td>
      </tr>
    </table>
    <p><input class="btn btn-primary" type="submit" value="ログイン"></p>
    </form>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
</body>
</html>