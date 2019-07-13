<?php
    $updateData=array(
        'is_approve'=>$_POST['isApprove']
    );
    $isUpdated=updateTb('order',$updateData,'id="'.$_POST['id'].'"');
    $res=array(
        code=>$isUpdated?200:400,
        status=>$isUpdated?"อัพเดตข้อมูลแล้ว":"ไม่สามารถอัพเดตข้อมูลได้",
        post=>$_POST
    );
    echo json_encode($res);