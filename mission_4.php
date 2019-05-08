<html>
<head>
	<?php header("Content-Type: text/html; charset=UTF-8"); ?>
	<title>
		mission4
	</title>
</head>

<body>
<?php
$e_password = $_POST['e_password'];
$e_id = $_POST['edit'];
$d_password = $_POST['d_password'];
$d_id = $_POST['delete'];
$set_password = $_POST['set_password'];
$comment = $_POST['comment'];//POSTで送信されたtextのnameを指定し、commentに代入。
$name = $_POST['name'];//POSTで送信されたtextのnameを指定し、commentに代入。
$date = date('Y/m/d G:i:s');
$editmode = 0;//editモード時1になる。
$ini_name = ''; $ini_comment = ''; $ini_password = '';

$dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost';//mission3-1 接続
$user = 'tt-160.99sv-coco';
$password = 'Z6aAiV24';
$pdo = new PDO($dsn,$user,$password);

$sql= "CREATE TABLE keiji"//mission3-2 テーブル作成
." ("
. "editmode INT,"
. "id INT,"
. "name char(32),"
. "comment char(128),"
. "date char(32),"
. "password char(32)"
.");";
$stmt = $pdo -> query($sql);

$sql = 'SELECT MAX(id) + 1 FROM keiji';//newカウント
$results = $pdo -> query($sql);
$max_id = $results -> fetchAll();
$id = $max_id[0][0];
if($id == '') $id = 1;

$sql = 'SELECT id, editmode FROM keiji';
$results = $pdo -> query($sql);
$all = $results->fetchAll();
foreach($all as $id_em){
	if($id_em['editmode']){
		$eid = $id_em['id'];
		$editmode++;
	}
}


if(isset($_POST['soshinn'])){//送信ボタンが押されたとき
	if(isset($_POST['comment']) and $_POST['comment']!=='' and isset($_POST['name']) and $_POST['name']!==''
	 and (isset($_POST['set_password']) and $_POST['set_password']!=='')){ //$_POST['']が空でなく、NULLでない時実行
		if($editmode){
			$sql = "update keiji set name='$name', comment='$comment', editmode=0, password='$set_password', date='$date' where id='$eid'";
			$result = $pdo->query($sql);
		}
		else{//editmode off(0)なら
			$sql = $pdo -> prepare("INSERT INTO keiji (editmode, id, name, comment, date, password) VALUES (:editmode, :id, :name, :comment, :date, :password)");//mission3-5　データ入力
			$sql -> bindParam(':editmode', $editmode, PDO::PARAM_INT);
			$sql -> bindParam(':id', $id, PDO::PARAM_INT);
			$sql -> bindParam(':name', $name, PDO::PARAM_STR);
			$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
			$sql -> bindParam(':date', $date, PDO::PARAM_STR);
			$sql -> bindParam(':password', $set_password, PDO::PARAM_STR);
			$sql -> execute();
		}
	}
}

if(isset($_POST['sakujo'])){//削除ボタンが押されたとき
	if(isset($_POST['delete']) and $_POST['delete']!=='' and isset($_POST['d_password']) and $_POST['d_password']!==''){
		$sql = 'SELECT password, id FROM keiji';//newカウント
		$results = $pdo -> query($sql);
		$all = $results->fetchAll();
		foreach($all as $id_pass){
			if($id_pass['id'] == $d_id){
				if($d_password == $id_pass['password']){
					$sql = "delete from keiji where id=$d_id";
					$result = $pdo->query($sql);
				}
				else echo '<font color="red">※パスワードが違います。</font>'.'<br/>';
			}
		}
	}
}

if(isset($_POST['hensyu'])){//編集ボタンが押されたとき
	if(isset($_POST['edit']) and $_POST['edit']!=='' and isset($_POST['e_password']) and $_POST['e_password']!=='' and !$editmode){
		$sql = 'SELECT id, name, comment, password FROM keiji';
		$results = $pdo -> query($sql);
		$all = $results->fetchAll();
		foreach($all as $INCP){
			if($INCP['id'] == $e_id){
				if($e_password == $INCP['password']){
					$sql = "update keiji set editmode=1 where id = $e_id";
					$result = $pdo->query($sql);
					$ini_name = $INCP['name'];
					$ini_comment = $INCP['comment'];
					$ini_password = $INCP['password'];
				}
				else echo '<font color="red">※パスワードが違います。</font>'.'<br/>';
			}
		}
	}
	elseif($editmode) echo '<font color="red">※一度に編集できるのは１つです。</font>'.'<br/>';
}

?>

<form method="post" action="mission_4.php">
	<input type="text" name="name" placeholder="名前" value = "<?php echo $ini_name; ?>"><br/>
	<input type="text" name="comment" placeholder="コメント" value = "<?php echo $ini_comment; ?>"><br/>
	<input type="text" name="set_password" placeholder="パスワード" value = "<?php echo $ini_password; ?>">
	<input type="submit" value="送信" name ="soshinn"><br/><br/>
	<input type="text" name="delete" placeholder="削除対象番号"><br/>
	<input type="text" name="d_password" placeholder="パスワード" value = "">
	<input type="submit" value="削除" name ="sakujo"><br/><br/>
	<input type="text" name="edit" placeholder="編集対象番号"><br/>
	<input type="text" name="e_password" placeholder="パスワード" value = "">
	<input type="submit" value="編集" name ="hensyu"><br/>
</form>
<hr>
<?php
for($i=1; $i<$id+1; $i++){
	$sql = "SELECT * FROM keiji where id = {$i};";//mission3-6　データ表示
	$results = $pdo -> query($sql);
	foreach ($results as $row){//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].' ';
		echo $row['name'].' ';
		echo $row['comment'].' ';
		echo $row['date'];
		if($row['editmode']) echo '<font color="blue"> ←編集中</font>';
		echo '<br/>';
	}

}

?>
</body>

</html>
