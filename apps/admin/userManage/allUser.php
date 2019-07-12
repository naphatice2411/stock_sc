<?php
    $title='จัดการผู้ใช้ทั้งหมด';
    load_fun('box');
    $userTypeData=selectTb('userdata','distinct user_type');
    $userGroup=array();
    foreach($userTypeData as $row){
        $thisUserTypeData=selectTb('userdata','count(*)','user_type="'.$row['user_type'].'" and active="Y"');
//        print_r($thisUserTypeData);
        $userGroup[]=array(
            'title'=>ucfirst($row['user_type']),
            'start_number'=>$thisUserTypeData[0]['count(*)'],
            'end_number'=>$thisUserTypeData[0]['count(*)'],
            'color'=>'blue',
            'icon'=>'fa fa-user',
            'url'=>site_url('main/admin/userManage/listUser/type/'.$row['user_type']),
            'target'=>'',
        );
    }
    print genSmallBox($userGroup);