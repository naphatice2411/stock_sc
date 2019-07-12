<?php 
    $group_data = selectTb('cat_group', 'group_id,detail');
    $res='<option disabled selected value="def">เลือกกลุ่มประเภท</option>';
    foreach ($group_data as $k => $v) {
        $res.="<option value='" . $v['group_id'] . "'>" . $v['group_id'] . " (" . $v['detail'] . ") </option>";
    }
    $res.='<option value="others">อื่น ๆ</option>';
    echo $res;