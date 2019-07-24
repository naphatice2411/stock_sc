<?php

//$countRec=count(selectTb('admin_user','*'));

$newUser = selectTb('userdata', 'count(*)', 'active=" " or active="N"');
$numNewUser = $newUser[0]['count(*)'];

$allUser = selectTb('userdata', 'count(*)', 'active="Y"');
$numAllUser = $allUser[0]['count(*)'];

$blockedUser = selectTb('userdata', 'count(*)', 'active="B"');
$numAllblockedUser = $blockedUser[0]['count(*)'];


$mainMenu['adminMenu'] = array(
    'class' => "header",
    'title' => 'ดูเลระบบ',
    'cond' => true,
    'item' => array(
        'report' => array('bullet' => 'fa fa-file',
            'title' => 'รายงาน',
            'url' => '',
            'cond' => true,
            'item' => array(
                'remainAmount' => array(
                    'bullet' => 'fa fa-file-pdf-o',
                    'title' => 'รายงานยอดคงเหลือ',
                    'url' => 'main/admin/report/remain',
                    'cond'=>'',
                    'num'=>'',
                ),
                'transaction'=>array(
                    'bullet'=>'fa fa-file-pdf-o',
                    'title'=>'รายงานการเคลื่อนไหว',
                    'url'=>'main/admin/report/transac',
                ),
            ),
        ),
        'userManage' => array('bullet' => 'fa fa-users',
            'title' => 'จัดการผู้ใช้',
            'url' => 'main/userManage/user/list',
            'cond' => current_user('user_type')=='administrator',
            'item' => array(
                'new' => array(
                    'bullet' => 'fa fa-user-plus',
                    'title' => 'เพิ่มผู้ใช้งาน',
                    'url' => 'main/admin/userManage/new',
                    'num' => $numNewUser,
                    'cond'=>'',
                ),
                'allUser' => array(
                    'bullet' => 'fa  fa-users',
                    'title' => 'ผู้ใช้ทั้งหมด',
                    'url' => 'main/admin/userManage/allUser',
                    'num' => $numAllUser,
                    'cond'=>'',
                ),
                'blockedUser' => array(
                    'bullet' => 'fa fa-user-times',
                    'title' => 'ผู้ใช้ที่ถูกบล็อก',
                    'url' => 'main/admin/userManage/blockedUser',
                    'num' => $numAllblockedUser,
                    'cond'=>'',
                ),

            ),
        ),
        'supplies' => array(
            'bullet' => 'fa fa-legal',
            'title' => 'จัดการวัสดุ',
            'url' => 'main/admin/supplies/index',
            'cond' => '',

        ),
        'approve' => array(
            'bullet' => 'fa fa-check-square',
            'title' => 'อนุมัติคำสั่งซื้อ',
            'url' => 'main/admin/approve/index',
            'cond' => '',

        ),
        
    ),
);
?>