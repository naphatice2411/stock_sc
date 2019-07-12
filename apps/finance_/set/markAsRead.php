<?php
    $data['isApprove']="'1'";

    updateTb('req_material',$data,'id="'.$_POST['docId'].'"');

    if(updateTb){
        print "ทำเครื่องหมายแล้ว";
    }
    else print "ไม่สามารถทำเครื่องหมายได้";


?>