<html>

<head>
<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<title>
入力フォーム
</title>
</head>


<form method="post" action="mission_1-7.php">

<input type="text" name="comment" value="コメント"><br/>
<input type="submit" value="送信する"><br/>

</form>

</p>
<?php
$filename = 'mission_1-7_Tsuchiya.txt'; //ファイルの名前変数を作成

if(isset($_POST['comment']) and $_POST['comment']!==''){ //$_POST['comment']が空でなく、NULL出ない時実行
$comment = $_POST['comment']; //POSTで送信されたtextのnameを指定し、commentに代入。

$ifp = fopen($filename,'a');//ファイル名と開くモードを選択しファイルポインタをifpに代入。
fwrite($ifp, $comment.PHP_EOL);//ifpのファイルポインタに$commentを書き込む。
fclose($ifp);//開いたファイルポインタを閉じる。
echo "入力ありがとう! by土屋<br/>";
}

$fp = @fopen($filename,'r');
$input = @file($filename);
foreach((array)$input as $value){
echo $value.'<br/>';
}
@fclose($fp);
?>
</p>

</html>