<?php

$title = "จัดการวัสดุ";

$siteName_data = getConfig('siteName', 'detail');

$subName_data = getConfig('subName', 'detail');

// print_r(selectTb('userdata','count(*)','username="nnnnnn"')[0]['count(*)']);

//  print_r($_POST);

    insertUpdate:    
        if(isset($_POST['supplies_id'])&&isset($_POST['amount'])&&$_POST['amount']>=0){
            $insertData=array(
                'supid'=>$_POST['supplies_id'],
                'amount'=>$_POST['amount'],
                'type'=>$_POST['type'],
                'remark'=>"'".$_POST['remark']."'",
                'userid'=>current_user('user_id')
            );
            $Amount=selectTb('supplies','remain_amount,min','id="'.$insertData['supid'].'"');
            $remainAmount=$Amount[0]['remain_amount'];
            $min=$Amount[0]['min'];
            if($insertData['type']==1){
                $remainAmount+=$insertData['amount'];
                if($remainAmount>0&&$remainAmount<$min)$statusid=3;
                else if($remainAmount>=$min)$statusid=1;
                else $statusid=2;
                updateTb('supplies',array("remain_amount"=>$remainAmount,"statusid"=>$statusid),'id="'.$insertData['supid'].'"');
            }else if($insertData['type']==2){
                $diff=$remainAmount-$insertData['amount'];
                $diff*=-1;
                if($insertData['amount']>0&&$insertData['amount']<$min)$statusid=3;
                else if($insertData['amount']>=$min)$statusid=1;
                else $statusid=2;
                updateTb('supplies',array("remain_amount"=>$insertData['amount'],"statusid"=>$statusid),'id="'.$insertData['supid'].'"');
                $insertData['amount']=$diff;
            }else if($insertData['type']==3){
                $remainAmount-=$insertData['amount'];
                if($remainAmount>0&&$remainAmount<$min)$statusid=3;
                else if($remainAmount>=$min)$statusid=1;
                else $statusid=2;
                updateTb('supplies',array("remain_amount"=>$remainAmount,"statusid"=>$statusid),'id="'.$insertData['supid'].'"');
            }
            insertTb('transaction',$insertData);
        }

function genTbody(){
    $res="";
    $data=selectTb('supplies','sid,name,cname,min,max,unit,pic,box,remain_amount,statusid','catid="'.$_POST['Group'].'" order by id ASC; ');
    foreach($data as $k){
        $res.="<tr>".
                    "<td style='width: 10%'><div class='img-with-text'><img src='".site_url("system/pictures/spare/".$k['pic'],true)."'".
                        "border='3' height='100' width='100' alt='".$k['sid']."'></img><p>".$k['sid']."</p></div></td>".
                    "<td style='width: 40%; word-wrap: break-word;'>
                        <div class='box-body'>
                            <b>ชื่อ : </b>".$k['name']."<br>
                            <b>ชื่อเรียก : </b>".$k['cname']."<br>
                            <b>ตำแหน่ง : </b>".$k['box'].
                        "</div>
                        <a href='#addAmount' data-toggle='tab'>
                            <button id='btnAddAmount' class='btn btn-info' value='".$k['sid']."'>
                                <span class='fa fa-plus-circle'></span>&nbsp;"."เพิ่มจำนวน
                            </button>
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <a href='#Adjustamount' data-toggle='tab'>
                            <button id='btnAdjust' class='btn btn-warning' value='".$k['sid']."'>
                                <span class='fa fa-refresh'>
                                </span>&nbsp;ปรับยอด
                            </button>
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <a href='#Edit' data-toggle='tab'>
                            <button id='btnEdit' class='btn btn-danger' value='".$k['sid']."'>
                                <span class='fa fa-cog'></span>&nbsp;แก้ไขข้อมูล
                            </button>
                        </a>
                    </td>".
                    "<td style='width: 10%; text-align:center;'>".getStatus($k['statusid'])."</td>".
                    "<td style='width: 10%; text-align:center;'>".$k['remain_amount']."</td>".
                    "<td style='width: 10%; text-align:center;'>".getUnit($k['unit'])."</td>".
                    "<td style='width: 10%; text-align:center;'>".$k['min']."</td>".
                    "<td style='width: 10%; text-align:center;'>".$k['max']."</td>".
                "</tr>";
    }
    return $res;
}

