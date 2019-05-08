<html>
  <head>
    <?php
      require_once "lib/random.php";
      require("PHPMailer/class.phpmailer.php");
    ?>
    <meta charset="utf-8" />
  </head>
  <body>
    <?php

    $user_name = $_POST['user_name'];
    $mail_address = $_POST['mail_address'];//宛先
    $password = $_POST['password'];
    $title = '登録ありがとうございます。';
    $mail_authentication = random_int(10000,99999);
    $message = '登録ありがとうございます。'."\r\n".'メール認証はid:'.$mail_authentication.'です。';


    //言語設定、内部エンコーディングを指定する
      mb_language("japanese");
      mb_internal_encoding("UTF-8");
      //日本語添付メールを送る
      $body="以下の内容でフォームより送信されました。nn";
      $body.="本文の内容を入れますn";
      $from = "okuri@plus.vc"; //送り主
      $attachfile = "files/test.xls"; //添付ファイルパス
      $mail = new PHPMailer();
      $mail->CharSet = "iso-2022-jp";
      $mail->Encoding = "7bit";
      $mail->AddAddress($mail_address);
      $mail->From = $from;
      $mail->FromName = mb_encode_mimeheader(mb_convert_encoding($fromname,"JIS","UTF-8"));
      $mail->Subject = mb_encode_mimeheader(mb_convert_encoding($title,"JIS","UTF-8"));
      $mail->Body  = mb_convert_encoding($body,"JIS","UTF-8");
      //添付ファイル追加
      $mail->AddAttachment($attachfile);
      $mail->AddAttachment($attachfile2);
      $mail->Send(); //メール送信
    ?>
  </body>
</html>
