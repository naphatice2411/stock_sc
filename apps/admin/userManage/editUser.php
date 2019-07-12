<?php
        $updateData=array(
            'user_type'=>$_POST['is_admin']&&$_POST['is_admin']=="true"?'"administrator"':"'user'"
        );
        $isUpdate=updateTb('userdata',$updateData,'user_id="'.$_POST['user_id'].'"');
        $ret=array(
            code=>$isUpdate?200:400,
            status=>$isUpdate?"อัพเดตข้อมูลเรียบร้อยแล้ว":"ไม่สามารถอัพเดตข้อมูลได้"
        );
        echo json_encode($ret);
    