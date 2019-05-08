<html>
  <head>
    <?php require_once "lib/random.php"; ?>
    <meta charset="utf-8" />
  </head>
  <body>
    <?php
      $id = $_POST['id'];
      $hash = $_POST['hash'];

      $dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost';//接続
      $user = 'tt-160.99sv-coco';
      $password = 'Z6aAiV24';
      $pdo = new PDO($dsn,$user,$password);


      if(isset($_POST['logout'])){
        $sql = "update userdata set login_mode=0 where id = $id";
        $result = $pdo->query($sql);
        $login = 0;
        echo '<font color="red">※ログアウトしました。</font>'.'<br/>';
        echo '<br/>'."<a class='link_button' href='http://tt-160.99sv-coco.com/mission6/login.php'> ログインページ</a>";
      }
    ?>
    <!--
    <p>
      <h2>ログアウト</h2>
    </p>
    <form action="./logout.php" method="post">
      <input type="submit" name="logout" value="ログアウト">
      <?php
        echo '<br/>'."<a class='link_button' href='http://tt-160.99sv-coco.com/mission6/mypage.php?id='";
        echo "'$id'&hash='$hash'> マイページに戻る</a>";
      ?>
    </form>
    -->

  </body>
</html>
