<?php
session_start();
include_once('../root.php');

$_SESSION["authenticated"] = false;
$_SESSION['message']['success'] = 'logout';
header("Location: " . get_current_dir_root() . '/');
