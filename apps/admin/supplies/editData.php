
<?php
    $existData = selectTb('supplies', 'id,sid,name,cname,min,max,unit,pic,box,catid', 'sid="' . $_POST['supid'] . '"');
    // print_r($existData);
    $existData = $existData[0];

    $ret='<form id="insertEditData" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="oldId" id="oldId" value="'.$existData['id'].'">
    <input type="hidden" name="oldPic" id="oldPic" value="'.$existData['pic'].'">
    <div class="form-group">
        <label for="inputDept" class="col-sm-2 control-label">รหัสวัสดุ</label>
        <div id="editNoDiv" class="col-sm-10 has-feedback">
            <input type="text" class="form-control" id="editInputNosup" name="editInputNosup" placeholder="รหัสวัสดุ" value="'.$existData['sid'].'">
        </div>
    </div>

    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">ชื่อวัสดุ</label>
        <div id="editNameDiv" class="col-sm-10 has-feedback">
            <input type="text" class="form-control" id="editInputNamesup" name="editInputNamesup" placeholder="ชื่อวัสดุ" value="'.$existData['name'].'">
        </div>
    </div>

    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">ชื่อเรียกวัสดุ</label>
        <div id="editCallDiv" class="col-sm-10 has-feedback">
            <input type="text" class="form-control" id="editInputCallname" name="editInputCallname" placeholder="ชื่อเรียก" value="'.$existData['cname'].'">
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail" class="col-sm-2 control-label">Minimum</label>
        <div id="editMinDiv" class="col-sm-10 has-feedback">
            <input type="text" class="form-control" id="editInputMin" name="editInputMin" placeholder="Minimum" value="'.$existData['min'].'">
        </div>
    </div>
    <div class="form-group">
        <label for="inputDept" class="col-sm-2 control-label">Maximum</label>
        <div id="editMaxDiv" class="col-sm-10 has-feedback">
            <input type="text" class="form-control" id="editInputMax" name="editInputMax" placeholder="Maximum" value="'.$existData['max'].'">
        </div>
    </div>

    <div class="form-group">
        <label for="inputPos" class="col-sm-2 control-label">หน่วยนับ</label>
        <div id="editUnitDiv" class="col-sm-10 has-feedback">
            <select class="form-control" id="editOptUnit" name="editOptUnit">
                <option disabled value="def">Select one</option>';
                $unitdata = selectTb('unit_data', 'id,unit_name');
                foreach ($unitdata as $k => $v) {
                    $selected=$v['id']==$existData['unit']?" selected":" ";
                    $ret.=("<option value='" . $v['id'] . "'".$selected.">" . $v['unit_name'] . "</option>");
                }
        $ret.='</select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputDept" class="col-sm-2 control-label">พื้นที่จัดเก็บ</label>
        <div id="editAreaDiv" class="col-sm-10 has-feedback">
            <input type="text" class="form-control" id="editInputArea" name="editInputArea" placeholder="พื้นที่จัดเก็บ" value="'.$existData['box'].'">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPos" class="col-sm-2 control-label">หมวดหมู๋</label>
        <div id="editGroupDiv" class="col-sm-10 has-feedback">
            <select class="form-control" id="editOptGroup" name="editOptGroup">
                <option disabled value="def">Select one</option>';
                $unitdata = selectTb('catagory', 'id,nameid,detail');
                foreach ($unitdata as $k => $v) {
                    $selected=$v['id']==$existData['catid']?" selected ":" ";
                    $ret.=("<option value='" . $v['id'] . "'".$selected.">" . $v['nameid'] . " : " . $v['detail'] . "</option>");
                }
        $ret.='</select>
        </div>
    </div>

    <div class="form-group">
        <label for="inputSkills" class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
            <div id="editImage_preview"><img id="editPreviewing" src="'.site_url('system/pictures/spare/'.$existData['pic'], true).'" width="160" /></div>
            <div class="btn btn-default btn-file">
                <i class="fa fa-photo"></i> เลือกรูปวัสดุ
                <input type="file" class="form-control" id="editSparePicture" name="editSparePicture">
            </div>
            <span id="editLoading" class="" >กรุณารอ..</span>
            <span id="editMessage" class=""></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <!--    <input type="button" class="btn btn-danger" value="บันทึกข้อมูล" id="btnEditData"> -->
            <button type="submit" id="btnSubmit" class="btn btn-success">บันทึกข้อมูล</button>
            <a href="#display" data-toggle="tab"><button id="ccAddAmount" onclick="bkDisplay(false);" class="btn btn-danger">ยกเลิก</button></a>
            <input type="button" class="btn btn-warning pull-right" value="ลบรายการนี้" id="deleteRecord">
        </div>
    </div>
</form>';

