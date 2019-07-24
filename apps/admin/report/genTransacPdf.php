<?php
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

$html = '<table border="1" width="100%" style="border-collapse:collapse;"><tr>';
$i = 0;
foreach ($tbTitle as $v) {
    if ($i == 1||$i==2) $style = "style='width: 15%; text-align: center;'";
    else $style = "style='width: 10%; text-align: center;'";
    $html .= '<th ' . $style . '>' . $v . '</th>';
    $i++;
}
$html .= '</tr>';

if($type==1){
    foreach($transacData as $k){
        $html.='<tr>';
        $html.=
        '<td style="text-align:center;">' .getSuppliesData($k['supid'],'sid'). '</td>' .
        '<td style="text-align:center;">' .getSuppliesData($k['supid'],'name')." (".getSuppliesData($k['supid'],'cname').")". '</td>' .
        '<td style="text-align:center;">' .$k['amount']. '</td>' .
        '<td style="text-align:center;">' .getCatagoryName(getSuppliesData($k['supid'],'catid')). '</td>' .
        '<td style="text-align:center;">' .getSuppliesData($k['supid'],'box'). '</td>' .
        '<td style="text-align:center;">' .getUnitName(getSuppliesData($k['supid'],'unit')). '</td>' .
        '<td style="text-align:center;">' .getUserName($k['userid']). '</td>' .
        '<td style="text-align:center;">' .$k['datetime']. '</td>' .
        '<td style="text-align:center;">' .$k['remark'];
        $html.='</tr>';
    }
}else if($type==2){
    foreach($transacData as $k){
        if($k['is_approve']){
            if($k['is_pending'])$status="รอสั่งของ";
            else $status="ของมาแล้ว";
        }else if($k['is_approve']==null)$status="รออนุมัติ";
        else $status="ไม่อนุมัติ";
        $sid=getSuppliesData($k['supid'],'sid')?:" - ";
        $html.='<tr>';
        $html.=
        '<td style="text-align:center;">' .$sid. '</td>' .
        '<td style="text-align:center;">' .$k['name']. '</td>' .
        '<td style="text-align:center;">' .$k['unit']. '</td>' .
        '<td style="text-align:center;">' .getLineName($k['line']). '</td>' .
        '<td style="text-align:center;">' .$k['amount']. '</td>' .
        '<td style="text-align:center;">' .getUserName($k['user_id']). '</td>' .
        '<td style="text-align:center;">' .$k['datetime']. '</td>' .
        '<td style="text-align:center;">' .$status. '</td>' .
        '<td style="text-align:center;">' .$k['remark'];
        $html.='</tr>';
    }
    
}else if($type==3){
    foreach($transacData as $k){
        $html.='<tr>';
        $html.=
        '<td style="text-align:center;">' .getSuppliesData($k['supid'],'sid'). '</td>' .
        '<td style="text-align:center;">' .getSuppliesData($k['supid'],'name')." (".getSuppliesData($k['supid'],'cname').")". '</td>' .
        '<td style="text-align:center;">' .getCatagoryName(getSuppliesData($k['supid'],'catid')). '</td>' .
        '<td style="text-align:center;">' .getUnitName(getSuppliesData($k['supid'],'unit')). '</td>' .
        '<td style="text-align:center;">' .getLineName($k['line']). '</td>' .
        '<td style="text-align:center;">' .$k['amount']. '</td>' .
        '<td style="text-align:center;">' .getUserName($k['userid']). '</td>' .
        '<td style="text-align:center;">' .$k['datetime']. '</td>' .
        '<td style="text-align:center;">' .$k['remark'];
        $html.='</tr>';
    }
}
$html.='</table>';

// print $html;

load_fun('mpdf');

$pdfAddr=genPdf($html);
$pdfName=substr($pdfAddr,36,-4);

$ret=array(
    'code'=>$pdfAddr?200:400,
    'pdf'=>$pdfAddr,
    'name'=>$pdfName
);

echo json_encode($ret);

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