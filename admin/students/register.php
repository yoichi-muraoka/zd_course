<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("teacher");

$teacher = $_SESSION["login"];

// リストの更新
if($_SERVER["REQUEST_METHOD"] === "POST") {
  $file = explode("\n", $_POST["students"]);

  $students = [];
  foreach($file as $info) {
    $temp = explode(",", $info);
    $students[] = ["zdid" => $temp[0], "pass" => $temp[1], "name" => $temp[2]];
  }

  if(count($students) != 1) {
    try {
        reset_students();
        insert_students($students);
        all_scores_to_zero();
    }
    catch (PDOException $e) {
      echo $e->getMessage();
      echo "<p>申し訳ありませんが、しばらく時間をおいてからアクセスしてください</p>";
      exit;
    }
  }
}

// 生徒一覧
try {
  $studentList = get_students();
}
catch (PDOException $e) {
  echo $e->getMessage();
  echo "<p>申し訳ありませんが、しばらく時間をおいてからアクセスしてください</p>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>生徒登録</title>
  <link rel="stylesheet" href="/zd_course/css/styles.css">
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
        <h1><?php echo COURSE_NAME; ?> 
          <span style="font-size: 0.5em;">
          [<?php echo COURSE_START . ' ～ ' . COURSE_END; ?>]
          </span>
        </h1>
      </div>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="nav navbar-nav navbar-right mt10">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-user"></span>
              [<?php h($teacher["zdid"]); ?>]
              <?php h($teacher["name"]); ?>さん
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
    <p><a href="/zd_course/admin/exam/result.php" class="btn btn-primary">小テスト結果一覧</a></p>
    <hr>
    <h2>生徒リストの更新</h2>
    <p><a class="btn btn-info" href="students.csv" download="students.csv">テンプレートCSV</a></p>
    <p>
      ※ 生徒リストを更新すると、全員のテストが0点にリセットされます<br>
      ※ CSVの1行の構成は、| ジードライブID | パスワード | 生徒氏名 | です<br>
      ※ Excelでデータを保存したあと、メモ帳で開き直し、文字コードをUTF-8に変更してください。<br>
      ※ CSVの行末に空き行があると得点のリセットがされません。
    </p>
    <form class="form" action="" id="form" method="post">
      <input type="file" class="file_input">
      <input type="submit" class="btn btn-success" value="更新" style="margin-top:10px">
      <input type="hidden" id="students" name="students">
    </form>
    <h2>現在の生徒リスト</h2>
    <table class="table">
      <tr>
        <th>ID</th>
        <th>氏名</th>
      </tr>
      <?php foreach($studentList as $student): ?>
      <tr>
        <td><?php h($student["zdid"]); ?></td>
        <td><?php h($student["name"]); ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  let reader = new FileReader();
  reader.addEventListener('load', function(){
    $('#students').val(reader.result);
  });

  $('.file_input').change(function(){
      reader.readAsText(this.files[0], 'UTF-8');
  });
});
</script>
</body>
</html>