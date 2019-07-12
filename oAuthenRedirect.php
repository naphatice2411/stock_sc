<?php
header('Content-Type: text/html; charset=utf-8');
define('INDEX_PATH',str_replace('\\','/',dirname(__FILE__)).'/');
session_start();
print_r($_GET);
// exit();
include('system/include/config.php');
if($_GET['code']){
    $_SESSION['google_code']=$_GET['code'];
    redirect(site_url('signin/login/google/redirect'),true);
}