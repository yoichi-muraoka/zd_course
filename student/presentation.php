<?php
session_start();
require_once "../utility/include.php";

// 生徒情報
$loginUser = $_SESSION["login"];

auth_confirm();

try {
  if(is_post()) {
    // DBに登録
    register_presentation($loginUser["zdid"], $_POST["anydesk"], $_POST["url"], $_POST["note"]);
  }
  // DBから登録済みのプレゼン情報を取得
  $presentation = get_presentation_by_zdid($loginUser["zdid"]);
  $anydesk = $presentation != null ? $presentation['anydesk'] : "";
  $url = $presentation != null ? $presentation['url'] : "";
  $note = $presentation != null ? $presentation['note'] : "";
} catch(PDOException $e) {
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
  <title>Java Course</title>
  <link rel="stylesheet" href="/zd_course/css/styles.css">
</head>
<body>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/zd_course/parts/header.php"; ?>

<div class="container admin-container">
  <main>
    <h2>プレゼン情報の登録</h2>
    <form action="" method="post">
      <h3>Anydeskアドレス</h3>
      <p>
        登録中のアドレス: <?php h($anydesk); ?><br>
        <input type="text" name="anydesk" value="<?php h($anydesk); ?>">
      </p>
      <h3>URL</h3>
      <p>
        登録中のURL: <a href="<?php h($url); ?>" target="_blank"><?php h($url); ?></a><br>
        <input type="text" name="url" value="<?php h($url); ?>" size="80">
      </p>
      <h3>備考</h3>
      <textarea name="note" cols="80" rows="5"><?php h($note); ?></textarea>
      <p>
        <input type="submit" class="btn btn-primary" value="登録">
      </p>
    </form>
  </main>
</div>
<script src="/zd_course/js/jquery-2.1.4.min.js"></script>
<script src="/zd_course/js/bootstrap.min.js"></script>
</body>
</html>