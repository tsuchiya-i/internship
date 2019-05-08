<html>

<head>
<title>
入力フォーム
</title>
</head>

<form method="post" action="mission_1-4.php">

<input type="text" name="comment" value="コメント"><br/>
<input type="submit" value="送信する"><br/>

</form>

</p>
<?php
$comment = $_POST['comment'];
if(isset($_POST['comment'])){
$comment = $_POST['comment'];
echo "ご入力ありがとうございます。<br/>";
echo date('Y/m/d H:i') . 'に' . $comment . 'を受け付けました。';
}
?>
</p>

</html>

