<?php
    $remainAmount=selectTb('supplies','remain_amount','id="'.$_POST['supplies_id'].'"');
    $remainAmount=$remainAmount[0]['remain_amount'];
    if($_POST['amount']!=""&&$_POST['amount']!=0){
        if($_POST['amount']<=$remainAmount){
            $_SESSION['cart'][$_POST['supplies_id']]=array(
                'amount'=>$_POST['amount'],
                'line'=>$_POST['Line'],
                'remark'=>$_POST['remark']
            );
            $status="เพิ่มจำนวนที่ต้องการเบิกเรียบร้อยแล้ว";
            $code=200;
        }else{
            $status="ไม่สามารถเพิ่มข้อมูลได้ จำนวนวัสดุเกินกว่าที่มี";
            $code=400;
        }
    }else{
        $code=404;
        $status="กรุณากรอกจำนวนที่ต้องการเบิก";
    }
    
    $ret=array(
        code=>$code,
        status=>$status,
        post=>$_POST,
        session=>$_SESSION
    );

    echo json_encode($ret);

