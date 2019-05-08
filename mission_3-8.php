<html>

<head>
<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<title>
3-8
</title>
</head>

<body>
<?php
$dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost';//mission3-1 接続
$user = 'tt-160.99sv-coco';
$password = 'Z6aAiV24';
$pdo = new PDO($dsn,$user,$password);


$sql= "CREATE TABLE tbtest"//mission3-2 テーブル作成
." ("
. "id INT,"
. "name char(32),"
. "comment TEXT"
.");";
$stmt = $pdo -> query($sql);

$sql ='SHOW TABLES';//mission3-3　テーブル表示
$result = $pdo -> query($sql);
foreach ($result as $row){
	echo $row[0];
	echo '<br>';
}
echo "<hr>";//水平罫線

$sql ='SHOW CREATE TABLE tbtest';//mission3-4　テーブル表示・作成
$result = $pdo -> query($sql);
foreach ($result as $row){
	print_r($row);
}
echo "<hr>";

$sql = $pdo -> prepare("INSERT INTO tbtest (id,name, comment) VALUES ('1',:name, :comment)");//mission3-5　データ入力
$sql -> bindParam(':name', $name, PDO::PARAM_STR);
$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
$name = '土屋';
$comment = 'コメント';
$sql -> execute();

$sql = 'SELECT * FROM tbtest';//mission3-6　データ表示
$results = $pdo -> query($sql);
foreach ($results as $row){//$rowの中にはテーブルのカラム名が入る
	echo $row['id'].',';
	echo $row['name'].',';
	echo $row['comment'].'<br>';
}

$id = 1;
$nm = "名前";//mission3-7 データをupdateによって編集する
$kome = "言葉"; //好きな名前、好きな言葉は自分で決めること
$sql = "update tbtest set name='$nm' , comment='$kome' where id = $id";
$result = $pdo->query($sql);

$id = 1;// 入力したデータをdeleteによって削除する
$sql = "delete from tbtest where id=$id";
$result = $pdo->query($sql);
?>
</body>

</html>
