<?php
    if(isset($_POST['isExist'])&&$_POST['isExist']=="true"){
        $existData=selectTb('supplies','pic,name,max,unit,remain_amount','id="'.$_POST['supplies_id'].'"');
        if($existData[0]['remain_amount']+$_POST['amount']>$existData[0]['max'])$status="จำนวนวัสดุเกินกว่าค่าสูงสุดที่อนุญาต";
        else{
            $insertOrder=array(
                'supid'=>$_POST['supplies_id'],
                'name'=>"'".$existData[0]['name']."'",
                'amount'=>$_POST['amount'],
                'unit'=>"'".getUnit($existData[0]['unit'])."'",
                'line'=>$_POST['line'],
                'remark'=>"'".$_POST['remark']."'",
                'pic'=>"'".$existData[0]['pic']."'",
                'is_pending'=>1,
                'is_adminconfirm'=>0,
                'is_userconfirm'=>0,
                'user_id'=>current_user('user_id')
            );
            $isInserted=insertTb('order',$insertOrder);
            $status=$isInserted?"เพิ่มข้อมูลเรียบร้อยแล้ว":"ไม่สามารถเพิ่มข้อมูลได้";
        }
        $ret=array(
            code=>$isInserted?200:400,
            status=>$status,
            insertData=>$insertOrder
        );
        echo json_encode(array_merge($_POST,$existData,$ret));
    }else{
        $insertOrder=array(
            'name'=>"'".$_POST['name']."'",
            'amount'=>$_POST['amount'],
            'unit'=>"'".$_POST['unit']."'",
            'line'=>$_POST['line'],
            'remark'=>"'".$_POST['remark']."'",
            'pic'=>"'noimage.png'",
            'is_pending'=>1,
            'is_adminconfirm'=>0,
            'is_userconfirm'=>0,
            'user_id'=>current_user('user_id')
        );
        $isInserted=insertTb('order',$insertOrder);
        $status=$isInserted?"เพิ่มข้อมูลเรียบร้อยแล้ว":"ไม่สามารถบันทึกได้ คุณกรอกข้อมูลไม่ครบ";
        $ret=array(
            code=>$isInserted?200:400,
            status=>$status,
            insertData=>$insertOrder
        );
        echo json_encode(array_merge($_POST,$ret));
    }

    function getUnit($id){
        $data=selectTb('unit_data','unit_name','id="'.$id.'"');
        return $data[0]['unit_name'];
    }