$ret.="
<script>
$('#deleteRecord').on('click',function(){
    $('#deleteRecord').attr('disabled',true);
    if(confirm('คุณต้องการลบรายการนี้ใช่หรือไม่')){
        $.post('".site_url('ajax/admin/supplies/deleteRecord/')."',{
            id:$('#oldId').val(),
        },function(res){
            console.log(res);
            $('#saveAlert h4').html('<i class=\"icon fa fa-info\"></i> บันทึก!');
            $('#saveAlert p').text(res.status);
            $('#saveAlert').attr('class','callout callout-info');
            $(\"html, body\").animate({scrollTop: 0}, 1000);
            $('#saveAlert').slideDown('slow').delay(1000).slideUp(400,'swing',function(){
                window.location.href = window.location;
            });
        },'json');
    }
});

$('#insertEditData').on('submit', (function(e) {
    e.preventDefault();
    $('#editMessage').empty();
    $('#editLoading').show();
    var no=chkEditNo();
    var name=chkEditName();
    var cname=chkEditCall();
    var min=chkEditMin();
    var max=chkEditMax();
    var unit=chkEditUnit();
    var area=chkEditArea();
    var group=chkEditGroup();
    $('#btnSubmit').attr('disabled',true);
    if(no&&name&&cname&&min&&max&&unit&&area&&group){
        $.ajax({
            url: '".site_url('ajax/admin/supplies/editSupply/')."',
            type: \"POST\",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:'json',
            success: function(res){
                console.log(res);
                    if(res.code===400){
                        $('#editNoDiv').attr('class','col-sm-10 has-error has-feedback');
                        $('#saveAlert h4').html('<i class=\"icon fa fa-info\"></i> Warning!');
                        $('#saveAlert p').text(res.status);
                        $('#saveAlert').attr('class','callout callout-danger');
                        $('#editLoading').hide();
                        $(\"html, body\").animate({scrollTop: 0}, 1000);
                        $('#saveAlert').slideDown('slow').delay(1000).slideUp(400,'swing',function(){
                            $('#btnSubmit').attr('disabled',false);                        
                        });
                    }else if(res.code===200){
                        $('#saveAlert h4').html('<i class=\"icon fa fa-info\"></i> บันทึก!');
                        $('#saveAlert p').text(res.status);
                        $('#saveAlert').attr('class','callout callout-info');
                        $('#editLoading').hide();
                        $('#editNoDiv').attr('class','col-sm-10 has-feedback');
                        $('#editNameDiv').attr('class','col-sm-10 has-feedback');
                        $('#editCallDiv').attr('class','col-sm-10 has-feedback');
                        $('#editMinDiv').attr('class','col-sm-10 has-feedback');
                        $('#editMaxDiv').attr('class','col-sm-10 has-feedback');
                        $('#editUnitDiv').attr('class','col-sm-10 has-feedback');
                        $('#editAreaDiv').attr('class','col-sm-10 has-feedback');
                        $('#editGroupDiv').attr('class','col-sm-10 has-feedback');
                        $('#insertEditData')[0].reset();
                        $('#editPreviewing').attr('src','".site_url('system/pictures/spare/noimage.png',true)."');
                        $(\"html, body\").animate({scrollTop: 0}, 1000);
                        $('#saveAlert').slideDown('slow').delay(1000).slideUp(400,'swing',function(){
                            window.location.href = window.location;
                        });
                    }
            }
        });
    }else{
        $('#saveAlert h4').html('<i class=\"icon fa fa-info\"></i> Warning!');
        $('#saveAlert p').text(\"กรุณากรอกข้อมูลให้ครบถ้วน\");
        $('#saveAlert').attr('class','callout callout-danger');
        $('#loading').hide();
        $('#saveAlert').slideDown('slow').delay(1000).slideUp();
    }
    return false;
}));

$(\"#editSparePicture\").change(function() {
    $(\"#editMessage\").empty(); // To remove the previous error message
    var file = this.files[0];
    if (!file) {
        $('#editPreviewing').attr('src', '".site_url('system/pictures/spare/noimage.png', true)."');
    } else {
        var imagefile = file.type;
        var match = [\"image/jpeg\", \"image/png\", \"image/jpg\"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            $('#editPreviewing').attr('src', '".site_url('system/pictures/spare/noimage.png ', true)."');
            $(\"#editMessage\").html(\"<p id='error'>Please Select A valid Image File</p>\" + \"<h4>Note</h4>\" + \"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>\");
            return false;
        } else {
            var reader = new FileReader();
            reader.onload = editImageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    }
});

function editImageIsLoaded(e) {
    $(\"#editSparePicture\").css(\"color\", \"green\");
    $('#editImage_preview').css(\"display\", \"block\");
    $('#editPreviewing').attr('src', e.target.result);
    $('#editPreviewing').attr('width', '160px');
    };
</script>
";

print $ret;