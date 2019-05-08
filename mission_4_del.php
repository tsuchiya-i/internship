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
$d_password = $_POST['d_password'];
$set_password = $_POST['set_password'];
$comment = $_POST['comment'];//POSTで送信されたtextのnameを指定し、commentに代入。
$name = $_POST['name'];//POSTで送信されたtextのnameを指定し、commentに代入。
$date = date('Y/m/d G:i:s');
$editmode = 0;//editモード時1になる。
$ini_name = ''; $ini_comment = '';

$dsn = 'mysql:dbname=tt_160_99sv_coco_com;host=localhost';//mission3-1 接続
$user = 'tt-160.99sv-coco';
$password = 'Z6aAiV24';
$pdo = new PDO($dsn,$user,$password);


$sql= "CREATE TABLE keiji"//mission3-2 テーブル作成
." ("
. "editmode INT,"
. "id INT,"
. "name char(32),"
. "comment char(32),"
. "date char(32),"
. "password char(32)"
.");";
$stmt = $pdo -> query($sql);


$sql ='SHOW TABLES';//mission3-3　テーブル表示
$result = $pdo -> query($sql);
foreach ($result as $row){
	echo $row[0];
	echo "aa".$row[1];
	echo '<br>';
}
echo "<hr>";//水平罫線


$id = 0;
$sql = 'SELECT * FROM keiji';//sp　データカウント
$results = $pdo -> query($sql);
foreach ($results as $row){
	$id += 1;
	//echo "id({$id})";
}


if(isset($_POST['soshinn'])){//送信ボタンが押されたとき
	if(isset($_POST['comment']) and $_POST['comment']!=='' and isset($_POST['name']) and $_POST['name']!==''
	 and ((isset($_POST['set_password']) and $_POST['set_password']!=='') or $editmode)){ //$_POST['']が空でなく、NULLでない時実行
		
		$sql = $pdo -> prepare("INSERT INTO keiji (editmode, id, name, comment, date, password) VALUES (:editmode, :id, :name, :comment, :date, :password)");//mission3-5　データ入力
		$sql -> bindParam(':editmode', $editmode, PDO::PARAM_INT);
		$sql -> bindParam(':id', $id, PDO::PARAM_INT);
		$sql -> bindParam(':name', $name, PDO::PARAM_STR);
		$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
		$sql -> bindParam(':date', $date, PDO::PARAM_STR);
		$sql -> bindParam(':password', $set_password, PDO::PARAM_STR);
		//echo $name.$set_password.'<br/>';
		$sql -> execute();



		/*
		if(!$editmode){
			$ifp = fopen($filename,'a');
			fwrite($ifp, $countnum.'<>'.$name.'<>'.$comment.'<>'.date('Y/m/d G:i:s').'<>'.$set_password.PHP_EOL);
		}
		fclose($ifp);//開いたファイルポインタを閉じる。
		$ini_name = ''; $ini_comment = '';
		*/
	}
}
/*
$sql ='SHOW TABLES';//mission3-3　テーブル表示
$result = $pdo -> query($sql);
foreach ($result as $row){
	echo $row[0];
	echo '<br>';
}
echo "<hr>";//水平罫線


*/

/*
$id = 1;// mission3-8入力したデータをdeleteによって削除する 
$sql = "delete from keiji where id=$id";
$result = $pdo->query($sql);
*/



/*
$id = 1;
$nm = "名前";//mission3-7 データをupdateによって編集する
$kome = "言葉"; //好きな名前、好きな言葉は自分で決めること
$sql = "update keiji set name='$nm' , comment='$kome' where id = $id";
$result = $pdo->query($sql);
*/


$sql= "drop table keiji"; //テーブル削除
$stmt = $pdo -> query($sql);
?>

<form method="post" action="mission_4.php">
	<input type="text" name="name" placeholder="名前" value = "<?php echo $ini_name; ?>"><br/>
	<input type="text" name="comment" placeholder="コメント" value = "<?php echo $ini_comment; ?>"><br/>
	<input type="text" name="set_password" placeholder="パスワード" value = "">
	<input type="submit" value="送信" name ="soshinn"><br/><br/>
	<input type="text" name="delete" placeholder="削除対象番号"><br/>
	<input type="text" name="d_password" placeholder="パスワード" value = "">
	<input type="submit" value="削除" name ="sakujo"><br/><br/>
	<input type="text" name="edit" placeholder="編集対象番号"><br/>
	<input type="text" name="e_password" placeholder="パスワード" value = "">
	<input type="submit" value="編集" name ="hensyu"><br/>
</form>
<?php
for($i=1; $i<$id+1; $i++){
	$sql = "SELECT * FROM keiji where id = {$i};";//mission3-6　データ表示
	//echo '<br/>'.$sql.'<br/>';
	$results = $pdo -> query($sql);
	foreach ($results as $row){//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['date'].',';
		echo $row['password'].'<br>';
	}
}
?>
</body>

</html>