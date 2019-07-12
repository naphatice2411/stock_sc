<?php

    if(isset($_POST['isNew'])&&$_POST['isNew']=="false"){  
        $existData = selectTb('supplies', 'id,sid,name,cname,min,max,unit,pic,box,catid,remain_amount', 'sid="' . $_POST['supid'] . '"');
        // print_r($existData);
        $existData = $existData[0];
        
        $ret='
        <form id="withdrawAmountForm" action="'.site_url('ajax/home/withdraw/order').'" method="post" enctype="multipart/form-data" class="form-horizontal">'.
            '<input type="hidden" name="supplies_id" value="'.$existData['id'].'">'.
            '<input type="hidden" name="isExist" value="true">'.
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
            '</div>';

            $unitdata = selectTb('unit_data', 'unit_name','id="'.$existData['unit'].'"');
            $unitname=$unitdata[0]['unit_name'];

    $ret.='<div class="form-group">'.
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
                '<label for="inputRemain" class="col-sm-2 control-label">จำนวนคงเหลือ</label>'.
                '<div class="col-sm-10">'.
                    '<input disabled type="text" class="form-control" id="inputRemainAmount" name="remainAmount" placeholder="คงเหลือ" value="'.$existData['remain_amount']." ".$unitname.'">'.
                '</div>'.
            '</div>'.

            '<div class="form-group">'.
                '<label for="inputDept" class="col-sm-2 control-label">จำนวนที่ต้องการสั่งซื้อ</label>'.
                '<div id="inputAmount" class="col-sm-10">'.
                    '<input type="text" class="form-control" id="inputamount" name="amount" placeholder="กรุณาระบุจำนวนวัสดุ" value="">'.
                '</div>'.
            '</div>'.

            '<div class="form-group">'.
                '<label for="inputLine" class="col-sm-2 control-label">ไลน์</label>'.
                '<div class="col-sm-10">'.
                    '<select class="form-control" id="optLine" name="line">
                        <option disabled selected>select one</option>';
                        $unitdata = selectTb('line', 'id,name');
                        foreach ($unitdata as $k => $v) {
                                $ret.="<option value='" . $v['id'] . "'>" . $v['name'] . "</option>";
                        }
                    $ret.='</select>'.
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
                    '<button type="submit" class="btn btn-info">บันทึก</button>'.
                    '&nbsp;'.
                    '<a href="#display" data-toggle="tab"><button id="ccWithdraw" class="btn btn-danger">ยกเลิก</button></a>'.
                '</div>'.
            '</div>'.
        '</form>';
    }else{
        $ret='
        <form id="withdrawAmountForm" action="'.site_url('ajax/home/withdraw/order').'" method="post" enctype="multipart/form-data" class="form-horizontal">'.
            '<input type="hidden" name="isExist" value="false">'.    
            '<div class="col-md-2">'.
            '<div class="form-group">'.
                '<label for="inputSkills" class="col-sm-2 control-label">&nbsp;</label>'.
                '<div class="col-sm-10">'.
                    '<div id="image_preview"><img id="previewing" src="'.site_url('system/pictures/spare/noimage.png', true).'" width="160" /></div>'.
                '</div>'.
            '</div>'.
            '</div>'.
            '<div class="col-md-10">'.
    
            '<div class="form-group">'.
                '<label for="inputName" class="col-sm-2 control-label">ชื่อวัสดุ</label>'.
                '<div class="col-sm-10">'.
                    '<input type="text" class="form-control" id="inputNamesup" name="name" placeholder="ชื่อวัสดุ" value="'.$existData['name'].'">'.
                '</div>'.
            '</div>'.
            
            '<div class="form-group">'.
                '<label for="inputDept" class="col-sm-2 control-label">จำนวนที่ต้องการสั่งซื้อ</label>'.
                '<div id="inputAmount" class="col-sm-10">'.
                    '<input type="text" class="form-control" id="inputamount" name="amount" placeholder="กรุณาระบุจำนวนวัสดุ" value="">'.
                '</div>'.
            '</div>'.

            '<div class="form-group">'.
                '<label for="" class="col-sm-2 control-label">หน่วยนับ</label>'.
                '<div id="divInputUnit" class="col-sm-10">'.
                    '<input type="text" class="form-control" id="inputUnit" name="unit" placeholder="กรุณาระบุชื่อหน่วยนับ" value="">'.
                '</div>'.
            '</div>'.

            '<div class="form-group">'.
                '<label for="inputLine" class="col-sm-2 control-label">ไลน์</label>'.
                '<div class="col-sm-10">'.
                    '<select class="form-control" id="optLine" name="line">
                        <option disabled selected>select one</option>';
                        $unitdata = selectTb('line', 'id,name');
                        foreach ($unitdata as $k => $v) {
                                $ret.="<option value='" . $v['id'] . "'>" . $v['name'] . "</option>";
                        }
                    $ret.='</select>'.
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
                    '<button type="submit" class="btn btn-info">บันทึก</button>'.
                    '&nbsp;'.
                    '<a href="#display" data-toggle="tab"><button id="ccWithdraw" class="btn btn-danger">ยกเลิก</button></a>'.
                '</div>'.
            '</div>'.
        '</form>';
        
    }
    $ret.=
    "<script>
        $('#withdrawAmountForm').on('submit',function(e){
            e.preventDefault();
            var url=$('#withdrawAmountForm').attr('action');
            $.ajax({
                url: url, // Url to which the request is send
                type: \"POST\", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                dataType:'json',
                success: function(res) // A function to be called if request succeeds
                {
                    console.log(res);
                    if(res.code===200){
                        $('#saveAlert h4').html('<i class=\"icon fa fa-info\"></i> Warning!');
                        $('#saveAlert p').text(res.status);
                        $('#saveAlert').attr('class','callout callout-info');
                        $(\"html, body\").animate({scrollTop: 0}, 1000);
                        $('#saveAlert').slideDown('slow').delay(1000).slideUp(400,function(){
                            window.location.href=window.location;
                        });
                    }else{
                        if(res.code===404)$('#inputAmount').attr('class','col-sm-10 has-error has-feedback');
                        $('#saveAlert h4').html('<i class=\"icon fa fa-info\"></i> Warning!');
                        $('#saveAlert p').text(res.status);
                        $('#saveAlert').attr('class','callout callout-danger');
                        $(\"html, body\").animate({scrollTop: 0}, 1000);
                        $('#saveAlert').slideDown('slow').delay(1000).slideUp();
                    }
                }
            });
        });
        $('#ccWithdraw').on('click',function(){
            $('#liDisplay').addClass('active');
            $('#liWithdraw').removeClass('active');
            $('#withdrawAmount').html('กรุณาเลือกวัสดุที่จะระบุจำนวนจากหน้ารายการวัสดุก่อน');
        });
    </script>
    ";
    print $ret;