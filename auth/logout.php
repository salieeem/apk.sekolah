<?php

session_start();

session_unset();
$_session = [];



header("Location: login.php");
exit;


?>