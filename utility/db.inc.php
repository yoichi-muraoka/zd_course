<?php
function db_init() {

  // データベースへ接続する
  $pdo = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASS);

  // エラーモードと文字コードの設定
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec("SET NAMES utf8");

  return $pdo;
}
