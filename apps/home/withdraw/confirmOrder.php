<?php
    $updateData=array(
        'is_confirm'=>1,
    );

    $isUpdated=updateTb('order',$updateData,'id="'.$_POST['id'].'"');

    $ret=array(
        code=>$isUpdated?200:400,
        status=>$isUpdated?"ยืนยันข้อมูลแล้ว":"ไม่สามารถยืนยันข้อมูลได้",
    );

    echo json_encode(array_merge($ret,$_POST));
?>