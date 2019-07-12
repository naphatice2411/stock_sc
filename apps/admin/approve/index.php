<?php
$title = "อนุมัติรายการสั่งซื้อ";
function genPendingTbody()
{
    $res = "";
    $data = selectTb('order', 'id,pic,name,amount,unit,line,remark,is_pending', 'is_userconfirm=0 and user_id="' . current_user('user_id') . '"');
    foreach ($data as $k) {
        $res .= "<tr>" .
            "<td style='width: 10%'><div class='img-with-text'><img src='" . site_url("system/pictures/spare/" . $k['pic'], true) . "'" .
            "border='3' height='100' width='100' alt=''></img></div></td>" .
            "<td style='width: 40%; word-wrap: break-word;'>" . $k['name'] . "</td>" .
            "<td style='width: 10%; text-align:center; word-wrap: break-word;'>" . $k['amount'] . "</td>" .
            "<td style='width: 10%; text-align:center;'>" . $k['unit'] . "</td>" .
            "<td style='width: 10%; text-align:center;'>" . $k['line'] . "</td>" .
            "<td style='width: 10%; text-align:center;'>".
                '<div class="btn-group">
                    <button class="btn btn-default" type="button">ตอบรับ</button>
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul id="btnAction" class="dropdown-menu" role="menu">
                        <li value="approve"><a href="#">อนุมัติ</a></li>
                        <li value="notApprove"><a href="#">ไม่อนุมัติ</a></li>
                    </ul>
                </div>'.
            "</td>" .
            "<td><button id='pendingStatus' value='".$k['id']."'";
                if($k['is_pending']==1)$res.=" class='btn btn-warning'><i class='fa fa-hand-stop-o'></i>รอสั่งของ</button>";
                else if($k['is_pending']==0)$res.=" class='btn btn-info'><i class='fa fa-hand-stop-o'></i>ของมาแล้ว</button>";
            $res.="</td>".
            "<td><button class='btn btn-danger'><span class='fa fa-trash'></span></button></td>".
            "</tr>";
    }
    return $res;
}
?>
<link href="<?php print site_url('system/template/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css', true); ?>" rel="stylesheet">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">อนุมัติรายการ</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped" id="tbData">
                            <thead>
                                <tr>
                                    <th style='width: 10%; text-align: center;'>รูป</th>
                                    <th style='width: 35%; text-align: center;'>ชื่อ</th>
                                    <th style='width: 10%; text-align: center;'>จำนวน</th>
                                    <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                    <th style='width: 10%; text-align: center;'>ไลน์</th>
                                    <th style='width: 10%; text-align: center;'>ตอบรับ</th>
                                    <th style="width: 10%; text_align: center;">สถานะ</th>
                                    <th style="width: 5%; text-align: center;">ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php print $pendingOrder = genPendingTbody(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style='width: 10%; text-align: center;'>รูป</th>
                                    <th style='width: 40%; text-align: center;'>ชื่อ</th>
                                    <th style='width: 10%; text-align: center;'>จำนวน</th>
                                    <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                    <th style='width: 10%; text-align: center;'>ไลน์</th>
                                    <th style='width: 20%; text-align: center;'>ตอบรับ</th>
                                    <th style="width: 10%; text_align: center;">สถานะ</th>
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

<script src="<?php print site_url('system/template/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js', true); ?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', true); ?>"></script>
<script>
    $('#tbData').DataTable();
    $('ul#btnAction li').on('click',function(e){
        alert(this.value);
    });

    $('[id="pendingStatus"]').on('click',function(){
        var t=$(this);
        t.html("<i id='iconStatus'></i>...");
        $('[id="iconStatus"]').removeClass().addClass('fa fa-refresh fa-spin');
        $.post('<?php print site_url('ajax/admin/approve/changePending')?>',{
            id: this.value
        },function(data){
            console.log(data);
            t.html(data.html);
            t.removeClass().addClass(data.class);
        },"json");
    });
</script>