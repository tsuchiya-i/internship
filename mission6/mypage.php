<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php
      $id = 0;
      $id = $_GET['id'];
      $hash = $_GET['hash'];
      if($id == 0){
        echo "無効なユーザーデータです。";
      }

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

    ?>

    <p>
      <h2>マイページ</h2>
    </p>
    <form action="logout.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="hash" value="<?php echo $hash; ?>">
      <input type="submit" name="logout" value="ログアウト">
    </form>



    <?php
    function color_get($i) {
        if ($i == 0) return '#ff0000'; elseif ($i == 6) return '#0000ff'; else return '#000000';
    }
    $m = $_GET['m'];
    if ($m) {
        $year = date('Y', strtotime($m . '01'));
        $month = date('n', strtotime($m . '01'));
    } else {
        $year = date('Y');
        $month = date('n');
    }
    $day = date('j');
    $weekday = array('日', '月', '火', '水', '木', '金', '土');
    echo '<TABLE cellpadding="4" cellspacing="1" style="background-color : #aaaaaa;text-align : center;">
    <CAPTION style="padding : 4px;"><A href="?m=' . date('Ym', mktime(0, 0, 0, $month , 1, $year - 1)) . "&id=$id&hash=$hash" . '">&lt;&lt;</A>
    <A href="?m=' . date('Ym', mktime(0, 0, 0, $month - 1 , 1, $year)) . "&id=$id&hash=$hash" . '">&lt;</A> ' . $year . '年' . $month . '月
    <A href="?m=' . date('Ym', mktime(0, 0, 0, $month + 1 , 1, $year)) . "&id=$id&hash=$hash" . '">&gt;</A>
    <A href="?m=' . date('Ym', mktime(0, 0, 0, $month , 1, $year + 1)) . "&id=$id&hash=$hash" . '">&gt;&gt;</A>
    </CAPTION><TBODY><TR>';
    $i = 0;
    while ($i <= 6) {
        $c = color_get($i);
        echo '<TD style="color : ' . $c . ';background-color : #eeeeee;">' . $weekday[$i] . '</TD>';
        $i++;
    }
    echo '</TR><TR>';
    $i = 0;
    while ($i != date('w', mktime(0, 0, 0, $month, 1, $year))) {
        echo '<TD style="background-color : #ffffff;">　</TD>';
        $i++;
    }
    for ($days = 1; checkdate($month, $days, $year); $days++) {
        if ($i > 6) {
            echo '</TR><TR>';
            $i = 0;
        }
        $c = color_get($i);
        if ($days == $day) $bc = '#ffff00'; else $bc = '#ffffff';

        echo '<TD style="color : ' . $c . ';background-color : ' . $bc . ';">';
        echo "<a class='link_button' href='edit.php?m=$m&days=$days&id=$id&hash=$hash'>";
        echo $days;
        echo "</a>";
        echo '</TD>';

        $i++;
    }
    while ($i < 7) {
        echo '<TD style="background-color : #ffffff;">　</TD>';
        $i++;
    }
    echo '</TR></TBODY></TABLE>';
    ?>




  </body>
</html>
