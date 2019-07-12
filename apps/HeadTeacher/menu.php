<?php
$mainMenu['hTeacherMenu']=array(
    'title'=>'Head Teacher',
    'class'=>'header',
    'cond'=>true,
    'item'=>array(
        'approveReq'=>array(
            'bullet'=>'fa fa-home',
            'title'=>'อนุมัติใบเบิก',
            'url'=>'main/HeadTeacher/approveReq/index',
        ),
        'budget'=>array(
            'bullet'=>'fa fa-gears',
            'title'=>'จัดสรรงบประมาณ',
            'url'=>'main/HeadTeacher/budget/index',
        ),
    ),
);
