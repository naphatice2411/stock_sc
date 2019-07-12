<?php
$newReq=selectTb('req_material','count(*)','isApprove="0"');
$numNewReq=$newReq[0]['count(*)'];

$approvedReq=selectTb('req_material','count(*)','isApprove="1"');
$numApprovedReq=$approvedReq[0]['count(*)'];
$mainMenu['financeMenu']=array(
    'title'=>'Finance',
    'class'=>'header',
    'cond'=>true,
    'item'=>array(
        'viewReq'=>array(
            'bullet'=>'fa fa-home',
            'title'=>'ดูใบเบิก',
            'url'=>'main/finance/viewReq/index',
            'item'=>array(
                'new'=>array(
                    'bullet'=>'',
                    'title'=>'ใบเบิกที่ยังไม่อนุมัติ',
                    'url'=>'main/finance/viewReq/new',
                    'num'=>$numNewReq,
                    'cond'=>'',
                ),
                'isApprove'=>array(
                    'bullet'=>'',
                    'title'=>'ใบเบิกที่อนุมัติแล้ว',
                    'url'=>'main/finance/viewReq/Approved',
                    'num'=>$numApprovedReq,
                    'cond'=>''
                ),
            ),
        ),
        
    ),
);
