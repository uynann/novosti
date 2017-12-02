<?php
session_start();
unset($_SESSION);
setcookie("id", "", time() - 60*60);
$_COOKIE["id"] = "";
session_destroy();
header("Location: " . "/my-site-6");

