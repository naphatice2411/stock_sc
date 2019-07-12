<?php

if (current_user('user_type') != "administrator")
    exit();

//$appPath = APP_PATH;
//$lsResult = array_slice(scandir($appPath), 2);

//print_r($hGET);

//$adminApp=array('admin','user');
//$userApp=array('user');

//    print_r($_POST);
    $accessionName = $_POST['accession'];
//    print_r($accessionName);
    //$act = $_POST['act'];
    //$userData = selectTb("userdata", "accession,user_type", "user_id='" . $hGET['id'] . "' limit 1");
    //$userData = $userData[0];
    /*
    if($userData['user_type']=='administrator'){
        $accession=$adminApp;
    }else{
        $accession=$userApp;
    }*/
    $accession=array();
    //print_r($accession);
    foreach($accessionName as $row){
        if($row!='false')array_push ($accession,$row);
    }
    //print_r($accession);
    $update = updateTb('userdata', array('accession' =>"'". json_encode($accession)."'"),'user_id='.pq($hGET['id']).' limit 1');
    if($update) print "บันทึกข้อมูลสิทธิ์การใช้งานแอปพลิเคชั่นเรียบร้อยแล้ว";
/*
    $oldAccession = json_decode($userData['accession']);

    if ($act == 'del') {
        delEFArray($oldAccession, $accessionName);
    }

    if ($act == 'add') {
        array_push($oldAccession, $accessionName);
    }

    $update = updateTb('user_data', array('accession' => json_encode($oldAccession)));

    if ($update) {
        print 1;
    } else {
        print 0;
    }

    function delEFArray(&$array, $e) {
        $i = 0;
        foreach ($array as $row) {
            if ($row == '$e') {
                unset($array, $i);
            }
            $i++;
        }
    }
 
 */
    