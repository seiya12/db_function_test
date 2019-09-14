<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>会員情報変更</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
  <form action="" method="post" autocomplete="off">
    <table>
      <tr>
        <th>氏名</th>
        <td><input type="text" name="name" value="<?php echo $row['name']; ?>">
          <span class="err"><?php echo $err['name']; ?></span></td>
      </tr>
      <tr>
        <th>メール</th>
        <td><input type="text" name="mail" value="<?php echo $row['mail']; ?>">
          <span class="err"><?php echo $err['mail']; ?></span></td>
      </tr>
      <tr>
        <th>ログインID</th>
        <td><input type="text" name="login_id" value="<?php echo $row['login_id']; ?>">
          <span class="err"><?php echo $err['login_id']; ?></span></td>
      </tr>
      <tr>
        <th>パスワード</th>
        <td><input type="text" name="password" value="<?php echo $row['password']; ?>">
          <span class="err"><?php echo $err['password']; ?></span></td>
      </tr>
    </table>

    <button type='submit' name='button' value="update_check">入力した内容を確認する</button>
  </form>
</html>