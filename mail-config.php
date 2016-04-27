<?php
      require_once 'class.phpmailer.php';
      $mail = new phpmailer();
      error_reporting(0);
      $mail -> IsSMTP();
      $mail -> SMTPDebug = 1;
      $mail -> SMTPAuth = true;
      $mail -> SMTPSecure = 'ssl';
      $mail -> Host = 'smtp.yandex.com.tr';
      $mail -> Port = 465;
      $mail -> IsHTML(true);
      $mail -> CharSet = 'utf-8';
      $mail -> Username = "ariza.kayit@yandex.com";
      $mail -> Password = "135anil246";
      $mail -> SetFrom("ariza.kayit@yandex.com");
?>