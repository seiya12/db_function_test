<?php
session_start();
// config・function読み込み
require_once 'config.php';
require_once 'function.php';

// 完了画面
if (!empty($_SESSION)) {
  require 'tpl/complete.php';
  $_SESSION = array();
  exit;
}

// DBセット
$cn = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($cn, 'utf8');

$columns=['id','name','mail','login_id','password'];

// button処理
if (!empty($_POST)) {
  // 登録確認・変更確認
  if ($_POST['button'] == 'create_check' || $_POST['button'] == 'update_check') {
    // エラー配列
    $err['name']       = '';
    $err['mail']       = '';
    $err['login_id']   = '';
    $err['password']   = '';
    // エラーチェック
    if ($_POST['name'] == '') {
      $err['name'] = '<br>' . "\n" . '※氏名が空白です';
    }
    if ($_POST['mail'] == '') {
      $err['mail'] = '<br>' . "\n" . '※メールアドレスが空白です';
    } elseif (mail_check($_POST['mail'])) {
      $err['mail'] = '<br>' . "\n" . '※形式が正しくありません';
    }
    if ($_POST['login_id'] == '') {
      $err['login_id'] = '<br>' . "\n" . '※ログインIDが空白です';
    } elseif (preg_check($_POST['login_id'])) {
      $err['login_id'] = '<br>' . "\n" . '※ログインIDは半角英数字で入力して下さい';
    }
    if ($_POST['password'] == '') {
      $err['password'] = '<br>' . "\n" . '※パスワードが空白です';
    } elseif (preg_check($_POST['password'])) {
      $err['password'] = '<br>' . "\n" . '※パスワードは半角英数字で入力して下さい';
    }
    // エラーがなければ確認ページへ
    if (empty(array_filter($err, "strlen"))) {
      if($_POST['button'] == 'create_check'){
        require 'tpl/create_check.php';
      }else{
        require 'tpl/update_check.php';
      }
      exit;
    }
    if($_POST['button'] == 'create_check'){
      require 'tpl/create.php';
    }else{
      $row = $_POST;
      require 'tpl/update.php';
    }
    exit;
  }
  // 登録・変更処理
  if ($_POST['button'] == 'create_entry' || $_POST['button'] == 'update_entry') {
    $values=[id_allotment($cn,TABLE_NAME),$_POST['name'],$_POST['mail'],$_POST['login_id'],$_POST['password']];
    // 登録
    if($_POST['button'] == 'create_entry'){
      insert_into($cn,TABLE_NAME,$columns,$values);
      $_SESSION['name'] = '登録';
    }
    // 変更
    else{
      $conditions = "WHERE id = ".$_GET['update']."";
      $values[0] = $_GET['update'];
      update($cn,TABLE_NAME,$columns,$values,$conditions);
      $_SESSION['name'] = '変更';
    }
    mysqli_close($cn);
    header('location: index.php');
    exit;
  }
  // 登録修正
  if ($_POST['button'] == 'create_back' || $_POST['button'] == 'update_back') {
    // エラー配列
    $err['name']       = '';
    $err['mail']       = '';
    $err['login_id']   = '';
    $err['password']   = '';
    if($_POST['button'] == 'create_check'){
      require 'tpl/create.php';
    }else{
      $row = $_POST;
      require 'tpl/update.php';
    }
    exit;
  }
  // 削除ボタン
  if ($_POST['button'] == 'delete'){
    delete_flag($cn,TABLE_NAME,$_POST['del_id']);
    mysqli_close($cn);
    header('location: index.php');
    exit;
  }
}

// 一覧表示リンク先
if (!empty($_GET)) {
  // 追加が押された場合
  if (!empty($_GET['create'])) {
    // 初期化
    $_POST['name']     = '';
    $_POST['mail']     = '';
    $_POST['login_id'] = '';
    $_POST['password'] = '';
    $err['name']       = '';
    $err['mail']       = '';
    $err['login_id']   = '';
    $err['password']   = '';
    require 'tpl/create.php';
    exit;
  }
  // 変更が押された場合
  if (!empty($_GET['update'])) {
    // 初期化
    $err['name']       = '';
    $err['mail']       = '';
    $err['login_id']   = '';
    $err['password']   = '';
    // 表示処理
    $conditions = "WHERE id = " . $_GET['update']."";
    $row = select_row($cn,TABLE_NAME,$columns,$conditions);
    require 'tpl/update.php';
    exit;
  }
  // 削除が押された場合
  if (!empty($_GET['delete'])) {
    require 'tpl/delete.php';
    exit;
  }
}

// 表示処理
$conditions = "WHERE del_flg = 0";
$rows = select_rows($cn,TABLE_NAME,$columns,$conditions);
// 一覧表示
require 'tpl/index.php';
exit;