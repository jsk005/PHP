<?php
if (!isset($_SESSION)) {
    session_start();
}
$_SESSION = array();
session_destroy();
echo 'You have cleaned session';
header('Refresh: 1; URL = loginForm.php');
?>