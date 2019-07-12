<?php 
    $tbData=$_POST['tbData'];
    // print_r($_POST);

    $insStatus="success";
    foreach($tbData as $kv){
        $sub_cat_id=selectTb('sub_cat','id','group_id="'.$kv['groupNo'].'" AND cat_id="'.$kv['catNo'].'"');
        $sub_cat_id=$sub_cat_id[0]['id'];
        $currAmount=selectTb('stock_data','count(*)','sub_cat_id="'.$sub_cat_id.'"');
        $currAmount=$currAmount[0]['count(*)'];
        $stk_year=$kv['year'];
        $stk_remark=$kv['Remark'];

        $insertData=array(
            'stk_year'=>'"'.$stk_year.'"',
            'sub_cat_id'=>'"'.$sub_cat_id.'"',
            'stk_number'=>$currAmount<10?'"0'.$currAmount.'"':'"'.$currAmount.'"',
            'stk_detail'=>'"'.$stk_remark.'"',
            'status'=>'"1"',
            'is_print'=>'"0"'
        );
        for($i=0;$i<$kv['Amount'];$i++){
            $currAmount++;
            $insertData['stk_number']=$currAmount<10?'"0'.$currAmount.'"':'"'.$currAmount.'"';
            $insSuccess=insertTb('stock_data',$insertData);
            if(!$insSuccess){
                $insStatus="failed";
                break;
            }
        }
        if($insStatus=="failed")break;
    }

    $res=array(
        code=>$insStatus=="success"?200:400,
        insertStatus=>$insStatus,
    );

    echo json_encode($res);