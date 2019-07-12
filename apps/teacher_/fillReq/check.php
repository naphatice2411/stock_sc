<?php
    if(!isset($_POST['dept']))exit();
    load_fun('tinyDB');
    print_r($_POST);
    print('<br>');
    $dept=$_POST['dept'];
    $req_reason=$_POST['usefor'];
    $requireDate=$_POST['requireDate'];
    $receiver=$_POST['receiver'];
    $discount=$_POST['discount'];
    $taxAmount=$_POST['taxAmount'];
    $sumAmount=$_POST['sumAmount'];
    $sumAmount=str_replace(',','',$sumAmount);
    $req_data=array(
        'org_id'=>"'1'",
        'sub_org_id'=>"'".$dept."'",
        'req_date'=>"'".date('Y-m-d')."'",
        'due_date'=>"'$requireDate'",
        'bearer_user_id'=>"'$receiver'",
        'req_user_id'=>"'".current_user('user_id')."'",
        'discount'=>"'$discount'",
        'total_cost'=>"'$sumAmount'",
        'vat'=>"'$taxAmount'",
        'reason_id'=>"'$req_reason'"
    );
    
    $req_id=insertTb('req_material',$req_data,true);
    
    $listName=$_POST['listName'];
    $requestValue=$_POST['request'];
    $dispenseValue=$_POST['dispense'];
    $remainValue=$_POST['remain'];
    $unitData=$_POST['unit'];
    $materialID=$_POST['material_id'];
    $costData=$_POST['cost'];
    $amountData=$_POST['amount'];
    $noteData=$_POST['note'];

    $listMaterial=array(
        'material_name',
        'request_quantity',
        'dispensed_quantity',
        'remaining_quantity',
        'unit_id',
        'cost_per_unit',
        'note',
    );

    $material_data=array(
        $listName,
        $requestValue,
        $dispenseValue,
        $remainValue,
        $unitData,
        $costData,
        $noteData,
    );

    $item_data=[];
    foreach($material_data as $r){
        foreach($r as $sr => $sv){
            $item_data[$sr][]=$sv;
        }
    }

    $addData=[];

    foreach($item_data as $r => $v){
        if($item_data[$r][0]=='')continue;
        $req_id=$req_id==''?"''":$req_id;
        $addData['req_id']=$req_id;
        foreach($v as $sr => $sv){
            if(preg_match("/^[0-9.,]+$/", $sv)) $sv = str_replace(',','',$sv);
            $addData[$listMaterial[$sr]]="'".$sv."'";
        }
        insertTb('req_item',$addData,true);
    }