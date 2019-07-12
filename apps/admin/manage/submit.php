<?php
load_fun('tinyDB');
$_SESSION['inputNameSite']=$_POST['inputNameSite'];
print(json_encode($_POST));
$_SESSION['siteConfig']['siteName']=$_POST['inputNameSite'];
$_SESSION['siteConfig']['subName']=$_POST['inputSubNameSite'];

if($_POST['save']=="display"){
        update_system_config('siteName',$_POST['inputNameSite']);
        update_system_config('subName',$_POST['inputSubNameSite']);
}

if($_POST['save']=="oAuthen"){
		update_system_config('activeGoogleOpenID',$_POST['activeGoogleOpenID']);
        update_system_config('googleAppID',$_POST['inputGoogleAppID']);
        update_system_config('googleAppSecret',$_POST['inputGoogleAppSecret']);
}
?>