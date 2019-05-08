<html>

<head>
<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<title>
3-2
</title>
</head>

<body>
<?php
$dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost'; 
$user = 'tt-160.99sv-coco';
$password = 'Z6aAiV24';
$pdo = new PDO($dsn,$user,$password);

$sql= "CREATE TABLE tbtest"
." ("
. "id INT,"
. "name char(32),"
. "comment TEXT" .");";
$stmt = $pdo->query($sql);
?>
</body>

</html>