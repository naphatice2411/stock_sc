<?php
$mainMenu['teacherMenu']=array(
    'title'=>'Teacher',
    'class'=>'header',
    'cond'=>true,
    'item'=>array(
        'fillReq'=>array(
            'bullet'=>'fa fa-home',
            'title'=>'กรอกใบเบิก',
            'url'=>'main/teacher/fillReq/index',
        ),
        'trackReq'=>array(
            'bullet'=>'fa fa-gears',
            'title'=>'ติดตามสถานะใบเบิก',
            'url'=>'main/teacher/trackReq/index',
        ),        
            'transferMoney'=>array(
            'bullet'=>'fa fa-gears',
            'title'=>'โอนเงิน',
            'url'=>'main/teacher/transferMoney/index',
        ),
    ),
);
