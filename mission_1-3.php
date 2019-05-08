<?php
$filename = 'mission_1-2_Tsuchiya.txt';
$fp = fopen($filename,'r');
$input = fgets($fp);
fclose($fp);
echo $input
?>