<?php
    $_SESSION['cart'][$_POST['id']]=null;
    $ret=array(
        code=>$_SESSION['cart'][$_POST['id']]==null?200:400,
        status=>"ลบข้อมูลเรียบร้อยแล้ว",
        post=>$_POST
    );

    echo json_encode($ret);