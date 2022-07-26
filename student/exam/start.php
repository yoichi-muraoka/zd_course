<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/utility/include.php";
auth_confirm("student");

// 生徒情報
$loginUser = $_SESSION["login"];

$examId = $_GET["exam_id"];
if(!isset($examId)) {
  header("Location: schedule.php");
  return;
}

try {
  // 受験済みの場合、結果ページにリダイレクト
  $score = get_score($examId, $loginUser["id"]);
  if($score["answers"] != null) {
    send_redirect("finished.php?exam_id=" . $examId, false);
  }
  $questionList = get_questions($examId);
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
  <title>小テスト</title>
  <link rel="stylesheet" href="/zd_course/css/styles.css">
</head>
<body>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/parts/header.php"; ?>

<div class="container admin-container">
  <main>
  <?php foreach($questionList as $question): ?>
    <section class="q-section" data-question-id="<?php echo $question["id"]; ?>">
      <h2>問<?php echo $question["num"]; ?></h2>
        <?php echo $question["sentence"]; ?>
        <h3>答え</h3>
        <?php echo $question["answer"]; ?>
        <p>
          配点: <?php echo $question["score"]; ?>
        </p>
        <hr>
      </section>
      <?php endforeach; ?>
    <form action="submit.php" method="post">
      <input type="hidden" name="exam_id" value="<?php echo $examId; ?>">
      <input type="hidden" name="answers" id="answers">
      <input class="btn btn-danger" type="submit" value="小テストを提出する">
    </form>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
<script>
// 問題文中のHTMLタグを表示
function htmlToReference() {
  $('pre.html-code').each(function() {
    const html = $(this).html();
    $(this).text(html);
  });
}

/**
 * 解答をオブジェクトとしてまとめる
 */
function collectAnswers() {
  const answers = {};
  $('.q-section').each(function() {
    answers[$(this).attr('data-question-id')] = $(this).find('input').val();
  });
  return answers;
}

$(document).ready(function() {
  htmlToReference();

  $('form').submit(function() {
    const conf = confirm('提出してよろしいですか？');
    if(conf != true) {
      return false;
    }

    // 入力された解答を収集、JSON文字列として送信
    const answers = JSON.stringify(collectAnswers());
    $('#answers').val(answers);
  });
});
</script>
</body>
</html>