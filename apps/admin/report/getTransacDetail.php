<?php
// print_r($_POST);
$type = $_POST['type'];
$start = $_POST['start'];
$end = $_POST['end'];
switch ($type) {
    case 1:
        $tableName = 'transaction';
        $tbTarget='supid,amount,remark,userid,datetime,line';
        $tbTitle = array(
            'รหัส', 'ชื่อ','จำนวน', 'หมวดหมู่', 'ตำแหน่ง', 'หน่วยนับ', 'ชื่อผู้ใช้งาน', 'วันที่', 'หมายเหตุ'
        );
        break;
    case 3:
        $tableName = 'transaction';
        $tbTarget='supid,amount,remark,userid,datetime,line';
        $tbTitle = array(
            'รหัส', 'ชื่อ', 'หมวดหมู่', 'หน่วยนับ', 'ใช้กับไลน์', 'จำนวนที่เบิก', 'ชื่อผู้เบิก', 'วันที่เบิก', 'หมายเหตุ'
        );
        break;
    case 2:
        $tableName = 'order';
        $tbTarget='supid,name,unit,line,amount,user_id,datetime,is_pending,is_approve,remark';
        $tbTitle = array(
            'รหัส', 'ชื่อ', 'หน่วยนับ', 'ใช้กับไลน์', 'จำนวนที่สั่ง', 'ชื่อผู้สั่ง', 'วันที่สั่ง', 'สถานะปัจจุบัน','หมายเหตุ'
        );
        break;
}
$condition="datetime BETWEEN '".$start."' AND '".$end." 23:59:59.999'";
if($type==1)$condition.=" AND (type='1' OR type='2')";
else if($type==3)$condition.=" AND type='3'";

$transacData=selectTb($tableName,$tbTarget,$condition);
// print_r($transacData);

if($type==1){
    $i=0;
    foreach($transacData as $k){
        $tb[$i][]=getSuppliesData($k['supid'],'sid');
        $tb[$i][]=getSuppliesData($k['supid'],'name')." (".getSuppliesData($k['supid'],'cname').")";
        $tb[$i][]=$k['amount'];
        $tb[$i][]=getCatagoryName(getSuppliesData($k['supid'],'catid'));
        $tb[$i][]=getSuppliesData($k['supid'],'box');
        $tb[$i][]=getUnitName(getSuppliesData($k['supid'],'unit'));
        $tb[$i][]=getUserName($k['userid']);
        $tb[$i][]=$k['datetime'];
        $tb[$i][]=$k['remark'];
        $i++;
    }
}else if($type==2){
    $i=0;
    foreach($transacData as $k){
        if($k['is_approve']){
            if($k['is_pending'])$status="รอสั่งของ";
            else $status="ของมาแล้ว";
        }else $status="ไม่อนุมัติ";
        $tb[$i][]=getSuppliesData($k['supid'],'sid')?:" - ";
        $tb[$i][]=$k['name'];
        $tb[$i][]=$k['unit'];
        $tb[$i][]=getLineName($k['line']);
        $tb[$i][]=$k['amount'];
        $tb[$i][]=getUserName($k['user_id']);
        $tb[$i][]=$k['datetime'];
        $tb[$i][]=$status;
        $tb[$i][]=$k['remark'];
        $i++;
    }
    
}else if($type==3){
    $i=0;
    foreach($transacData as $k){
        $tb[$i][]=getSuppliesData($k['supid'],'sid');
        $tb[$i][]=getSuppliesData($k['supid'],'name')." (".getSuppliesData($k['supid'],'cname').")";
        $tb[$i][]=getCatagoryName(getSuppliesData($k['supid'],'catid'));
        $tb[$i][]=getUnitName(getSuppliesData($k['supid'],'unit'));
        $tb[$i][]=getLineName($k['line']);
        $tb[$i][]=$k['amount'];
        $tb[$i][]=getUserName($k['userid']);
        $tb[$i][]=$k['datetime'];
        $tb[$i][]=$k['remark'];
        $i++;
    }
}
// print_r($tb);


$res=array(
    'title'=>$tbTitle,
    'table'=>$tb
);

echo json_encode($res);
function getSuppliesData($id,$key){
    $data=selectTb('supplies',$key,'id="'.$id.'"')[0];
    return $data[$key];
}

function getCatagoryName($id){
    $data=selectTb('catagory','nameid,detail','id="'.$id.'"')[0];
    return $data['nameid']." (".$data['detail'].") ";
}

function getUnitName($id){
    return selectTb('unit_data','unit_name','id="'.$id.'"')[0]['unit_name'];
}

function getLineName($id){
    return selectTb('line','name','id="'.$id.'"')[0]['name'];
}

function getUserName($id){
    $data=selectTb('userdata','name,surname','user_id="'.$id.'"')[0];
    return $data['name']." ".$data['surname'];
}