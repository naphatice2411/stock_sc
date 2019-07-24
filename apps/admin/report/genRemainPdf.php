<?php
$type = $_POST['type']; //statusid
$group = $_POST['group']; //catid
// $condition=" 0 ";
if ($type != 0) {
    $condition = " statusid='" . $type . "' ";
    if ($group != 0) $condition .= " AND catid='" . $group . "'";
} else {
    if ($group != 0) $condition = " catid='" . $group . "'";
}

$suppliesData = selectTb('supplies', 'sid,name,cname,min,max,unit,box,remain_amount,statusid,catid', $condition);
// print_r($suppliesData);
$header = array(
    "รหัส",
    "ชื่อ",
    "หมวดหมู่",
    "ที่เก็บ",
    "หน่วยนับ",
    "min",
    "max",
    "สถานะ",
    "คงเหลือ",
);

$html = '<table border="1" width="100%" style="border-collapse:collapse;"><tr>';
$i = 0;
// foreach ($header as $v) {
//     if ($i == 1) $style = "style='width: 25%; text-align: center;'";
//     else if ($i == 8) $style = "style='width: 5%; text-align: center;'";
//     else $style = "style='width: 10%; text-align: center;'";
//     $html .= '<th ' . $style . '>' . $v . '</th>';
//     $i++;
// }
$html.=
"<th style='width: 10%; text-align: center;'>รหัส</th>
<th style='width: 15%; text-align: center;'>ชื่อ</th>
<th style='width: 15%; text-align: center;'>หมวดหมู่</th>
<th style='width: 10%; text-align: center;'>ที่เก็บ</th>
<th style='width: 10%; text-align: center;'>หน่วยนับ</th>
<th style='width: 10%; text-align: center;'>min</th>
<th style='width: 10%; text-align: center;'>max</th>
<th style='width: 10%; text-align: center;'>สถานะ</th>
<th style='width: 10%; text-align: center;'>คงเหลือ</th>";

$html .= '</tr>';
foreach ($suppliesData as $k) {
    $html.='<tr>';
    $html .= 
        '<td style="text-align:center;">' . $k['sid'] . '</td>' .
        '<td style="text-align:center;">' . $k['name'] . " (" . $k['cname'] . ") " . '</td>' .
        '<td style="text-align:center;">' . getCatagoryName($k['catid']) . '</td>' .
        '<td style="text-align:center;">' . $k['box'] . '</td>' .
        '<td style="text-align:center;">' . getUnitName($k['unit']) . '</td>' .
        '<td style="text-align:center;">' . $k['min'] . '</td>' .
        '<td style="text-align:center;">' . $k['max'] . '</td>' .
        '<td style="text-align:center;">' . getStatusName($k['statusid']) . '</td>' .
        '<td style="text-align:center;">' . $k['remain_amount'] . '</td>';
    $html.='</tr>';
}
$html.='</table>';

load_fun('mpdf');

$pdfAddr=genPdf($html);
$pdfName=substr($pdfAddr,36,-4);

$ret=array(
    'code'=>$pdfAddr?200:400,
    'pdf'=>$pdfAddr,
    'name'=>$pdfName
);

echo json_encode($ret);

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
