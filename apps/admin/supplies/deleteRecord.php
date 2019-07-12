<?php
    $data=selectTb('supplies','pic','id="'.$_POST['id'].'"');
    $pic=$data[0]['pic'];
    if($pic!="noimage.png")$isDeleted=unlink(BASE_PATH."system/pictures/spare/".$pic);
    else $isDeleted=true;
    if($isDeleted)$isDeleted&=deleteTb('supplies','id="'.$_POST['id'].'"');
    $hasTransac=selectTb('transaction','supid="'.$_POST['id'].'"');
    if(count($hasTransac)){
        if($isDeleted)$isDeleted&=deleteTb('transaction','supid="'.$_POST['id'].'"');
    }
    $ret=array(
        status=>$isDeleted?"ลบข้อมูลเรียบร้อยแล้ว":"ไม่สามารถลบข้อมูลได้",
        post=>$_POST,
        picPath=>BASE_PATH."system/pictures/spare/".$pic
    );

    echo json_encode($ret);