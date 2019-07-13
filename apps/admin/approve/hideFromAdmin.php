<?php
    $updateData=array(
        'is_adminconfirm'=>1
    );

    $isUpdated=updateTb('order',$updateData,'id="'.$_POST['id'].'"');

    $ret=array(
        code=>$isUpdated?200:400,
        status=>$isUpdated?"อัพเดตข้อมูลเรียบร้อยแล้ว":"ไม่สามารถอัพเดตข้อมูลได้"
    );

    echo json_encode($ret);