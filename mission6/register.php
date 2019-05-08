<!--DOCTYPE html-->
<html>
  <head>
    <meta charset="utf-8" />
    <script type="text/javascript" charset="UTF-8"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>
  		ユーザー登録ページ
  	</title>
  </head>
  <body>

    <?php
      $user_name = $_POST['user_name'];
      $mail_address = $_POST['mail_address'];

      $dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost';//接続
      $user = 'tt-160.99sv-coco';
      $password = 'Z6aAiV24';
      $pdo = new PDO($dsn,$user,$password);

      $sql = 'SELECT name, mail_address FROM userdata';
  		$results = $pdo -> query($sql);
  		$all = $results->fetchAll();
  		foreach($all as $NMP){
  			if($NMP['name'] == $){
  				if($e_password == $INCP['password']){
  					$sql = "update keiji set editmode=1 where id = $e_id";
  					$result = $pdo->query($sql);
  					$ini_name = $INCP['name'];
  					$ini_comment = $INCP['comment'];
  					$ini_password = $INCP['password'];
  				}
  				else echo '<font color="red">※パスワードが違います。</font>'.'<br/>';
  			}
  		}
    ?>

    <p>
      <h2>ユーザー登録フォーム</h2>
    </p>
    <form action="register.php" method="post">
      <p>
        お名前:<br>
        <input type="text" name="user_name" placeholder="ユーザー名" class="form" required>
      </p>
      <p>
        メールアドレス:<br>
        <input type="text" name="mail_address" placeholder="例)address@sample.com" class="form" required>
      </p>
      <p>
        パスワード:<br>
        <input type="password" name="password" placeholder="" class="form" autocomplete="off" required>
      </p>
      <input type="submit" name="register" value="登録">
    </form>
  </body>
</html>
