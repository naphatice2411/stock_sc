<?php
    $cat_data = selectTb('sub_cat', 'cat_id,name',' group_id="'.$_POST['group_id'].'"');
    $res = "<option disabled selected value='def'>เลือกชนิดพัสดุ</option>";
    foreach ($cat_data as $k => $v) {
        $res.="<option value='" . $v['cat_id'] . "'>" . $v['cat_id'] . " (" . $v['name'] . ") </option>";
    }
    if(!(isset($_POST['isRunStock'])&&$_POST['isRunStock']==true))$res.='<option value="others">อื่น ๆ</option>';
    echo $res;
