
<?php

	$mysqli = new mysqli("localhost", "goodmanpa2_mc", "Recksoman01", "goodmanpa2_mc");
	$mysqli->set_charset("utf8");

	if ($mysqli->connect_errno) {
		printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
	}
?>