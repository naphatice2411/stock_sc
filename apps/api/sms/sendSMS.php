<?php
load_fun('TinyDB');
load_fun('thaibulk');
//print_r($hGET);

$username=$hGET['u'];
$password=md5($hGET['p']);
$tagID=$hGET['t'];

$userID=selectTb('userdata','user_id','username="'.$username.'" and password="'.$password.'" limit 1');
if(count($userID)){
    $userID=$userID[0]['user_id'];
//    print($userID);
}else{
    print 'ชื่อผู้ใช้/รหัสผ่านไม่ถูกต้อง<br>';
    exit();
}

$msgData=selectTb('msgData','msg','user_id="'.$userID.'" and tagID="'.$tagID.'" limit 1');
if(count($msgData)){
    $msgData=$msgData[0]['msg'];
//    print $msgData;
}else{
    print 'ไม่พบข้อมูลข้อความในระบบ!<br>';
    exit();
}

$remainSMS=selectTb('msgData','remainSMS','user_id="'.$userID.'" and isConfirm="0" limit 1');
$remainSMS=$remainSMS[0]['remainSMS'];
if($remainSMS<=0){
    print 'คุณมีข้อความคงเหลือไม่เพียงพอต่อการใช้บริการ';
    exit();
}
$phoneNo=selectTb('msgData','mobile','user_id="'.$userID.'" and tagID="'.$tagID.'" and isSentSMS="1" limit 1');
if(count($phoneNo)){
    $phoneNo=$phoneNo[0]['mobile'];
    $message='Warning! [TagID : '.$tagID.'] '.$msgData;
    sendWarnSMS('WARNING', array($phoneNo), $message,1, $userID);
    print 'ส่ง SMS แจ้งเตือนเสร็จสมบูรณ์<br>';
}else print 'ไม่พบข้อมูล--ท่านอาจไม่ได้เปิดการแจ้งเตือนทาง SMS<br>';

$emailAddr=selectTb('msgData','email','user_id="'.$userID.'" and tagID="'.$tagID.'" and isSentEmail="1" limit 1');
if(count($emailAddr)){
    $emailAddr=$emailAddr[0]['email'];
    $mailData=array(
        'addr'=>$emailAddr,
        'tagID'=>$tagID,
        'message'=>$msgData,
        'userID'=>$userID,
    );
    sendWarnMail($mailData);
    print 'ส่งอีเมล์แจ้งเตือนเสร็จสมบูรณ์<br>';
}else print 'ไม่พบข้อมูล--ท่านอาจไม่ได้เปิดการแจ้งเตือนทาง Email<br>';