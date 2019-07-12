<?php

// print_r($_POST);
// exit();
$data['dept_id']="'".$_POST['dept_id']."'";
$data['position']="'".$_POST['position']."'";
$data['title']="'".$_POST['title']."'";
$data['name']="'".$_POST['name']."'";
$data['surname']="'".$_POST['surname']."'";
$data['default_uri']="''";

$data=array(
  'dept_id'=>"'".$_POST['dept_id']."'",
  'position'=>"'".$_POST['position']."'",
  'title'=>"'".$_POST['title']."'",
  'name'=>"'".$_POST['name']."'",
  'surname'=>"'".$_POST['surname']."'",
  'default_uri'=>"''",
  'mobile'=>'"'.$_POST['mobile'].'"',
);



  updateTb("userdata",$data,"user_id=".current_user('user_id'));

  if(updateTb){
    print "แก้ไขข้อมูลแล้ว โปรดโหลดหน้านี้ซ้ำเพื่อปรับการแสดงผล";
    signInUser(current_user('user_id'),false,$noRedirect=true);
  }

  else print "ไม่สามารถปรับปุงข้อมูลได้";