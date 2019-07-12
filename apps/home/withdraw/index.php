<?php

$title = "จัดการวัสดุ";

$siteName_data = getConfig('siteName', 'detail');

$subName_data = getConfig('subName', 'detail');

function genTbody($hasFilter=false){
    $res="";
    if($hasFilter)$data=selectTb('supplies','id,sid,name,cname,min,max,unit,pic,box,remain_amount,statusid,catid','catid="'.$_POST['Group'].'"');
    else $data=selectTb('supplies','id,sid,name,cname,min,max,unit,pic,box,remain_amount,statusid,catid');
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
                        
                    </td>".
                    "<td style='width: 10% text-align:center; word-wrap: break-word;'>".getCatagories($k['catid'])."</td>".
                    "<td style='width: 10%; text-align:center;'>".$k['remain_amount']."</td>".
                    "<td style='width: 10%; text-align:center;'>".getUnit($k['unit'])."</td>".
                    "<td style='width: 10%; text-align:center;'>";
                    if ((getStatus($k['statusid'])=='ปกติ'||getStatus($k['statusid'])=='ใกล้หมด')&&(!isset($_SESSION['cart'][$k['id']])||$_SESSION['cart'][$k['id']]==""||$_SESSION['cart'][$k['id']]==null))
                        $res.=
                            "<a href='#withdrawAmount' data-toggle='tab'>
                                <button id='btnWithdraw' class='btn btn-success' value='".$k['sid']."'>
                                    <span class='fa fa-chain'></span>&nbsp;"."เบิกวัสดุ
                                </button>
                            </a>";
                    else if(isset($_SESSION['cart'][$k['id']])&&$_SESSION['cart'][$k['id']]!=""&&$_SESSION['cart'][$k['id']]!=null){
                        $res.="<button class='btn btn-warning' disabled><span class='fa fa-clock-o'>&nbsp;รอส่งใบเบิก</span></button>";
                    }else{
                            $res.="<button class='btn btn-danger' disabled>หมดสต็อก</button> ";
                    }
                $res.="</td>".
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

function getCatagories($id){
    $data=selectTb('catagory','nameid,detail','id="'.$id.'"');
    return $data[0]['nameid']." : ".$data[0]['detail'];
}

$ret=genTbody(isset($_POST['Group'])&&$_POST['Group']!="def");

// print_r($_SESSION['cart']);

function genPendingTbody(){
    $condition="(";
    $i=0;
    foreach($_SESSION['cart'] as $k=>$v){
        if($v!=null&&$v!=""){
            if($i)$condition.=",";
            $condition.="'".$k."'";
            $i++;
        }
    }
    $condition.=")";
    if($condition=="()")return;
    $res="";
    $data=selectTb('supplies','id,sid,name,cname,min,max,unit,pic,box,remain_amount,statusid,catid','id in '.$condition);
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
                        
                    </td>".
                    "<td style='width: 10% text-align:center; word-wrap: break-word;'>".getCatagories($k['catid'])."</td>".
                    "<td style='width: 10%; text-align:center;'>".$_SESSION['cart'][$k['id']]['amount']."</td>".
                    "<td style='width: 10%; text-align:center;'>".getUnit($k['unit'])."</td>".
                    "<td style='width: 10%; text-align:center;'><a href='#withdrawAmount' data-toggle='tab'><button class='btn btn-warning' id='editPending' value='".$k['sid']."'><span class='fa fa-gear'>&nbsp;แก้ไข</span></button></a></td>".
                    "<td style='width: 10%; text-align:center;'><button class='btn btn-danger' id='deletePending' value='".$k['id']."'><span class='fa fa-trash'>&nbsp;ลบ</span></button></td>".               
                "</tr>";
    }
    return $res;
}

if(isset($_SESSION['cart']))$pendingWithdraw=genPendingTbody();

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

                <li id="liWithdraw"><a href="#withdrawAmount" data-toggle="tab">ระบุจำนวนเบิกวัสดุ</a></li>

                <li id="liPending"><a href="#pendingWithdraw" data-toggle="tab">พัสดุที่รอส่งใบเบิก</a></li>
