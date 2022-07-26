<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("student");

// 生徒情報
$loginUser = $_SESSION["login"];

try {
  // 小テスト結果
  $scoreList = get_finished_exam_scores($loginUser["id"]);
  // 小テスト日程
  $examList = get_unfinished_exams($loginUser["id"]);
}
catch (PDOException $e) {
  echo "<p>申し訳ありませんが、しばらく時間をおいてからアクセスしてください</p>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>小テスト</title>
  <link rel="stylesheet" href="/zd_course/css/styles.css">
</head>
<body>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/parts/header.php"; ?>

<div class="container admin-container">
  <main>
    <?php if($scoreList != null): ?>
    <h2>小テスト結果</h2>
    <table class="table">
      <tr>
        <th>受験日</th>
        <th>科目</th>
        <th>得点</th>
        <th>得点率</th>
        <th>答案</th>
      </tr>
      <?php foreach($scoreList as $score): ?>
      <tr>
        <td><?php h($score["submitted_at"]); ?></td>
        <td><?php h($score["title"]); ?></td>
        <td>
          <?php h($score["score"]); ?> /
          <?php h($score["fullscore"]); ?>点
        </td>
        <td><?php echo percent($score["score"],$score["fullscore"]); ?>％</td>
        <td><a class="btn btn-primary" href="finished.php?exam_id=<?php h($score["exam_id"]); ?>">答案を見る</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <h2>小テスト日程</h2>
    <table class="table">
      <tr>
        <th>日付</th>
        <th>科目</th>
        <th>内容</th>
        <th>受験</th>
      </tr>
      <?php foreach($examList as $exam): ?>
      <tr class="exam-row">
        <td><?php h($exam["tested_at"]); ?></td>
        <td><?php h($exam["title"]); ?></td>
        <td><?php echo nl2br($exam["summery"]); ?></td>
        <td><a class="btn btn-danger exam-start" href="/zd_course/student/exam/start.php?exam_id=<?php h($exam["id"]); ?>">試験開始</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
<script>
// 試験開始ボタンの有効化
$(document).ready(function(){
  const today = new Date();
  $('.exam-row').each(function() {
    const examDate = new Date($(this).find('td:first-child').text());
    if(today.getTime() < examDate.getTime()) {
      $(this).find('.exam-start').addClass('disabled');
    }
  });
});
</script>
</body>
</html>