function getStatus($id){
    $data=selectTb('status_data','detail','id="'.$id.'"');
    return $data[0]['detail'];
}

function getUnit($id){
    $data=selectTb('unit_data','unit_name','id="'.$id.'"');
    return $data[0]['unit_name'];
}

if(isset($_POST['Group']))$ret=genTbody();

//$subtitle=current_user('name')." ".current_user('surname');

?>

<style>
    .img-with-text {
        text-align: center;
    }

    .img-with-text img {
        display: block;
        margin: 0 auto;
    }
</style>

<!-- Main content -->

<div class="callout callout-info" id="saveAlert">

    <h4><i class="icon fa fa-info"></i> บันทึก!</h4>

    <p>บันทึกข้อมูลเรียบร้อยแล้ว.</p>

</div>

<div class="row">
    <div class="col-sm-12">

        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">

                <li id="liDisplay" class="active"><a href="#display" data-toggle="tab">รายการวัสดุ</a></li>

                <li><a href="#addNew" data-toggle="tab">เพิ่มวัสดุในระบบ</a></li>

                <li id="liAddAmount"><a href="#addAmount" data-toggle="tab">เพิ่มจำนวนวัสดุ</a></li>

                <li id="liAdjust"><a href="#Adjustamount" data-toggle="tab">ปรับยอดจำนวนวัสดุ</a></li>

                <li id="liEdit"><a href="#Edit" data-toggle="tab">แก้ไขข้อมูลวัสดุ</a></li>

            </ul>

            <div class="tab-content">

                <div class="tab-pane" id="addNew">
                    <form id="insertData" action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group">
                            <label for="inputDept" class="col-sm-2 control-label">รหัสวัสดุ</label>
                            <div id="noDiv" class="col-sm-10 has-feedback">
                                <input autocomplete = 'off'type="text" class="form-control" id="inputNosup" name="Nosup" placeholder="รหัสวัสดุ" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">ชื่อวัสดุ</label>
                            <div id="nameDiv" class="col-sm-10 has-feedback">
                                <input autocomplete = 'off' type="text" class="form-control" id="inputNamesup" name="Namesup" placeholder="ชื่อวัสดุ" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">ชื่อเรียกวัสดุ</label>
                            <div id="callDiv" class="col-sm-10 has-feedback">
                                <input autocomplete = 'off' type="text" class="form-control" id="inputCallname" name="Callname" placeholder="ชื่อเรียก" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Minimum</label>
                            <div id="minDiv" class="col-sm-10 has-feedback">
                                <input autocomplete = 'off' type="text" class="form-control" id="inputMin" name="Min" placeholder="Minimum" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDept" class="col-sm-2 control-label">Maximum</label>
                            <div id="maxDiv" class="col-sm-10 has-feedback">
                                <input autocomplete = 'off' type="text" class="form-control" id="inputMax" name="Max" placeholder="Maximum" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPos" class="col-sm-2 control-label">หน่วยนับ</label>
                            <div id="unitDiv" class="col-sm-10 has-feedback">
                                <select class="form-control" id="optUnit" name="Unit">
                                    <option disabled selected value="def">Select one</option>
                                    <?php
                                    $unitdata = selectTb('unit_data', 'id,unit_name');
                                    foreach ($unitdata as $k => $v) {
                                        print("<option value='" . $v['id'] . "'>" . $v['unit_name'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDept" class="col-sm-2 control-label">พื้นที่จัดเก็บ</label>
                            <div id="areaDiv" class="col-sm-10 has-feedback">
                                <input autocomplete = 'off' type="text" class="form-control" id="inputArea" name="Area" placeholder="พื้นที่จัดเก็บ" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPos" class="col-sm-2 control-label">หมวดหมู๋</label>
                            <div id="groupDiv" class="col-sm-10 has-feedback">
                                <select class="form-control" id="optGroup" name="Group">
                                    <option disabled selected value="def">Select one</option>
                                    <?php
                                    $unitdata = selectTb('catagory', 'id,nameid,detail');
                                    foreach ($unitdata as $k => $v) {
                                        print("<option value='" . $v['id'] . "'>" . $v['nameid'] . " : " . $v['detail'] . "</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSkills" class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <div id="image_preview"><img id="previewing" src="<?php print site_url('system/pictures/spare/noimage.png', true); ?>" width="160" /></div>
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-photo"></i> เลือกรูปวัสดุ
                                    <input type="file" class="form-control" id="sparePicture" name="sparePicture">
                                </div>
                                <span id="loading">กรุณารอ..</span>
                                <span id="message"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">บันทึกข้อมูล</button><span id="updateMessage"></span>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="active tab-pane" id="display">
                    <form class="form-horizontal" method="post" action="<?php print site_url('main/admin/supplies/index'); ?>" id="selectGroup">
                        <div class="form-group" >
                            <label for="inputPos" class="col-sm-2 control-label">เลือกหมวดหมู่ของวัสดุ</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="displayOption" name="Group">
                                    <option disabled <?php if(!isset($_POST['Group']))echo "selected" ?> value="def">Select one</option>
                                    <?php
                                    $unitdata = selectTb('catagory', 'id,nameid,detail');
                                    foreach ($unitdata as $k => $v) {
                                        $opt="<option";
                                        $opt.=(isset($_POST['Group'])&&$_POST['Group']==$v['id'])? " selected ":" ";
                                        $opt.="value='" . $v['id'] . "'>" . $v['nameid'] . " : " . $v['detail'] . "</option>";
                                        // print("<option value='" . $v['id'] . "'>" . $v['nameid'] . " : " . $v['detail'] . "</option>");
                                        print $opt;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </form>
                    <!-- ** -->
                    <div class="box-body table-responsive no-padding">
                    <table id="tbData" class="table table-striped table-bordered" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th style='width: 14%; text-align: center;'>รูป</th>
                                <th style='width: 40%; text-align: center;'>รายการ</th>
                                <th style='width: 10%; text-align: center;'>สถานะ</th>
                                <th style='width: 10%; text-align: center;'>คงเหลือ</th>
                                <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                <th style='width: 8%; text-align: center;'>Min</th>
                                <th style='width: 8%; text-align: center;'>Max</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php print $ret;?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style='width: 14%; text-align: center;'>รูป</th>
                                <th style='width: 40%; text-align: center;'>รายการ</th>
                                <th style='width: 10%; text-align: center;'>สถานะ</th>
                                <th style='width: 10%; text-align: center;'>คงเหลือ</th>
                                <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                <th style='width: 8%; text-align: center;'>Min</th>
                                <th style='width: 8%; text-align: center;'>Max</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>

                <div class="tab-pane" id="addAmount">
                    กรุณาเลือกวัสดุที่ต้องการเพิ่มจำนวนจากหน้ารายการวัสดุก่อน
                </div>

                <div class="tab-pane" id="Adjustamount">
                    กรุณาเลือกวัสดุที่ต้องการปรับยอดจำนวนจากหน้ารายการวัสดุก่อน
                </div>


                <div class="tab-pane" id="Edit">
                    กรุณาเลือกวัสดุที่ต้องการแก้ไขจากหน้ารายการวัสดุก่อน
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#saveAlert').hide();
    $('#loading').hide();
</script>

<script>
    function chkNo(){
        var no=$('#inputNosup').val();
        console.log(no);
        if(no==''){
            $('#noDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#noDiv').attr('class','col-sm-10 has-success has-feedback');
        return no;
    }

    function chkName(){
        var name=$('#inputNamesup').val();
        console.log(name);
        if(name==''){
            $('#nameDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#nameDiv').attr('class','col-sm-10 has-success has-feedback');
        return name;
    }

    function chkCall(){
        var cname=$('#inputCallname').val();
        console.log(cname);
        if(cname==''){
            $('#callDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#callDiv').attr('class','col-sm-10 has-success has-feedback');
        return cname;
    }
    function chkMin(){
        var min=$('#inputMin').val();
        console.log(min);
        if(min==''){
            $('#minDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#minDiv').attr('class','col-sm-10 has-success has-feedback');
        return min;
    }
    function chkMax(){
        var max=$('#inputMax').val();
        console.log(max);
        if(max==''){
            $('#maxDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#maxDiv').attr('class','col-sm-10 has-success has-feedback');
        return max;
    }
    function chkUnit(){
        var unit=$('#optUnit').val();
        console.log(unit);
        if(unit==null){
            $('#unitDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#unitDiv').attr('class','col-sm-10 has-success has-feedback');
        return unit;
    }
    function chkArea(){
        var area=$('#inputArea').val();
        console.log(area);
        if(area==''){
            $('#areaDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#areaDiv').attr('class','col-sm-10 has-success has-feedback');
        return area;
    }
    function chkGroup(){
        var group=$('#optGroup').val();
        console.log(group);
        if(group==null){
            $('#groupDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#groupDiv').attr('class','col-sm-10 has-success has-feedback');
        return group;
    }

    function chkEditNo(){
        var no=$('#editInputNosup').val();
        console.log(no);
        if(no==''){
            $('#editNoDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#editNoDiv').attr('class','col-sm-10 has-success has-feedback');
        return no;
    }
    function chkEditName(){
        var name=$('#editInputNamesup').val();
        console.log(name);
        if(name==''){
            $('#editNameDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#editNameDiv').attr('class','col-sm-10 has-success has-feedback');
        return name;
    }
    function chkEditCall(){
        var cname=$('#editInputCallname').val();
        console.log(cname);
        if(cname==''){
            $('#editCallDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#editCallDiv').attr('class','col-sm-10 has-success has-feedback');
        return cname;
    }
    function chkEditMin(){
        var min=$('#editInputMin').val();
        console.log(min);
        if(min==''){
            $('#editMinDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#editMinDiv').attr('class','col-sm-10 has-success has-feedback');
        return min;
    }
    function chkEditMax(){
        var max=$('#editInputMax').val();
        console.log(max);
        if(max==''){
            $('#editMaxDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#editMaxDiv').attr('class','col-sm-10 has-success has-feedback');
        return max;
    }
    function chkEditUnit(){
        var unit=$('#editOptUnit').val();
        console.log(unit);
        if(unit==null){
            $('#editUnitDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#editUnitDiv').attr('class','col-sm-10 has-success has-feedback');
        return unit;
    }
    function chkEditArea(){
        var area=$('#editInputArea').val();
        console.log(area);
        if(area==''){
            $('#editAreaDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#editAreaDiv').attr('class','col-sm-10 has-success has-feedback');
        return area;
    }
    function chkEditGroup(){
        var group=$('#editOptGroup').val();
        console.log(group);
        if(group==null){
            $('#editGroupDiv').attr('class','col-sm-10 has-error has-feedback');
            return false;
        }
        $('#editGroupDiv').attr('class','col-sm-10 has-success has-feedback');
        return group;
    }
    $(function() {
        $("#insertData").on('submit', (function(e) {
            e.preventDefault();
            $("#message").empty();
            $('#loading').show();
            var no=chkNo();
            var name=chkName();
            var cname=chkCall();
            var min=chkMin();
            var max=chkMax();
            var unit=chkUnit();
            var area=chkArea();
            var group=chkGroup();
            // $('#saveAlert').slideDown('slow').delay(1000).slideUp();
            // return;
            if(no&&name&&cname&&min&&max&&unit&&area&&group){
            $.ajax({
                url: "<?php print site_url('ajax/admin/supplies/addNew/'); ?>", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                dataType:'json',
                success: function(res) // A function to be called if request succeeds
                {
                    console.log(res);
                    if(res.code===400){
                        $('#noDiv').attr('class','col-sm-10 has-error has-feedback');
                        $('#saveAlert h4').html('<i class="icon fa fa-info"></i> Warning!');
                        $('#saveAlert p').text(res.status);
                        $('#saveAlert').attr('class','callout callout-danger');
                        $('#loading').hide();
                        // $('#previewing').attr('src','<?php print site_url('system/pictures/spare/noimage.png',true);?>');
                    }else if(res.code===200){
                        $('#saveAlert h4').html('<i class="icon fa fa-info"></i> บันทึก!');
                        $('#saveAlert p').text(res.status);
                        $('#saveAlert').attr('class','callout callout-info');
                        $('#loading').hide();
                        $('#noDiv').attr('class','col-sm-10 has-feedback');
                        $('#nameDiv').attr('class','col-sm-10 has-feedback');
                        $('#callDiv').attr('class','col-sm-10 has-feedback');
                        $('#minDiv').attr('class','col-sm-10 has-feedback');
                        $('#maxDiv').attr('class','col-sm-10 has-feedback');
                        $('#unitDiv').attr('class','col-sm-10 has-feedback');
                        $('#areaDiv').attr('class','col-sm-10 has-feedback');
                        $('#groupDiv').attr('class','col-sm-10 has-feedback');
                        $('#insertData')[0].reset();
                        $('#previewing').attr('src','<?php print site_url('system/pictures/spare/noimage.png',true);?>');
                    }
                    $("html, body").animate({scrollTop: 0}, 1000);
                    $('#saveAlert').slideDown('slow').delay(1000).slideUp();
                }
            });
            }else{
                $('#saveAlert h4').html('<i class="icon fa fa-info"></i> Warning!');
                $('#saveAlert p').text("กรุณากรอกข้อมูลให้ครบถ้วน");
                $('#saveAlert').attr('class','callout callout-danger');
                $('#loading').hide();
                $("html, body").animate({scrollTop: 0}, 1000);
                $('#saveAlert').slideDown('slow').delay(1000).slideUp();
            }
            return false;
        }));

        $("#sparePicture").change(function() {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            if (!file) {
                $('#previewing').attr('src', '<?php print site_url('system/pictures/spare/noimage.png', true); ?>');
            } else {
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    $('#previewing').attr('src', '<?php print site_url('system/pictures/spare/noimage.png ', true); ?>');
                    $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                    return false;
                } else {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            }
        });
    });

    function imageIsLoaded(e) {
        $("#sparePicture").css("color", "green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '160px');
    };
</script>

<script src="<?php print site_url("system/template/AdminLTE/plugins/iCheck/icheck.min.js", true); ?>"></script>
<script src="<?php print site_url("system/template/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js", true); ?>"></script>
<script src="<?php print site_url("system/template/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js", true); ?>"></script>

<script>
    function bkDisplay(isInsert){
        if(!isInsert){
            $('#liDisplay').addClass("active");
            $('#liAddAmount').removeClass("active");
            $('#liAdjust').removeClass("active");
            $('#liEdit').removeClass('active');
        }else{
            $('#insertAmount').submit();
        }
        $('#Edit').html('กรุณาเลือกวัสดุที่ต้องการแก้ไขจากหน้ารายการวัสดุก่อน');
        $('#addAmount').html("กรุณาเลือกวัสดุที่ต้องการเพิ่มจำนวนจากหน้ารายการวัสดุก่อน");
        $('#Adjustamount').html("กรุณาเลือกวัสดุที่ต้องการปรับยอดจำนวนจากหน้ารายการวัสดุก่อน");
    }

    $('[id="btnAddAmount"]').on("click",function(){
        $.post('<?php print site_url('ajax/admin/supplies/existData');?>',{
            supid: this.value,
            type:1
        }).done(function(data){
            console.log(data);
            $('#addAmount').html(data);
            $('#liAddAmount').addClass("active");
            $('#liDisplay').removeClass("active");
        });
    });

    $('[id="btnAdjust"]').on("click",function(){
        $.post('<?php print site_url('ajax/admin/supplies/existData');?>',{
            supid: this.value,
            type:2
        }).done(function(data){
            console.log(data);
            $('#Adjustamount').html(data);
            $('#liAdjust').addClass("active");
            $('#liDisplay').removeClass("active");
        });
    });

    $('[id="btnEdit"]').on("click",function(){
        $.post('<?php print site_url('ajax/admin/supplies/editData');?>',{
            supid:this.value
        }).done(function(data){
            console.log(data);
            $('#Edit').html(data);
            $("#editLoading").hide();
            $('#liEdit').addClass("active");
            $('#liDisplay').removeClass("active");
        });
    });


    $('#tbData').DataTable({
        "language":{
            "search":"ค้นหา : ",
            "searchPlaceholder":"พิมพ์คำที่ต้องการค้นหา"
        }
    });

    $('#displayOption').change(function() {
        $('#selectGroup').submit();
    });

    function showUpdate(txt) {
        $("#systemAlert").html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i><b>' +
            txt +
            '</b></div>').hide().slideDown();
        $(function() {
            setTimeout(function() {
                $("#systemAlert").slideUp()
            }, 3000);
        });
    }
</script>