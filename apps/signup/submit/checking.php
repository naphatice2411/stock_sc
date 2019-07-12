<?php

$existData = selectTb('userdata', 'count(*)', 'username="' . $_POST['username'] . '"');

if ($existData[0]['count(*)'] != 0) {
    $textStatus = "ชื่อผู้ใช้ซ้ำ กรุณาใช้\"ชื่อผู้ใช้\" อื่น...";
    $ret = array(
        'code' => 400,
        'data' => $textStatus
    );
    echo json_encode($ret);
} else {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_data = array(
        "username" => $username,
        "name" => $name,
        "surname" => $surname,
        "mobile" => $mobile,
        "email" => $email,
        "password" => $password,
        "accession" => '[]',
        "active" => 'Y',
        "sid" => session_id(),
        'level' => '3',
        'totalSMS' => '200',
        'remainSMS' => '200',
    );
    load_fun('user');
    $existData = selectTb('userdata', 'count(*)', 'username="' . $_POST['username'] . '"');
    if(add_user($user_data)){
        $textStatus = "การลงทะเบียนเสร็จสิ้น";
        $ret = array(
            'code' => 200,
            'data' => $textStatus
        );
        echo json_encode($ret);
    }
}
