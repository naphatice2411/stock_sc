<?php
  
function signInUser($userID,$remember=false,$noRedirest=false){
    $data=selectTb('userdata','*','user_id="'.$userID.'" and active="Y" limit 1');
    if(!count($data)){
        $data=selectTb('userdata','*','user_id="'.$userID.'" and active="N" limit 1');
        if(!count($data)){
            $data=selectTb('userdata','*','user_id="'.$userID.'" and active="B" limit 1');
            if(!count($data)){
                print 'ไม่พบบัญชีของท่านในระบบ';
                redirect(site_url(''),false,5);
            }else{
                print 'บัญชีของท่านถูกจำกัดการใช้งาน';
                redirect(site_url(''),false,5);
            }
        }else{
            print 'บัญชีของท่านยังไม่ได้เปิดใช้งาน';
            redirect(site_url(''),false,5);
        }
    }else{
        $userdata=$data[0];
    //    print_r($userdata); exit;
        $user_id=$userdata['user_id'];
        $username=$userdata['username'];
        $email=$userdata['email'];
        $signup=$userdata['signup'];
        $last_login=$userdata['last_login'];
        $detail=$userdata['detail'];
        
        $dept_id=$userdata['dept_id'];
        $position=$userdata['position'];
        $title=$userdata['title'];
        $name=$userdata['name'];
        $surname=$userdata['surname'];
        $mobile=$userdata['mobile'];
        $user_type=$userdata['user_type'];
        $accession=$userdata['accession'];
        $default_uri=$userdata['default_uri'];
        //print $academy_id; exit();
        $pictureProfile = BASE_PATH."system/pictures/profile/".$username.".png";
        if(!file_exists($pictureProfile)){
            $picture= site_url("system/pictures/profile/noimage.png",true);
        }else{
            $picture= site_url("system/pictures/profile/".$username.".png",true);
            
        }
  
        $time_logon=60*1000;
        
        $logon_data=array(
            "user_id"=>$user_id,
            "username"=>$username,
            "email"=>$email,
            "signup"=>$signup,
            "last_login"=>$last_login,
            "detail"=>$detail,
            "time_logon"=>$time_logon,

            "dept_id"=>$dept_id,
            "position"=>$position,
            "title"=>$title,
            "name"=>$name,
            "surname"=>$surname,
            "mobile"=>$mobile,
            "picture"=>$picture,
            "user_type"=>$user_type,
            "accession"=>$accession,
            "academy_id"=>$academy_id,
            "default_uri"=>$default_uri
        );
        user_logon($logon_data);
  
        if($remember){
            setcookie('last_user',serialize($logon_data), time() + 60*60*24*365, "/");
        }else{
            setcookie('last_user','', time() + 60*60*24*365, "/");
        }

        if(!$noRedirest){
            if($default_uri){
                return $default_uri;
                // redirect($default_uri);
            }else{
                return site_url();
                // redirect(site_url(),true);
            }
        }
    }
}
  
function user_logon($logon_data){
    global $dbCon;
    // print_r($logon_data); exit;
    setcookie('user',serialize($logon_data), time() + $logon_data['time_logon'], "/");
    // print_r($_COOKIE);
    updateTb("userdata",array("last_login"=>"NOW()"),"user_id=".$logon_data['user_id']);
}
  
function current_user($key){
    $user_data=array(
        'user_id'=>''
    );
    if(isset($_COOKIE['user']))$user_data=unserialize($_COOKIE['user']);
//    print_r($user_data);
    if(!$user_data['user_id'])return 0;
    return $user_data[$key];
}
  
function last_user($key){
    if(isset($_COOKIE['last_user']))$user_data=unserialize($_COOKIE['last_user']);
    //print_r($user_data);
    if(!$user_data['user_id'])return 0;
    return $user_data[$key];
}
  
function user_logoff(){
    setcookie('user','', time() + current_user('logon_time'), "/");
    $_SESSION['access_token']="";
    $_SESSION['google_data']="";
    $_SESSION['DB2']="";
    $_COOKIE['PHPSESSID']="";
}
  
function add_user($user_data){
    global $dbCon;
    global $prefix;
    //print $prefix;
    $password=md5($user_data['password']);
    $query = "insert into {$prefix}userdata (username,password,mobile,name,surname,accession,default_uri,signup)";
    $query.=" values ('{$user_data["username"]}','{$password}','{$user_data["mobile"]}','{$user_data["name"]}','{$user_data["surname"]}','{$user_data["accession"]}','{$user_data["default_uri"]}',NOW())";
//  print $query;
   mysqli_query($dbCon,'SET foreign_key_checks = 0');
    // exit();
    $result = mysqli_query($dbCon, $query);
    //print_r($result);
    //print $query;
    if($result){
        return mysqli_insert_id($dbCon);
    }
}
