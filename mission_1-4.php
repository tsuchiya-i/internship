<html>

<head>
<title>
���̓t�H�[��
</title>
</head>

<form method="post" action="mission_1-4.php">

<input type="text" name="comment" value="�R�����g"><br/>
<input type="submit" value="���M����"><br/>

</form>

</p>
<?php
$comment = $_POST['comment'];
if(isset($_POST['comment'])){
$comment = $_POST['comment'];
echo "�����͂��肪�Ƃ��������܂��B<br/>";
echo date('Y/m/d H:i') . '��' . $comment . '���󂯕t���܂����B';
}
?>
</p>

</html>

