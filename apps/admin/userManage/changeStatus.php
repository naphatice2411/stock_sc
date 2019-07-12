<?php
$user_id=pq($hGET['id']);

sleep(1);
function togleStaatus($user_id){
    
    $userData=selectTb('userdata','active','user_id='.$user_id.' limit 1');
    $userData=$userData[0];
    
    if($userData['active']==''||$userData['active']=='N'){
        updateUserStatus($user_id,'Y');
        $class="fa fa-thumbs-o-up";
        $txt='เปิดใช้งาน';
        $color='btn-success';
    }else if($userData['active']=='Y'){
        updateUserStatus($user_id,'B');
        $class="fa fa-hand-stop-o";
        $txt='ปิดกั้น';
        $color='btn-danger';
    }else if($userData['active']=='B'){
        updateUserStatus($user_id,'Y');
        $class="fa fa-thumbs-o-up";
        $txt='เปิดใช้งาน';
        $color='btn-success';
    }
    $arr=array(
      "<i id='iconStatus' class='".$class."'></i> ".$txt,
        'btn '.$color.' col-sm-9'
    );
    return $arr;
}

function updateUserStatus($user_id,$status){
    $update = updateTb('userdata',array('active'=>'"'.$status.'"'),'user_id='.$user_id.' limit 1');
    return $update;
}


print json_encode(togleStaatus($user_id));
