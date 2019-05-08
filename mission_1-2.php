<?php
$filename = 'mission_1-2_Tsuchiya.txt';
$fp = fopen($filename,'w');
fwrite($fp, 'test');
fclose($fp);
?>