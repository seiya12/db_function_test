<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>会員情報変更確認画面</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
  <form action="" method="post" autocomplete="off">
    <table>
      <tr>
        <th>氏名</th>
        <td><?php echo $_POST['name']; ?></td>
      </tr>
      <tr>
        <th>メール</th>
        <td><?php echo $_POST['mail']; ?></td>
      </tr>
      <tr>
        <th>ログインID</th>
        <td><?php echo $_POST['login_id']; ?></td>
      </tr>
      <tr>
        <th>パスワード</th>
        <td><?php echo $_POST['password']; ?></td>
      </tr>
    </table>
    <input type=hidden name='name' value="<?php echo $_POST['name']; ?>">
    <input type=hidden name='mail' value="<?php echo $_POST['mail']; ?>">
    <input type=hidden name='login_id' value="<?php echo $_POST['login_id']; ?>">
    <input type=hidden name='password' value="<?php echo $_POST['password']; ?>">
    <ul>
      <li><button type='submit' name='button' value="update_entry">入力した内容で登録する</button></li>
      <li><button type='submit' name='button' value="update_back">入力した内容を修正する</button></li>
    </ul>
  </form>
</body>
</html>