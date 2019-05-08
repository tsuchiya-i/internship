<html>
  <head>
    <?php require_once "lib/random.php"; ?>
    <?php header("Content-Type: text/html; charset=UTF-8"); ?>
  </head>
  <body>
    <?php

      $length = 10;
      echo substr(bin2hex(random_bytes($length)), 0, $length);
    ?>
  </body>
</html>
