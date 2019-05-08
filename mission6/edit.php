<html>
  <head>
    <meta charset="utf-8" />
    <script type="text/javascript" charset="UTF-8"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>
  		予定
  	</title>
  </head>
  <body>

    <?php
      $m = $_GET['m'];
      $days = $_GET['days'];
      $id = $_GET['id'];
      $hash = $_GET['hash'];
      $day = $m.$days;
      $comment = $_POST['schedule_comment'];

      $dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost';//接続
      $user = 'tt-160.99sv-coco';
      $password = 'Z6aAiV24';
      $pdo = new PDO($dsn,$user,$password);

      $sql = "SELECT * FROM userdata where id = {$id};";//hashログイン
      $results = $pdo -> query($sql);
      foreach ($results as $row){
        if($row['hash'] != $hash){
          header("location: http://tt-160.99sv-coco.com/mission6/error.php");
        }
      }

      $sql= "CREATE TABLE schedule$id"//テーブル作成
      ." ("
      . "day char(32),"//日付
      . "comment char(64)"//予定
      .");";
      $stmt = $pdo -> query($sql);

      if(isset($_POST['schedule_register'])){
        $sql = $pdo -> prepare("INSERT INTO schedule$id (day, comment) VALUES (:day, :comment)");
  			$sql -> bindParam(':day', $day, PDO::PARAM_STR);
  			$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
  			$sql -> execute();
      }

      if(isset($_POST['sakujo'])){//削除ボタンが押されたとき
          $sql= "drop table schedule$id"; //テーブル削除
          $stmt = $pdo -> query($sql);
      }

    ?>

    <p>
      <h2><?php echo $m."-".$days."の予定" ?></h2>
    </p>

    予定:<br>

    <?php
      $sql = "SELECT * FROM schedule$id where day = $day";
      $results = $pdo -> query($sql);
      foreach ($results as $row){    //$rowの中にはテーブルのカラム名が入る
        echo "・".$row['comment'].'<br>';
      }
    ?>


    <form action="edit.php<?php echo "?m=$m&days=$days&id=$id&hash=$hash"; ?>" method="post">
      <p>
        <input type="text" name="schedule_comment" placeholder="予定" class="form" required>
      </p>
      <input type="submit" name="schedule_register" value="登録"><br/>
    </form>

    <form action="edit.php<?php echo "?m=$m&days=$days&id=$id&hash=$hash"; ?>" method="post">
      <input type="submit" value="全スケジュール削除" name ="sakujo"><br/>
    </form><br/>
    <a class='link_button' href='http://tt-160.99sv-coco.com/mission6/mypage.php?m=<?php echo "$m&id=$id&hash=$hash" ?>'> カレンダーに戻る</a>


  </body>
</html>
