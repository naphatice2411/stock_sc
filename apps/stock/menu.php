<?php
$mainMenu['stockMenu']=array(
    'title'=>'StockManage',
    'class'=>'header',
    'cond'=>true,
    'item'=>array(
        'showStock'=>array(
            'bullet'=>'fa fa-home',
            'title'=>'ดูข้อมูลพัสดุ',
            'url'=>'main/stock/showStock/index',
        ),
        'runStock'=>array(
            'bullet'=>'fa fa-gears',
            'title'=>'รันเลขพัสดุ',
            'url'=>'main/stock/runStock/index',
        ),        
            'addNew'=>array(
            'bullet'=>'fa fa-gears',
            'title'=>'เพิ่มพัสดุ',
            'url'=>'main/stock/addNew/index',
        ),
    ),
);
