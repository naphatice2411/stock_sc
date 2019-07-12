<?php
    $ordId=$_POST['id'];
    $currStatus=selectTb('order','is_pending','id="'.$ordId.'"')[0]['is_pending'];

    $updateData=array(
        'is_pending'=>$currStatus?0:1,
    );
    $isUpdated=updateTb('order',$updateData,'id="'.$ordId.'"');
    sleep(1);
    $ret=array(
        code=>$isUpdated?200:400,
        html=>$updateData['is_pending']?"<i class='fa fa-hand-stop-o'></i>รอสั่งของ":"<i class='fa fa-hand-stop-o'></i>ของมาแล้ว",
        'class'=>$updateData['is_pending']?"btn btn-warning":"btn btn-info",
    );

    echo json_encode($ret);