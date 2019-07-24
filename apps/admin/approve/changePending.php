<?php
    $data=json_decode($_POST['val'],true);
    // print_r($data);
    $ordId=$data['id'];
    $ordData=selectTb('order','supid,is_pending','id="'.$ordId.'"')[0];
    $currStatus=$ordData['is_pending'];
    $isUpdatedSupply=1;
    if($currStatus){
        if($ordData['supid']!=null){
            $supplyData=selectTb('supplies','min,remain_amount','id="'.$ordData['supid'].'"')[0];
            $currentRemain=$supplyData['remain_amount'];
            $min=$supplyData['min'];
            
            $updateSupply=array(
                'remain_amount'=>$data['amount']+$currentRemain,
            );
            if($updateSupply['remain_amount']>0){
                if($updateSupply['remain_amount']<$min)$updateSupply['statusid']=3;
                else $updateSupply['statusid']=1;                
            }
            else $updateSupply['statusid']=2;

            $isUpdatedSupply=updateTb('supplies',$updateSupply,'id="'.$ordData['supid'].'"');
        }
    }
    $updateData=array(
        'is_pending'=>$currStatus?0:1,
    );
    $isUpdated=updateTb('order',$updateData,'id="'.$ordId.'"');
    sleep(1);
    $ret=array(
        code=>$isUpdated&&$isUpdatedSupply?200:400,
        html=>$updateData['is_pending']?"<i class='fa fa-hand-stop-o'></i>รอสั่งของ":"<i class='fa fa-hand-stop-o'></i>ของมาแล้ว",
        'class'=>$updateData['is_pending']?"btn btn-warning":"btn btn-info",
    );

    echo json_encode($ret);