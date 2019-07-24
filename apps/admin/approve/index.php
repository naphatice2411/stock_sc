<?php
if(current_user('user_type')!='administrator')redirect(current_user('default_uri'));
$title = "อนุมัติรายการสั่งซื้อ";
function genPendingTbody()
{
    $res = "";
    $data = selectTb('order', 'id,pic,name,amount,unit,line,remark,is_pending,user_id,is_approve', 'is_adminconfirm=0');
    foreach ($data as $k) {
        $pendingDisabled=$k['is_approve']!=1?" disabled":" ";
        $deleteDisabled=($k['is_approve']==1&&$k['is_pending']==1)||$k['is_approve']==null?" disabled":" ";
        $res .= "<tr>" .
            "<td style=''><div class='img-with-text'><img src='" . site_url("system/pictures/spare/" . $k['pic'], true) . "'" .
            "border='3' height='100' width='100' alt=''></img></div></td>" .
            "<td style='vertical-align: middle; word-wrap: break-word;'>" . $k['name'] . "</td>" .
            "<td id='amount' value='".$k['amount']."' style='vertical-align: middle; text-align:center; word-wrap: break-word;'>" . $k['amount'] . "</td>" .
            "<td style='vertical-align: middle; text-align:center;'>" . $k['unit'] . "</td>" .
            "<td style='vertical-align: middle; text-align:center;'>" . $k['line'] . "</td>" .
            "<td style='vertical-align: middle; text-align: center;'>" . getUserName($k['user_id']) . "</td>" .
            "<td style='vertical-align: middle; text-align:center;'>";
            if($k['is_approve']==null)
            $res.='<div class="btn-group">
                    <button class="btn btn-default" type="button">ตอบรับ</button>
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul id="btnAction" class="dropdown-menu" role="menu">
                        <li name="approve" value="'.$k['id'].'"><a class="liAction" href="#">อนุมัติ</a></li>
                        <li name="notApprove" value="'.$k['id'].'"><a class="liAction" href="#">ไม่อนุมัติ</a></li>
                    </ul>
                  </div>';
            else{
                $res.="<button disabled ";
                if($k['is_approve']==1)$res.="class='btn btn-success'>อนุมัติแล้ว";
                else $res.="class='btn btn-danger'>ไม่อนุมัติ";
                $res.="</button>";
            }
            $res.="</td>" .
            "<td style='vertical-align: middle; text-align: center;'><button ".$pendingDisabled." id='pendingStatus' value='" . json_encode(array(id=>$k['id'],amount=>$k['amount'])) . "'";
        if ($k['is_pending'] == 1) $res .= " class='btn btn-warning'><i class='fa fa-hand-stop-o'></i>รอสั่งของ</button>";
        else if ($k['is_pending'] == 0) $res .= " class='btn btn-info' disabled><i class='fa fa-hand-stop-o'></i>ของมาแล้ว</button>";
        $res .= "</td>" .
            "<td style='vertical-align: middle; text-align: center;'><button".$deleteDisabled." id='btnDelete' value='".$k['id']."' class='btn btn-danger'><span class='fa fa-trash'></span></button></td>" .
            "</tr>";
    }
    return $res;
}
function getUserName($id)
{
    $dataName = selectTb('userdata', 'name,surname', 'user_id="' . $id . '"');
    return $dataName[0]['name'] . " " . $dataName[0]['surname'];
}
?>
<link href="<?php print site_url('system/template/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css', true); ?>" rel="stylesheet">

<div class="callout callout-info" id="saveAlert">

    <h4><i class="icon fa fa-info"></i> บันทึก!</h4>

    <p>บันทึกข้อมูลเรียบร้อยแล้ว.</p>

</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">อนุมัติรายการ</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped" id="tbData">
                            <thead>
                                <tr>
                                    <th style='width: 10%; text-align: center;'>รูป</th>
                                    <th style='width: 15%; text-align: center;'>ชื่อ</th>
                                    <th style='width: 10%; text-align: center;'>จำนวน</th>
                                    <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                    <th style='width: 10%; text-align: center;'>ไลน์</th>
                                    <th style='width: 15%; text-align: center;'>ชื่อผู้สั่ง</th>
                                    <th style='width: 15%; text-align: center;'>ตอบรับ</th>
                                    <th style="width: 10%; text-align: center;">สถานะ</th>
                                    <th style="width: 5%; text-align: center;">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php print $pendingOrder = genPendingTbody(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style='width: 10%; text-align: center;'>รูป</th>
                                    <th style='width: 15%; text-align: center;'>ชื่อ</th>
                                    <th style='width: 10%; text-align: center;'>จำนวน</th>
                                    <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                    <th style='width: 10%; text-align: center;'>ไลน์</th>
                                    <th style='width: 15%; text-align: center;'>ชื่อผู้สั่ง</th>
                                    <th style='width: 15%; text-align: center;'>ตอบรับ</th>
                                    <th style="width: 10%; text-align: center;">สถานะ</th>
                                    <th style="width: 5%; text-align: center;">ลบ</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php print site_url('system/template/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js', true); ?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', true); ?>"></script>
<script>
    $('#tbData').DataTable({
        order: [[1, 'desc']],
        "columns": [
            {"orderable": false},
            null,
            null,
            {"orderable": false},
            null,
            null,
            null,
            null,
            {"orderable": false}
        ]
    });
    $('#saveAlert').hide();
    $('ul#btnAction li').on('click', function(e) {
        e.preventDefault();
        $.post('<?php print site_url('ajax/admin/approve/changeApproveSt');?>',{
            isApprove: $(this).attr('name')=="approve"?1:0,
            id:$(this).val()
        },function(res){
            // console.log(res);
            if(res.code===200){
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
        },"json");
    });

    $('[id="pendingStatus"]').on('click', function() {
        var t = $(this);
        t.html("<i id='iconStatus'></i>...");
        $('[id="iconStatus"]').removeClass().addClass('fa fa-refresh fa-spin');
        $.post('<?php print site_url('ajax/admin/approve/changePending') ?>', {
            val: this.value,
        }, function(data) {
            // console.log(data);
            t.html(data.html);
            t.removeClass().addClass(data.class);
            t.attr('disabled',true);
            setTimeout(function(){
                window.location.href=window.location;
            }, 1000);
        },"json");
    });

    $('[id="btnDelete"]').on('click',function(){
        $.post('<?php print site_url('ajax/admin/approve/hideFromAdmin');?>',{
            id: this.value
        },function(res){
            // console.log(res);
            if(res.code===200){
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
        },"json");
    });

    $("a.liAction").click(function(e){
        e.preventDefault();
    });
</script>