<html>
  <head>
    <?php require_once "lib/random.php"; ?>
    <meta charset="utf-8" />
  </head>
  <body>
    <?php
      $dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost';//接続
      $user = 'tt-160.99sv-coco';
      $password = 'Z6aAiV24';
      $pdo = new PDO($dsn,$user,$password);

      $sql= "CREATE TABLE userdata"//テーブル作成
      ." ("
      . "id INT,"//ユーザーid1~10000
      . "name char(32),"//ユーザーネーム
      . "mail_address char(64),"//ユーザーメールアドレス
      . "password char(32),"//ユーザーパスワード
      . "hash char(32),"//メール認証id and hash
      . "authenticated INT,"//認証済みか0 or 1
      . "login_mode INT"//ログイン中か0 or 1
      .");";
      $stmt = $pdo -> query($sql);

      $sql ='SHOW TABLES';//mission3-3　テーブル表示
      $result = $pdo -> query($sql);
      foreach ($result as $row){
      	echo $row[0];
      	echo '<br>';
      }
      echo "<hr>";//水平罫線

      $login_mode=1;

  if(isset($_POST['testdata'])){//ボタンが押されたとき
    for($id = 1; $id <= 10; $id++){
      $name = '土屋'; $mail_address="test$id@mail.com"; $password = $id*10; $hash=$id*10000; $authenticated = 0;
      $sql = $pdo -> prepare("INSERT INTO userdata (id, name, mail_address, password, hash, authenticated, login_mode) VALUES (:id, :name, :mail_address, :password, :hash, :authenticated, :login_mode)");//データ入力
			$sql -> bindParam(':id', $id, PDO::PARAM_INT);
			$sql -> bindParam(':name', $name, PDO::PARAM_STR);
			$sql -> bindParam(':mail_address', $mail_address, PDO::PARAM_STR);
			$sql -> bindParam(':password', $password, PDO::PARAM_STR);
			$sql -> bindParam(':hash', $hash, PDO::PARAM_INT);
      $sql -> bindParam(':authenticated', $authenticated, PDO::PARAM_INT);
      $sql -> bindParam(':login_mode', $login_mode, PDO::PARAM_INT);
			$sql -> execute();
    }
  }

      for($i=1; $i<=1000; $i++){
      	$sql = "SELECT * FROM userdata where id = {$i};";//mission3-6　データ表示
      	$results = $pdo -> query($sql);
      	foreach ($results as $row){//$rowの中にはテーブルのカラム名が入る
      		echo $row['id'].' ';
      		echo $row['name'].' ';
      		echo $row['mail_address'].' ';
      		echo $row['password'].' ';
        	echo $row['hash'].' ';
          echo $row['authenticated'].' ';
          echo $row['login_mode'];
      		echo '<br/>';
        }
      }

      $id=1;

      $sql = "SELECT * FROM schedule$id";
      $results = $pdo -> query($sql);
      foreach ($results as $row){    //$rowの中にはテーブルのカラム名が入る
        echo $row['day'].',';
        echo $row['comment'].'<br>';
      }


      if(isset($_POST['sakujo'])){//削除ボタンが押されたとき
          $sql= "drop table userdata"; //テーブル削除
          $stmt = $pdo -> query($sql);
      }
    ?>

    <form method="post" action="show_table.php">
    	<input type="submit" value="削除" name ="sakujo"><br/>
      <input type="submit" value="テストデータ" name ="testdata"><br/>
    </form>


  </body>
</html>
