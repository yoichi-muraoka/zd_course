<?php
/**
 * htmlspecialcharsの短縮形
 */
function h($string, $echo = true) {
  $escapedString = htmlspecialchars($string, ENT_QUOTES);
  if($echo) echo $escapedString;
  return $escapedString;
}

/**
 * コンテキストルートを含むルートパスに変換
 */
function root_path($path, $echo = true) {
  if(CONTEXT_ROOT !== "") {
    $prefix = "/";
  } else {
    $prefix = "/" . CONTEXT_ROOT . "/";
  }
  return h($prefix . $path, $echo);
}

/**
 * 日付のフォーマット
 */
function format($date, $format = "F j, Y") {
  return (new DateTime($date))->format($format);
}

/**
 * Bootstrap 3 ページネーションの作成
 */
function bs3_pagination($totalPage, $currentPage) {
  $paramName = "page";
  $prevLabel = "«";
  $nextLabel = "»";

  $prevPage = $currentPage - 1;
  $nextPage = $currentPage + 1;

  // 開始タグ
  $pagination = "<nav><ul class='pagination'>";

  // 前ページへ
  if($prevPage < 1) {
    $pagination .= "<li class='disabled'><a>";
  } else {
    $pagination .= "<li><a href='?{$paramName}={$prevPage}'>";
  }
  $pagination .= $prevLabel . "</a></li>";

  // ページ番号
  for($i = 1; $i <= $totalPage; $i++) {
    if($i != $currentPage) {
      $pagination .= "<li><a href='?{$paramName}={$i}'>";
    } else {
      $pagination .= "<li class='active'><a>";
    }
    $pagination .= $i . "</a></li>";
  }

  // 次ページへ
  if($nextPage > $totalPage) {
    $pagination .= "<li class='disabled'><a>";
  } else {
    $pagination .= "<li><a href='?{$paramName}={$nextPage}'>";
  }
  $pagination .= $nextLabel . "</a></li>";

  // 終了タグ
  $pagination .= "</ul></nav>";

  // 出力
  echo $pagination;
}

/**
 * 認証チェック
 */
function auth_confirm($role = "student") {
  $location = $role == "student" ? "index.php" : "admin/login.php";
  if($_SESSION["login"] == null) {
    header("Location: /" . CONTEXT_ROOT . "/" . $location);
    exit;
  }

  if($_SESSION["login"]["role"] != $role) {
    header("Location: /" . CONTEXT_ROOT . "/" . $location);
    exit;
  }
}


/**
 * セッションに情報を格納(サインイン)
 */
function set_auth_info($zdid, $name, $role) {
  $_SESSION["login"] = [
    "zdid" => $zdid,
    "name" => $name,
    "role" => $role
  ];
}

/**
 * サインアウト
 */
function clear_login_session() {
  unset($_SESSION["login"]);
}


/**
 * パスワードのチェック
 */
function check_password($enteredPass, $hashedPass) {
  return $hashedPass === hash('sha256', $enteredPass);
}

/**
 * 得点のパーセント化
 */
function percent($score, $fullscore, $floatNum = 1) {
  return round($score / $fullscore * 100, $floatNum);
}

function get_num_from_zdid($zdid) {
  $num = substr($zdid, 4);
  return (int) $num;
}