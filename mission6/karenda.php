<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php
    function color_get($i) {
        if ($i == 0) return '#ff0000'; elseif ($i == 6) return '#0000ff'; else return '#000000';
    }
    $m = $_GET['m'];
    if ($m) {
        $year = date('Y', strtotime($m . '01'));
        $month = date('n', strtotime($m . '01'));
    } else {
        $year = date('Y');
        $month = date('n');
    }
    $day = date('j');
    $weekday = array('日', '月', '火', '水', '木', '金', '土');
    echo '<TABLE cellpadding="4" cellspacing="1" style="background-color : #aaaaaa;text-align : center;">
    <CAPTION style="padding : 4px;"><A href="?m=' . date('Ym', mktime(0, 0, 0, $month , 1, $year - 1)) . "&id=$id&hash=$hash" . '">&lt;&lt;</A>
    <A href="?m=' . date('Ym', mktime(0, 0, 0, $month - 1 , 1, $year)) . "&id=$id&hash=$hash" . '">&lt;</A> ' . $year . '年' . $month . '月
    <A href="?m=' . date('Ym', mktime(0, 0, 0, $month + 1 , 1, $year)) . "&id=$id&hash=$hash" . '">&gt;</A>
    <A href="?m=' . date('Ym', mktime(0, 0, 0, $month , 1, $year + 1)) . "&id=$id&hash=$hash" . '">&gt;&gt;</A>
    </CAPTION><TBODY><TR>';
    $i = 0;
    while ($i <= 6) {
        $c = color_get($i);
        echo '<TD style="color : ' . $c . ';background-color : #eeeeee;">' . $weekday[$i] . '</TD>';
        $i++;
    }
    echo '</TR><TR>';
    $i = 0;
    while ($i != date('w', mktime(0, 0, 0, $month, 1, $year))) {
        echo '<TD style="background-color : #ffffff;">　</TD>';
        $i++;
    }
    for ($days = 1; checkdate($month, $days, $year); $days++) {
        if ($i > 6) {
            echo '</TR><TR>';
            $i = 0;
        }
        $c = color_get($i);
        if ($days == $day) $bc = '#ffff00'; else $bc = '#ffffff';

        echo '<TD style="color : ' . $c . ';background-color : ' . $bc . ';">';
        echo "<a class='link_button' href='edit.php?m=$m&days=$days&id=$id&hash=$hash'>";
        echo $days;
        echo "</a>";
        echo '</TD>';

        $i++;
    }
    while ($i < 7) {
        echo '<TD style="background-color : #ffffff;">　</TD>';
        $i++;
    }
    echo '</TR></TBODY></TABLE>';
    ?>




  </body>
</html>
