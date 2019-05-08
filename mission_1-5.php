<html>

<head>
<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<title>
入力フォーム
</title>
</head>


<form method="post" action="mission_1-5.php">

<input type="text" name="comment" value="コメント"><br/>
<input type="submit" value="送信する"><br/>

</form>

</p>
<?php

if(isset($_POST['comment']) and $_POST['comment']!==''){ //$_POST['comment']が空でなく、NULL出ない時実行
$comment = $_POST['comment']; //POSTで送信されたtextのnameを指定し、commentに代入。

$filename = 'mission_1-5_Tsuchiya.txt'; //ファイルの名前変数を作成
$ifp = fopen($filename,'w');//ファイル名と開くモードを選択しファイルポインタをifpに代入。
fwrite($ifp, $comment);//ifpのファイルポインタに$commentを書き込む。
fclose($ifp);//開いたファイルを閉じる。

$fp = fopen($filename,'r');
$input = fgets($fp);
fclose($fp);
echo $input.'<br/>';
}

if($comment == '完成'){
echo 'おめでとう！！';
}

?>
</p>

</html>