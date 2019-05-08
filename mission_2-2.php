<html>

<head>
<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<title>
2-2
</title>
</head>


<form method="post" action="mission_2-2.php">
<input type="submit" value="リセット" name ="reset"><br/><br/>
<input type="text" name="name" placeholder="名前"><br/>
<input type="text" name="comment" placeholder="コメント">
<input type="submit" value="送信する"><br/>

</form>

</p>
<?php
$filename = 'mission_2-2_Tsuchiya.txt'; //ファイルの名前変数を作成

if(isset($_POST['reset'])){//リセットボタンが押されたとき。
	$fp=fopen($filename,'w');
	fwrite(fp,"");
}

$fp = @fopen($filename,'r');
$in = @file($filename);
$countnum = count($in)+1;

if(isset($_POST['comment']) and $_POST['comment']!=='' and isset($_POST['name']) and $_POST['name']!==''){ //$_POST['comment']が空でなく、NULL出ない時実行
	$comment = $_POST['comment']; //POSTで送信されたtextのnameを指定し、commentに代入。
	$name = $_POST['name']; //POSTで送信されたtextのnameを指定し、commentに代入。

	$ifp = fopen($filename,'a');//ファイル名と開くモードを選択しファイルポインタをifpに代入。
	if($in=='') fwrite($ifp, '1<>'.$name.'<>'.$comment.'<>'.date('Y/m/d G:i:s').PHP_EOL);
	else fwrite($ifp, $countnum.'<>'.$name.'<>'.$comment.'<>'.date('Y/m/d G:i:s').PHP_EOL);
	fclose($ifp);//開いたファイルポインタを閉じる。
}
$in = @file($filename);
foreach((array)$in as $value){
	$data = explode("<>",$value);
	foreach((array)$data as $v2){
		echo $v2.' ';
	}
	echo '<br/>';
}
@fclose($fp);

?>
</p>

</html>