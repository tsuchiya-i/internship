<html>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <?php
      if(isset($_POST['transmit'])){
      	if(isset($_POST['transmit']) and $_POST['transmit']!==''){
          $id = $_POST['id'];
          $mail_authentication =  $_POST['mail_authentication'];

          $dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost';//接続
          $user = 'tt-160.99sv-coco';
          $password = 'Z6aAiV24';
          $pdo = new PDO($dsn,$user,$password);

          $sql = "SELECT * FROM userdata where id = {$id};";
          $results = $pdo -> query($sql);
          foreach($results as $row){
          	if($row['hash'] == $mail_authentication){
              $sql = "update userdata set authenticated=1 where id=$id";
              $result = $pdo->query($sql);
              echo "<a class='link_button' href='http://tt-160.99sv-coco.com/mission6/login.php'> 認証完了いたしました</a>";
            }
            else echo '<font color="red">※idが違います。</font>'.'<br/>';
          }
        }
      }
      else {
        $id = $_GET['id'];
      }

    ?>

    <form action="authentication.php" method="post">
      <p>
        認証id:<br>
        <input type="text" name="mail_authentication" ptextaceholder="コード入力" class="form" autocomplete="off" required>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
      </p>
      <input type="submit" name="transmit" value="送信"><br>
    </form>


  </body>
</html>
