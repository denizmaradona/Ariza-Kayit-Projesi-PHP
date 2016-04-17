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
            $mail -> Username = "iletisim@okanuzun.com";
            $mail -> Password = "135Okan246";
            $mail -> SetFrom("iletisim@okanuzun.com");

?>