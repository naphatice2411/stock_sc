<?php
    $data['isApprove']="'0'";

    updateTb('req_material',$data,'id="'.$_POST['docId'].'"');

    if(updateTb){
        print "ทำเครื่องหมายแล้ว";
    }
    else print "ไม่สามารถอทำเครื่องหมายได้";


?>