<?php
	session_start();
	$result = 'SESSIONS: '.$_SESSION["authen"]."<br>COOKIES: ".$_COOKIE["localhostsite"]."<br>";
	echo $result;
?>