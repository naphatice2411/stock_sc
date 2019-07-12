<?php
    $ret;
    foreach($_SESSION['cart'] as $k=>$v){
        $insertData=array(
            'supid'=>$k,
            'amount'=>$v['amount'],
            'type'=>3,
            'remark'=>'"'.$v['remark'].'"',
            'userid'=>current_user('user_id'),
            'line'=>$v['line']
        );

        $Amount=selectTb('supplies','remain_amount,min','id="'.$insertData['supid'].'"');        
        $remainAmount=$Amount[0]['remain_amount'];
        $min=$Amount[0]['min'];
        $remainAmount-=$insertData['amount'];
        if($remainAmount>0&&$remainAmount<$min)$statusid=3;
        else if($remainAmount>=$min)$statusid=1;
        else $statusid=2;
        $isUpdated=updateTb('supplies',array("remain_amount"=>$remainAmount,"statusid"=>$statusid),'id="'.$insertData['supid'].'"');   
        $isInserted=insertTb('transaction',$insertData);
    }

    if($isUpdated&&$isInserted)$_SESSION['cart']=null;

    $res=array(
        code=>array(
            update=>$isUpdated?200:400,
            insert=>$isInserted?200:400
        ),
        status=>$isInserted&&$isUpdated?"ดำเนินการเบิกเรียบร้อยแล้ว":"เกิดข้อผิดพลาด ไม่สามารถดำเนินการเบิกได้",
    );
    echo json_encode($res);
    // echo json_encode($_SESSION['cart']);

    // $_SESSION['cart'][1]    
    // $_SESSION['cart'][2]
    
