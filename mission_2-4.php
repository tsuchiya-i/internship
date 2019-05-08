<html>

<head>
<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<title>
2-4
</title>
</head>

<form method="post" action="mission_2-4.php">

<?php
$filename = 'mission_2-4_Tsuchiya.txt'; //ファイルの名前変数を作成
$count_filename = 'mission_2-4_count_Tsuchiya.txt'; //ファイルの名前変数を作成投稿数格納用
$editmode = 0;//editモード時1になる。

if(isset($_POST['reset'])){//リセットボタンが押されたとき。
	$fp=fopen($filename,'w');
	fwrite(fp,"");
	$fp=fopen($count_filename,'w');
	fwrite(fp,"");
}

$in = @file($filename);
if(isset($_POST['hensyu'])){//編集ボタンが押されたと'edit<>'を行の頭に加える。
	if(isset($_POST['edit']) and $_POST['edit']!==''){
		$ifp = fopen($filename,'w');
		foreach((array)$in as $value){
			$element = explode("<>",$value);
			if ($_POST['edit'] == $element[0]){
				fwrite($ifp,'edit<>');
			}
			fwrite($ifp, $value);
		}
		fclose($ifp);
	}
}

$in = @file($filename);
$name = ''; $comment = '';
foreach((array)$in as $value){ //editのついた行の情報を入力フォームの初期値変数に格納
	$element = explode("<>",$value);
	if ('edit' == $element[0]){
		$name = $element[2];
		$comment = $element[3];
		$editmode = 1;
	}
}

if(isset($_POST['soshinn'])){//編集内容送信されたらフォーム初期値初期化
	if(isset($_POST['comment']) and $_POST['comment']!=='' and isset($_POST['name']) and $_POST['name']!==''){
		$name = ''; $comment = '';
	}
}
?>
<input type="submit" value="リセット" name ="reset"><br/><br/>
<input type="text" name="name" placeholder="名前" value = "<?php echo $name; ?>"><br/>
<input type="text" name="comment" placeholder="コメント" value = "<?php echo $comment; ?>">
<input type="submit" value="送信" name ="soshinn"><br/><br/>
<input type="text" name="delete" placeholder="削除対象番号">
<input type="submit" value="削除" name ="sakujo"><br/><br/>
<input type="text" name="edit" placeholder="編集対象番号">
<input type="submit" value="編集" name ="hensyu"><br/>

</form>


</p>
<?php

$in = @file($filename);

if(isset($_POST['sakujo'])){//削除ボタンが押されたとき
	if(isset($_POST['delete']) and $_POST['delete']!==''){
		$ifp = fopen($filename,'w');
		foreach((array)$in as $value){
			$element = explode("<>",$value);
			if ($_POST['delete'] == $element[0]) fwrite($ifp,'');
			else fwrite($ifp, $value);
		}
		fclose($ifp);
	}
}


if(isset($_POST['soshinn'])){//送信ボタンが押されたとき
	if(isset($_POST['comment']) and $_POST['comment']!=='' and isset($_POST['name']) and $_POST['name']!==''){ //$_POST['comment']が空でなく、NULL出ない時実行

		$cfp = @fopen($count_filename,'r');	//↓
		$countnum = @fgets($cfp);
		if($countnum == '') $countnum=0;
		if(!$editmode) $countnum++;
		$cfp = fopen($count_filename,'w');
		fwrite($cfp, $countnum);
		fclose($cfp);				//↑投稿総数カウントtxt保存プログラム


		$in = @file($filename);
		$comment = $_POST['comment']; //POSTで送信されたtextのnameを指定し、commentに代入。
		$name = $_POST['name']; //POSTで送信されたtextのnameを指定し、commentに代入。

		$ifp = fopen($filename,'w');
		foreach((array)$in as $value){
			$element = explode("<>",$value);
			if($element[0] == 'edit') fwrite($ifp, $element[1].'<>'.$name.'<>'.$comment.'<>'.date('Y/m/d G:i:s').PHP_EOL);
			else fwrite($ifp, $value); //ファイルに書き込み
		}
		if(!$editmode){
			$ifp = fopen($filename,'a');
			fwrite($ifp, $countnum.'<>'.$name.'<>'.$comment.'<>'.date('Y/m/d G:i:s').PHP_EOL);
		}
		fclose($ifp);//開いたファイルポインタを閉じる。
	}
}

$in = @file($filename);

foreach((array)$in as $value){
	$data = explode("<>",$value);
	foreach((array)$data as $v2){
		if($data[0]!=='edit' or $v2 !== 'edit') echo $v2.' ';
	}
	echo '<br/>';
}

?>
</p>

</html>