<!-- 
                <li id="liAdjust"><a href="#Adjustamount" data-toggle="tab">ปรับยอดจำนวนวัสดุ</a></li>

                <li id="liEdit"><a href="#Edit" data-toggle="tab">แก้ไขข้อมูลวัสดุ</a></li> -->

            </ul>

            <div class="tab-content">

                <div class="tab-pane" id="addNew">
                    
                </div>

                <div class="active tab-pane" id="display">
                    <form class="form-horizontal" method="post" action="<?php print site_url('main/home/withdraw/index'); ?>" id="selectGroup">
                        <div class="form-group" >
                            <label for="inputPos" class="col-sm-2 control-label">เลือกหมวดหมู่ของวัสดุ</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="displayOption" name="Group">
                                    <option <?php if(!isset($_POST['Group']))echo "selected" ?> value="def">Select one</option>
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
                                <th style='width: 15%; text-align: center;'>รูป</th>
                                <th style='width: 40%; text-align: center;'>รายการ</th>
                                <th style='width: 15%; text-align: center'>หมวดหมู่</th>
                                <th style='width: 10%; text-align: center;'>คงเหลือ</th>
                                <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                <th style='width: 10%; text-align: center;'>ตัวเลือก</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                                <?php print $ret;?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style='width: 15%; text-align: center;'>รูป</th>
                                <th style='width: 40%; text-align: center;'>รายการ</th>
                                <th style='width: 15%; text-align: center'>หมวดหมู่</th>
                                <th style='width: 10%; text-align: center;'>คงเหลือ</th>
                                <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                <th style='width: 10%; text-align: center;'>ตัวเลือก</th>
                                
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>

                <div class="tab-pane" id="withdrawAmount">
                    กรุณาเลือกวัสดุที่จะระบุจำนวนจากหน้ารายการวัสดุก่อน
                </div>

                <div class="tab-pane" id="pendingWithdraw">
                    <div class="box-header">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success" id="btnCon">ยืนยันการเบิกวัสดุ</button><br>
                    </div>
                    <div class="box-body table-responsive no-padding">
                    <table id="tbData2" class="table table-striped table-bordered" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th style='width: 10%; text-align: center;'>รูป</th>
                                <th style='width: 40%; text-align: center;'>รายการ</th>
                                <th style='width: 10%; text-align: center'>หมวดหมู่</th>
                                <th style='width: 10%; text-align: center;'>จำนวน</th>
                                <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                <th style='width: 10%; text-align: center;'>แก้ไข</th>
                                <th style='width: 10%; text-align: center;'>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php print $pendingWithdraw;?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style='width: 10%; text-align: center;'>รูป</th>
                                <th style='width: 40%; text-align: center;'>รายการ</th>
                                <th style='width: 10%; text-align: center'>หมวดหมู่</th>
                                <th style='width: 10%; text-align: center;'>จำนวน</th>
                                <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                <th style='width: 10%; text-align: center;'>แก้ไข</th>
                                <th style='width: 10%; text-align: center;'>ลบ</th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>


                <div class="tab-pane" id="Edit">
                    กรุณาเลือกวัสดุที่ต้องการแก้ไขจากหน้ารายการวัสดุก่อน
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('[id="editPending"]').on("click",function(){
        // alert(this.value);
        $.post('<?php print site_url("ajax/home/withdraw/withdrawAmount");?>',{
            supid: this.value
        }).done(function(data){
            console.log();
            $('#withdrawAmount').html(data);
            $("#liPending").removeClass('active');
            $('#liWithdraw').addClass('active');
        });
    });

    $('[id="btnWithdraw"]').on("click",function(){   //ขยับแถบสีบน Tab
        $.post('<?php print site_url("ajax/home/withdraw/withdrawAmount");?>',{
            supid: this.value
        }).done(function(data){
            console.log(data);
            $('#withdrawAmount').html(data);
            $('#liDisplay').removeClass('active');
            $('#liWithdraw').addClass('active');
        });
    });

    $('#saveAlert').hide();
    $('#loading').hide();

    $('#btnCon').on("click",function(){
        $.post('<?php print site_url("ajax/home/withdraw/Confirm");?>',{

        },function(res){
            console.log(res);
            if(res.code.update===200&&res.code.insert===200){
                $('#saveAlert h4').html('<i class=\"icon fa fa-info\"></i> Warning!');
                $('#saveAlert p').text(res.status);
                $('#saveAlert').attr('class','callout callout-info');
                $("html, body").animate({scrollTop: 0}, 1000);
                $('#saveAlert').slideDown('slow').delay(1000).slideUp(400,function(){
                    window.location.href=window.location;
                });
            }else{
                $('#saveAlert h4').html('<i class=\"icon fa fa-info\"></i> Warning!');
                $('#saveAlert p').text(res.status);
                $('#saveAlert').attr('class','callout callout-danger');
                $("html, body").animate({scrollTop: 0}, 1000);
                $('#saveAlert').slideDown('slow').delay(1000).slideUp();
            }
        },"json")
    })
</script>

<script>

</script>

<script src="<?php print site_url("system/template/AdminLTE/plugins/iCheck/icheck.min.js", true); ?>"></script>
<script src="<?php print site_url("system/template/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js", true); ?>"></script>
<script src="<?php print site_url("system/template/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js", true); ?>"></script>

<script>
    
    $('[id="deletePending"]').on("click",function(){
        if(confirm("คุณแน่ใจที่จะลบ?")){
        $.post('<?php print site_url('ajax/home/withdraw/removeCart')?>',{
            id: this.value
        },function(res){
            console.log(res);
            if(res.code==200){
                $("html, body").animate({scrollTop: 0}, 1000);
                $('#saveAlert p').html(res.status);
                $('#saveAlert').slideDown('slow').delay(1000).slideUp(400,'swing',function(){
                    window.location.href=window.location;
                });
            }

        },"json");
        }
    });
    $('#tbData').DataTable({
        "language":{
            "search":"ค้นหา : ",
            "searchPlaceholder":"พิมพ์คำที่ต้องการค้นหา"
        }
    });

    $('#tbData2').DataTable({
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