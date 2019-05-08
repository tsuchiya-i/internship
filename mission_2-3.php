<html>

<head>
<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<title>
2-3
</title>
</head>


<form method="post" action="mission_2-3.php">
<input type="submit" value="リセット" name ="reset"><br/><br/>
<input type="text" name="name" placeholder="名前"><br/>
<input type="text" name="comment" placeholder="コメント">
<input type="submit" value="送信" name ="soshinn"><br/><br/>
<input type="text" name="number" placeholder="削除対象番号">
<input type="submit" value="削除" name ="sakujo"><br/>


</form>

</p>
<?php


$filename = 'mission_2-3_Tsuchiya.txt'; //ファイルの名前変数を作成
$count_filename = 'mission_2-3_count_Tsuchiya.txt'; //ファイルの名前変数を作成投稿数格納用

if(isset($_POST['reset'])){//リセットボタンが押されたとき。
	$fp=fopen($filename,'w');
	fwrite(fp,"");
	$fp=fopen($count_filename,'w');
	fwrite(fp,"");
}

$in = @file($filename);

if(isset($_POST['sakujo'])){//削除ボタンが押されたとき
	if(isset($_POST['number']) and $_POST['number']!==''){
		$ifp = fopen($filename,'w');
		foreach((array)$in as $value){
			$N = explode("<>",$value);
			if ($_POST['number'] == $N[0]) fwrite($ifp,'');
			else fwrite($ifp, $value);
		}
		fclose($ifp);
	}
}

if(isset($_POST['soshinn'])){//送信ボタンが押されたとき
	if(isset($_POST['comment']) and $_POST['comment']!=='' and isset($_POST['name']) and $_POST['name']!==''){ //$_POST['comment']が空でなく、NULL出ない時実行
		$cfp = @fopen($count_filename,'r');
		$countnum = @fgets($cfp);
		if($countnum == '') $countnum=0;
		$countnum++;
		$cfp = fopen($count_filename,'w');
		fwrite($cfp, $countnum);
		fclose($cfp);

		$comment = $_POST['comment']; //POSTで送信されたtextのnameを指定し、commentに代入。
		$name = $_POST['name']; //POSTで送信されたtextのnameを指定し、commentに代入。

		$ifp = fopen($filename,'w');
		foreach((array)$in as $value){
			fwrite($ifp, $value);
		}
		$ifp = fopen($filename,'a');
		fwrite($ifp, $countnum.'<>'.$name.'<>'.$comment.'<>'.date('Y/m/d G:i:s').PHP_EOL);
		fclose($ifp);//開いたファイルポインタを閉じる。
	}
}

$in = @file($filename);

foreach((array)$in as $value){
	$data = explode("<>",$value);
	foreach((array)$data as $v2){
		echo $v2.' ';
	}
	echo '<br/>';
}

?>
</p>

</html>