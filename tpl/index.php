<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>一覧表示</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
  <table>
    <tr>
      <th>ID</th>
      <th>氏名</th>
      <th>メール</th>
      <th>ログインID</th>
      <th>パスワード</th>
      <th>変更・削除</th>
    </tr>
<?php foreach($rows as $row) : ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['mail']; ?></td>
      <td><?php echo $row['login_id']; ?></td>
      <td><?php echo $row['password']; ?></td>
      <td>
        <a href=index.php?update=<?php echo $row['id']; ?>>変更</a>
        <a href=index.php?delete=<?php echo $row['id']; ?>>削除</a>
      </td>
    </tr>
<?php endforeach; ?>
  </table>

  <p><a href="index.php?create=''">会員追加</a></p>
</body>
</html>