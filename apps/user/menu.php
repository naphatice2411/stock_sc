<?php
//global $mainMenu;
$mainMenu['userMenu'] = array(
    'title' => 'เมนูผู้ใช้',
    'class' => 'header',
    'cond' => true,
    'item' => array(
        'profile' => array(
            'bullet' => 'fa fa-street-view', //กำหนดสัญลักษณ์หน้าตัวหนังสือ
            'title' => 'โปรไฟล์', //ชื่อแถบใช้งาน
            'url' => 'main/home/profile/view', //เมื่อคลิกแล้วส่งไปที่หน้า url นี้
            'cond' => true,
        ),
        'withdraw' => array(
            'bullet' => 'fa fa-chain', //กำหนดสัญลักษณ์หน้าตัวหนังสือ
            'title' => 'วัสดุ', //ชื่อแถบใช้งาน
            'url' => '', //เมื่อคลิกแล้วส่งไปที่หน้า url นี้ (เว้นว่างไว้เพราะไม่ได้โยงไปหน้าไหนแค่เลื่อนแถบลงมา)
            'cond' => current_user('user_id'),
            'item' =>array(
                'withdraw'=>array(
                    'bullet' => 'fa fa-puzzle-piece',//กำหนดสัญลักษณ์หน้าตัวหนังสือ
                    'title' => 'เบิกวัสดุ',//ชื่อแถบใช้งาน
                    'url'=>'main/home/withdraw/index',//เมื่อคลิกแล้วส่งไปที่หน้า url นี้
                    'cond'=>''
                ),
                'order'=>array(
                    'bullet'=>'fa fa-shopping-cart',//กำหนดสัญลักษณ์หน้าตัวหนังสือ
                    'title'=>'สั่งวัสดุ',//ชื่อแถบใช้งาน
                    'url'=>'main/home/withdraw/orderIndex',//เมื่อคลิกแล้วส่งไปที่หน้า url นี้
                    'cond'=>''
                ),
            ),
        ),
    ),

);
