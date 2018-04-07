<?php
#SETS $_SESSION['username'] values
session_start();
$u = $_POST['u'];
$_SESSION['username'] = $u;
?>