<?php
    $isAddGroup=(isset($_POST['is_add_group'])&&$_POST['is_add_group']==true)?1:0;
    $catInsert=$groupInsert=1;
    if($isAddGroup){
        $groupData=array(
            'group_id'=>'"'.$_POST['group_id'].'"',
            'detail'=>'"'.$_POST['group_detail'].'"'
        );
        $groupInsert=insertTb('cat_group',$groupData);
        $isAddCat=1;
    }else{
        $isAddCat=(isset($_POST['is_add_cat'])&&$_POST['is_add_cat']==true)?1:0;
    }
    if($isAddCat){
        $catData=array(
            'group_id'=>'"'.$_POST['group_id'].'"',
            'cat_id'=>'"'.$_POST['cat_id'].'"',
            'name'=>'"'.$_POST['cat_name'].'"',
            'type'=>'"'.$_POST['cat_type'].'"'
        );
        $catInsert=insertTb('sub_cat',$catData);
    }

    if(!$isAddCat&&!$isAddGroup)$catInsert=$groupInsert=0;

    $res=array(
        'catInsert'=>$catInsert,
        'groupInsert'=>$groupInsert
    );

    if($res['catInsert']==0&&$res['groupInsert']==0)$res['error']="There's nothing to insert";

    echo json_encode($res);