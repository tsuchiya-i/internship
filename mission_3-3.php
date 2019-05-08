<html>

<head>
<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<title>
3-3
</title>
</head>

<body>
<?php
$dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost'; 
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

?>
</body>

</html>