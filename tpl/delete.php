<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>会員削除</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
  <p>選択した会員情報を<br>
  削除してもよろしいですか？</p>
  <form action="" method="post" autocomplete="off">
    <input type=hidden name='del_id' value="<?php echo $_GET['delete']; ?>">
    <button type='submit' name='button' value="delete">OK</button>
  </form>
</body>
</html>