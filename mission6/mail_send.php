<html>
  <head>
    <?php require_once "lib/random.php"; ?>
    <meta charset="utf-8" />
  </head>
  <body>
    <?php
      $user_name = $_POST['user_name'];
      $mail_address = $_POST['mail_address'];
      $user_password = $_POST['password'];

      $dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost';//接続
      $user = 'tt-160.99sv-coco';
      $password = 'Z6aAiV24';
      $pdo = new PDO($dsn,$user,$password);

      $sql = 'SELECT MAX(id) + 1 FROM userdata';//カウント
      $results = $pdo -> query($sql);
      $max_id = $results -> fetchAll();
      $id = $max_id[0][0];
      if($id == '') $id = 1;

      $header = 'From: tsuchiya' . "\r\n";//mb_send_mailの最後と同じ
      $title = '登録ありがとうございます。';
      $hash = random_int(10000,99999);
      $URL = "http://tt-160.99sv-coco.com/mission6/authentication.php?id=$id";
      $authenticated = 0; $login_mode = 0;
      $message = '登録ありがとうございます。'."\r\n".'メール認証はid:'.$hash.'です。URL:'.$URL;

      $sql = $pdo -> prepare("INSERT INTO userdata (id, name, mail_address, password, hash,
        authenticated, login_mode) VALUES (:id, :name, :mail_address, :password,
          :hash, :authenticated, :login_mode)");//データ入力
			$sql -> bindParam(':id', $id, PDO::PARAM_INT);
			$sql -> bindParam(':name', $user_name, PDO::PARAM_STR);
			$sql -> bindParam(':mail_address', $mail_address, PDO::PARAM_STR);
			$sql -> bindParam(':password', $user_password, PDO::PARAM_STR);
			$sql -> bindParam(':hash', $hash, PDO::PARAM_INT);
      $sql -> bindParam(':authenticated', $authenticated, PDO::PARAM_INT);
      $sql -> bindParam(':login_mode', $login_mode, PDO::PARAM_INT);
			$sql -> execute();

      mb_language("Japanese");
      mb_internal_encoding("UTF-8");
      if(mb_send_mail($mail_address, $title, $message, $header, '-f' . 'tsuchiya')){
        echo $mail_address."宛にメールを送信しました";
        echo "<a class='link_button' href=$URL> 認証ページへ</a>";
      } else {
        echo "メールの送信に失敗しました";
      };
    ?>
  </body>
</html>
