<?php 
    $year=$_POST['year'];
    $data=selectTb('stock_data','sub_cat_id,stk_number,stk_detail,status','stk_year="'.$year.'"');
    $ret='';
    foreach($data as $k){
        $ret.=  "<tr>".
                    "<td>".genSCNumber($year,$k['sub_cat_id'],$k['stk_number'])."</td>".
                    "<td>".$k['stk_detail']."</td>".
                    "<td>".findStatus($k['status'])."</td>".
                "</tr>";
    }
    print($ret);


    function genSCNumber($year, $subCat, $number){
        $prefixData = selectTb('sub_cat', 'group_id,cat_id,type,name', 'id="' . $subCat . '"');
        // print_r($prefixData);
        $prefixData = $prefixData[0];
        $year += 543;
        $year %= 100;
        $ret = $year . " สภ. " . $prefixData['group_id'] . "-" . $prefixData['cat_id'] . "-" . $prefixData['type'];
        $ret .= $number;
        $ret .= " (" . $prefixData['name'] . ")";
        return $ret;
    }

    function findStatus($No){
        $data=selectTb('status_data','detail','id="'.$No.'"');
        $data=$data[0];
        return $data['detail'];
    }