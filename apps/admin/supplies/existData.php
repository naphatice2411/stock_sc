<?php
    $existData = selectTb('supplies', 'id,sid,name,cname,min,max,unit,pic,box,catid', 'sid="' . $_POST['supid'] . '"');
    // print_r($existData);
    $existData = $existData[0];
    $inputTitle="";
    if(isset($_POST['type'])&&$_POST['type']==1)$inputTitle="เพิ่มจำนวนวัสดุ";
    else $inputTitle="ปรับยอดจำนวนวัสดุ";
    
    $ret='
    <form id="insertAmount" action="'.site_url('main/admin/supplies/index').'" method="post" enctype="multipart/form-data" class="form-horizontal">'.
        '<input type="hidden" name="Group" value="'.$existData['catid'].'">'.
        '<input type="hidden" name="supplies_id" value="'.$existData['id'].'">'.
        '<input type="hidden" name="type" value="'.$_POST['type'].'">'.
        '<div class="col-md-2">'.
        '<div class="form-group">'.
            '<label for="inputSkills" class="col-sm-2 control-label">&nbsp;</label>'.
            '<div class="col-sm-10">'.
                '<div id="image_preview"><img id="previewing" src="'.site_url('system/pictures/spare/'.$existData['pic'], true).'" width="160" /></div>'.
            '</div>'.
        '</div>'.
        '</div>'.
        '<div class="col-md-10">'.
        '<div class="form-group">'.
            '<label for="inputDept" class="col-sm-2 control-label">รหัสวัสดุ</label>'.
            '<div class="col-sm-10">'.
                '<input disabled type="text" class="form-control" id="inputNosup" name="Nosup" placeholder="รหัสวัสดุ" value="'.$existData['sid'].'">'.
            '</div>'.
        '</div>'.

        '<div class="form-group">'.
            '<label for="inputName" class="col-sm-2 control-label">ชื่อวัสดุ</label>'.
            '<div class="col-sm-10">'.
                '<input disabled type="text" class="form-control" id="inputNamesup" name="Namesup" placeholder="ชื่อวัสดุ" value="'.$existData['name'].'">'.
            '</div>'.
        '</div>'.

        '<div class="form-group">'.
            '<label for="inputName" class="col-sm-2 control-label">ชื่อเรียกวัสดุ</label>'.
            '<div class="col-sm-10">'.
                '<input disabled type="text" class="form-control" id="inputCallname" name="Callname" placeholder="ชื่อเรียก" value="'.$existData['cname'].'">'.
            '</div>'.
        '</div>'.

        '<div class="form-group">'.
            '<label for="inputEmail" class="col-sm-2 control-label">Minimum</label>'.
            '<div class="col-sm-10">'.
                '<input disabled type="text" class="form-control" id="inputMin" name="Min" placeholder="Minimum" value="'.$existData['min'].'">'.
            '</div>'.
        '</div>'.

        '<div class="form-group">'.
            '<label for="inputDept" class="col-sm-2 control-label">Maximum</label>'.
            '<div class="col-sm-10">'.
                '<input type="text" class="form-control" id="inputMax" name="Max" placeholder="Maximum" value="'.$existData['max'].'" disabled>'.
            '</div>'.
        '</div>'.

        '<div class="form-group">'.
            '<label for="inputPos" class="col-sm-2 control-label">หน่วยนับ</label>'.
            '<div class="col-sm-10">'.
                '<select disabled class="form-control" id="optUnit" name="Unit">';
                    $unitdata = selectTb('unit_data', 'id,unit_name');
                    foreach ($unitdata as $k => $v) {
                        if($existData['unit']==$v['id'])
                            $ret.="<option selected value='" . $v['id'] . "'>" . $v['unit_name'] . "</option>";
                    }
                $ret.='</select>'.
            '</div>'.
        '</div>'.
        '<div class="form-group">'.
            '<label for="inputDept" class="col-sm-2 control-label">พื้นที่จัดเก็บ</label>'.
            '<div class="col-sm-10">'.
                '<input type="text" class="form-control" id="inputArea" name="Area" placeholder="พื้นที่จัดเก็บ" value="'.$existData['box'].'" disabled>'.
            '</div>'.
        '</div>'.
        '<div class="form-group">'.
            '<label for="inputPos" class="col-sm-2 control-label">หมวดหมู๋</label>'.
            '<div class="col-sm-10">'.
                '<select disabled class="form-control" id="optGroup" name="Group">';
                    $unitdata = selectTb('catagory', 'id,nameid,detail');
                    foreach ($unitdata as $k => $v) {
                        if($existData['catid']==$v['id'])
                            $ret.="<option selected value='" . $v['id'] . "'>" . $v['nameid'] . " : " . $v['detail'] . "</option>";
                    }
                $ret.='</select>'.
            '</div>'.
        '</div>'.
        '<div class="form-group">'.
            '<label for="inputDept" class="col-sm-2 control-label">'.$inputTitle.'</label>'.
            '<div class="col-sm-10">'.
                '<input type="text" class="form-control" id="inputamount" name="amount" placeholder="กรุณาระบุจำนวนวัสดุ" value="">'.
            '</div>'.
        '</div>'.
        '<div class="form-group">'.
            '<label for="inputDept" class="col-sm-2 control-label">หมายเหตุ</label>'.
            '<div class="col-sm-10">'.
                '<input type="text" class="form-control" id="inputremark" name="remark" placeholder="หมายเหตุ (ถ้ามี)" value="">'.
            '</div>'.
        '</div>
        </div>'.

        
        '<div class="form-group">'.
            '<div class="col-sm-offset-6 col-sm-6">'.
                '<a href="#display" data-toggle="tab"><button id="smAddAmount" onclick="bkDisplay(true);" class="btn btn-info">บันทึกข้อมูล</button></a>'.
                '&nbsp;'.
                '<a href="#display" data-toggle="tab"><button id="ccAddAmount" onclick="bkDisplay(false);" class="btn btn-danger">ยกเลิก</button></a>'.
            '</div>'.
        '</div>'.
    '</form>';

    print $ret;