<html>
<head>
	<?php header("Content-Type: text/html; charset=UTF-8"); ?>
	<title>
		2-5
	</title>
</head>

<?php



$filename = 'mission_2-5_Tsuchiya.txt'; //ファイルの名前変数を作成
$count_filename = 'mission_2-5_count_Tsuchiya.txt'; //ファイルの名前変数を作成投稿数格納用
$e_password = $_POST['e_password'];
$d_password = $_POST['d_password'];
$set_password = $_POST['set_password'];
$comment = $_POST['comment'];//POSTで送信されたtextのnameを指定し、commentに代入。
$name = $_POST['name'];//POSTで送信されたtextのnameを指定し、commentに代入。
$editmode = 0;//editモード時1になる。
$ini_name = ''; $ini_comment = '';


$in = @file($filename);//最新のテキストを変数に格納
if(isset($_POST['hensyu'])){//編集ボタンが押されたとき'edit<>'を行の頭に加える。
	if(isset($_POST['edit']) and $_POST['edit']!=='' and isset($_POST['e_password']) and $_POST['e_password']!==''){
		$ifp = fopen($filename,'w');
		foreach((array)$in as $value){
			$element = explode("<>",$value);
			if ($_POST['edit'] == $element[0]){
				if($e_password.PHP_EOL == $element[4]){
					fwrite($ifp,'edit<>');
				}
				else echo '<font color="red">※パスワードが違います。</font>'.'<br/>';
			}
			fwrite($ifp, $value);
		}
		fclose($ifp);
	}
}

$in = @file($filename);//最新のテキストを変数に格納。
foreach((array)$in as $value){ //editのついた行の情報を入力フォームの初期値変数に格納
	$element = explode("<>",$value);
	if ('edit' == $element[0]){
		$ini_name = $element[2];
		$ini_comment = $element[3];
		$editmode = 1;//editmode on
	}
}

$in = @file($filename);//最新のテキストを変数に格納

if(isset($_POST['sakujo'])){//削除ボタンが押されたとき
	if(isset($_POST['delete']) and $_POST['delete']!=='' and isset($_POST['d_password']) and $_POST['d_password']!==''){
		$ifp = fopen($filename,'w');
		foreach((array)$in as $value){
			$element = explode("<>",$value);
			if($_POST['delete'] == $element[0]){
				if($d_password.PHP_EOL == $element[4]) fwrite($ifp,'');
				else{
					fwrite($ifp, $value);
					echo '<font color="red">※パスワードが違います。</font>'.'<br/>';
				}
			}
			else fwrite($ifp, $value);
		}
		fclose($ifp);
	}
}

$in = @file($filename);//最新のテキストを変数に格納
if(isset($_POST['soshinn'])){//送信ボタンが押されたとき
	if(isset($_POST['comment']) and $_POST['comment']!=='' and isset($_POST['name']) and $_POST['name']!==''
	 and ((isset($_POST['set_password']) and $_POST['set_password']!=='') or $editmode)){ //$_POST['']が空でなく、NULLでない時実行

		$cfp = @fopen($count_filename,'r');	//↓
		$countnum = @fgets($cfp);
		if($countnum == '') $countnum=0;
		if(!$editmode) $countnum++;
		$cfp = fopen($count_filename,'w');
		fwrite($cfp, $countnum);
		fclose($cfp);				//↑投稿総数カウントtxt保存プログラム

		$in = @file($filename);

		$ifp = fopen($filename,'w');
		foreach((array)$in as $value){
			$element = explode("<>",$value);
			if($element[0] == 'edit') fwrite($ifp, $element[1].'<>'.$name.'<>'.$comment.'<>'.date('Y/m/d G:i:s').'<>'.$element[5]);
			else fwrite($ifp, $value); //ファイルに書き込み
		}
		if(!$editmode){
			$ifp = fopen($filename,'a');
			fwrite($ifp, $countnum.'<>'.$name.'<>'.$comment.'<>'.date('Y/m/d G:i:s').'<>'.$set_password.PHP_EOL);
		}
		fclose($ifp);//開いたファイルポインタを閉じる。
		$ini_name = ''; $ini_comment = '';
	}
}

?>

<form method="post" action="mission_2-5.php">
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


</p>
<?php

$in = @file($filename);
foreach((array)$in as $value){//webページ画面に表示
	$line = explode("<>",$value);
	foreach((array)$line as $element){
		if($line[0] == 'edit'){
			if($element !== 'edit' and $line[5] !== $element) echo $element.' ';
		}
		elseif($line[4] !== $element) echo $element.' ';
	}
	echo '<br/>';
}

?>
</p>

</html>