<?php
	/*$baglan = mysql_connect(localhost,"root","");
	$vt_sec = mysql_select_db("sistem",$baglan);*/

	$connection = mysqli_connect("localhost", "root", "", "sistem", "3306");
	mysqli_set_charset( $connection, 'utf8');

?>