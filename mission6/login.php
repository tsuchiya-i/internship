<html>
  <head>
    <?php require_once "lib/random.php"; ?>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php
      $user_name = $_POST['user_name'];
      $user_password = $_POST['password'];
      $m = date('Ym');

      $dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost';//接続
      $user = 'tt-160.99sv-coco';
      $password = 'Z6aAiV24';
      $pdo = new PDO($dsn,$user,$password);


      $sql = 'SELECT id, name, password, authenticated FROM userdata';
      $results = $pdo -> query($sql);
      $all = $results->fetchAll();

      $login = 0;
      $length = 10;

      if(isset($_POST['login'])){
        foreach($all as $INPA){
          if($INPA['name'] == $user_name and $INPA['password'] == $user_password){
            if($INPA['authenticated'] == 1){
              $id = $INPA['id'];
              $hash = substr(bin2hex(random_bytes($length)), 0, $length);//10文字の16進数乱数
              $sql = "update userdata set login_mode=1, hash='$hash' where id=$id";
        			$result = $pdo->query($sql);
              $login = 1;
              echo '<font color="red">※ログインします。</font>'.'<br/>';
              header("location: http://tt-160.99sv-coco.com/mission6/mypage.php?m=$m&id=$id&hash=$hash");
            }
            else echo '<font color="red">※メール認証を行ってください。</font>'.'<br/>';
          }
        }
        if($login != 1){
          echo '<font color="red">※ユーザー名かパスワードが違います。</font>'.'<br/>';
        }
      }
    ?>

    <p>
      <h2>ログイン</h2>
    </p>
    <form action="./login.php" method="post">
      <p>
        お名前:<br>
        <input type="text" name="user_name" placeholder="ユーザー名" class="form" required>
      </p>
      <p>
        パスワード:<br>
        <input type="password" name="password" placeholder="パスワード" class="form" autocomplete="off" required>
      </p>
      <input type="submit" name="login" value="ログイン">
    </form>

  </body>
</html>
