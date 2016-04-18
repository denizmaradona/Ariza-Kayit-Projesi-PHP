<?php
	

	

	if($_POST){
		error_reporting(0);
		require_once 'class.phpmailer.php';
		$mail = new phpmailer();
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
		$mail -> Subject = "Bilgilendirme";
		$mail -> Body = $_POST["mesaj"];
		$mail -> AddAddress($_POST["eposta"]);

		if (!$mail->Send()){
		echo "Basarisiz";
		}
		else{
			echo "Basarili";
		}
	}
	else{
	echo '<form action="" method="post">
			<h2>Kullaniciya Mail Gonder</h2>
			<table cellpading="5" cellspacing="5">
				<tr>
					<td>E-Posta : </td>
					<td><input type="text" name="eposta"/></td>
				<tr>
				<tr>
					<td>Mesaj : </td>
					<td><textarea rows="3" cols="30" name="mesaj"></textarea></td>
				<tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Gonder"/></td>
				<tr>			
			</table>
		</form>';
	}

?>