<?php
  //print_r($_POST);
  load_fun('user');
//  print_r($_POST);
  $status="";
  $code=200;
  $url;

  $username=trim($_POST['username']);
  $password=md5(trim($_POST['password']));
  $data=selectTb('userdata','*','username="'.$username.'" AND password="'.$password.'" limit 1');
  if(!count($data)){
      $status='ชื่อผู้ใช้/รหัสผ่านไม่ถูกต้อง';
      $code=400;
  }else{
    $userdata=$data[0];
    $url=signInUser($userdata['user_id'],$_POST['remember_login']);
  }
  $ret=array(
    code=>$code,
    status=>$status,
    url=>site_url($url)
  );

  echo json_encode($ret);
  //print_r($_COOKIE);