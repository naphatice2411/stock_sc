<?php
$type = $_POST['type']; //statusid
$group = $_POST['group']; //catid
if($type!=0){
    $condition=" statusid='".$type."' ";
    if($group!=0)$condition.=" AND catid='".$group."'";
}else{
    if($group!=0)$condition=" catid='".$group."'";
}

$suppliesData=selectTb('supplies','sid,name,cname,min,max,unit,box,remain_amount,statusid,catid',$condition);
// print_r($suppliesData);
$i=0;
foreach($suppliesData as $k){
    $tb[$i][]=$k['sid'];
    $tb[$i][]=$k['name']." (".$k['cname'].") ";
    $tb[$i][]=getCatagoryName($k['catid']);
    $tb[$i][]=$k['box'];
    $tb[$i][]=getUnitName($k['unit']);
    $tb[$i][]=$k['min'];
    $tb[$i][]=$k['max'];
    $tb[$i][]=getStatusName($k['statusid']);
    $tb[$i][]=$k['remain_amount'];
    $i++;
}

$res=array(
    'table'=>$tb,
);

echo json_encode($res);

function getStatusName($id){
    $data=selectTb('status_data','detail','id="'.$id.'"')[0];
    return $data['detail'];
}

function getUnitName($id){
    $data=selectTb('unit_data','unit_name','id="'.$id.'"')[0];
    return $data['unit_name'];
}

function getCatagoryName($id){
    $data=selectTb('catagory','nameid,detail','id="'.$id.'"')[0];
    return $data['nameid']." : ".$data['detail'];
}
