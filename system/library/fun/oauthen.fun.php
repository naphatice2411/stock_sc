<?php
  
  function pair_user_oauthen($provider,$authen_id,$user_id,$detail){
    global $dbCon;
    $db=$dbCon;
    global $prefix;
    
    $query = "insert into {$prefix}oauthen (provider,authen_id,user_id,detail)";
    $query.=" values ('{$provider}','{$authen_id}','{$user_id}','{$detail}')";
    print $query;
    $result = mysqli_query($db, $query);
    return $result;
  } 
  
  function unlink_social_oauthen($id,$member_id){
    global $dbCon;
    $db=$dbCon;
    global $prefix;
     $query = "delete from {$prefix}oauthen where id='{$id}' AND user_id='{$member_id}' limit 1";
    //print $query;
    $result = mysqli_query($db, $query);
    return $result;
  }
  
  function unpair_user_oauthen($user_id,$provider=false){
     global $dbCon;
     $db=$dbCon;
    global $prefix;
    
    if($provider){
      $query = "delete from {$prefix}oauthen where provider='{$provider}' AND user_id='{$user_id}' limit 1";
    }else{
      $query = "delete from {$prefix}oauthen where user_id='{$user_id}'";
    }
    $result = mysqli_query($db, $query);
    return $result;
  }
  
  function oauthen_check_login($provider,$authen_id){
    global $dbCon;
    $db=$dbCon;
    global $prefix;
      $query="select user_id from {$prefix}oauthen WHERE provider='{$provider}' AND authen_id='{$authen_id}' limit 1";
      $result=mysqli_query($db,$query);
      $oauthen_data=mysqli_fetch_array($result);
      print_r($oauthen_data);
      $user_id=$oauthen_data['user_id'];

        $query = "SELECT * FROM {$prefix}userdata WHERE user_id='{$user_id}' limit 1";

    $result = mysqli_query($db, $query);
    //print_r($result);
      //print $query;
    return mysqli_fetch_array($result);
    
  }

  
  function show_logo($oauthen){
    
    if($oauthen['facebook_enable']||$oauthen['twitter_enable']||$oauthen['google_enable']){
    print "    <hr>
      <strong>ไม่ต้องเสียเวลาหรือสับสนเรื่องรหัสผ่านอีกต่อไป!</strong><br>
      คุณสามารถเข้าสู่ระบบ หรือสมัครสมาชิกผ่านโซเชียลมีเดียต่อไปนี้<br>
      <center>";
      if($oauthen['facebook_enable']) print " <a href=\"".site_url('oauthen/facebook')."\" title=\"ลงชื่อเข้าใช้ด้วย Facebook\"><img src=\"".site_url('image/icon/facebook.png',true)."\"></a>";
    
      if($oauthen['twitter_enable'])print " <a href=\"".site_url('ext/oauthen/twitteroauth/redirect.php',true)."\" title=\"ลงชื่อเข้าใช้ด้วย twitter\"><img src=\"".site_url('image/icon/twitter.png',true)."\"></a>";
      
      if($oauthen['google_enable'])print " <a href=\"".site_url('oauthen/google')."\" title=\"ลงชื่อเข้าใช้ด้วย Gmail\"><img src=\"".site_url('image/icon/google_plus.png',true)."\"></a>";
    print "  </center>";
  }
  }
  
  function chk_exists_acount($provider,$user_id){
    global $dbCon;
    $db=$dbCon;
    global $prefix;
    
    $query="select count(*) from {$prefix}oauthen where provider='$provider' AND authen_id='$user_id' limit 1";
    $data=mysqli_query($db,$query);
    $result=mysqli_fetch_array($data);
//    print_r($result);
    if($result[0]==0&&$provider=='google'){
      $query="select user_id from {$prefix}userdata where username='$user_id' limit 1";
      $data=mysqli_query($db,$query);
      $result=mysqli_fetch_array($data);
      if($result['user_id']){
        $detail=array('gmail'=> $user_id);
        $detail=json_encode($detail);
        pair_user_oauthen('google',$user_id,$result['user_id'],$detail);
      }
    }
    //print $query;
    return $result[0];
  }
  
   function chk_exists_social($provider,$user_id){
    global $dbCon;
    $db=$dbCon;
    global $prefix;
    
    $query="select * from {$prefix}oauthen where provider='$provider' AND member_id='$user_id' limit 1";
    $data=mysqli_query($db,$query);
    $result=mysqli_fetch_array($data);
   
     //print $query;
     if(mysqli_num_rows($data)){
       return $result;
     }else{
       return false;
     }
  }
  
  