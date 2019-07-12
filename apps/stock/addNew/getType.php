<?php
    $group_id=$_POST['group_id'];
    $cat_id=$_POST['cat_id'];
    $data=selectTb('sub_cat','type',' group_id="'.$group_id.'" AND cat_id="'.$cat_id.'"');
    echo $data[0]['type'];