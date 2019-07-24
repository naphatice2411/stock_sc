<?php
$title = "รายงานยอดคงเหลือ";
?>
<link rel="stylesheet" href="<?php print(site_url('system/template/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css', true)); ?>">

<div class="row">
    <div class="col-md-12">
        <div id="yearPicker" class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">เลือกรายงานที่ต้องการตรวจสอบ</h3>
                <div class="box-tools pull-right">
                    <button id="btnYearPicker" type="button" class="btn btn-box-tool" data-widget="collapse"><i id="plusMinus" class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form autocomplete="off" id="yrPicker" action="<?php print site_url('main/stock/showStock/index'); ?>" method="post">
                    <div class="form-group">
                        <label for="inputType" class="col-sm-2 control-label">เลือกประเภทรายงาน</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="optType" name="type">
                                <option disabled selected>select one</option>
                                <option value="0">รายงานวัสดุคงคลัง</option>
                                <?php
                                $statusData = selectTb('status_data', 'id,detail');
                                foreach ($statusData as $k => $v) {
                                    if ($v['id'] > 3) continue;
                                    $opt = "<option ";
                                    $opt .= "value='" . $v['id'] . "'> รายงานวัสดุสถานะ" . $v['detail'] . "</option>";
                                    print $opt;
                                }
                                ?>
                            </select>
                        </div>
                        <label for="inputDept" class="col-sm-2 control-label">เลือกหมวดหมู่วัสดุ</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="optGroup" name="Group">
                                <option <?php if (!isset($_POST['Group'])) echo "selected" ?> value="0">All</option>
                                <?php
                                $unitdata = selectTb('catagory', 'id,nameid,detail');
                                foreach ($unitdata as $k => $v) {
                                    $opt = "<option";
                                    $opt .= (isset($_POST['Group']) && $_POST['Group'] == $v['id']) ? " selected " : " ";
                                    $opt .= "value='" . $v['id'] . "'>" . $v['nameid'] . " : " . $v['detail'] . "</option>";
                                    // print("<option value='" . $v['id'] . "'>" . $v['nameid'] . " : " . $v['detail'] . "</option>");
                                    print $opt;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">รายงาน</h3>
                <button id="dlPdf" class="btn btn-sm btn-danger pull-right" disabled><i class="fa fa-file-pdf-o"></i> Download</button>
            </div>
            <div class="box-body">
                <!-- <div class="row"> -->
                <!-- <div class="col-sm-12"> -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped" id="tbData">
                        <thead>
                            <tr>
                                <th style='width: 10%; text-align: center;'>รหัส</th>
                                <th style='width: 25%; text-align: center;'>ชื่อ</th>
                                <th style='width: 10%; text-align: center;'>หมวดหมู่</th>
                                <th style='width: 10%; text-align: center;'>ที่เก็บ</th>
                                <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                <th style='width: 10%; text-align: center;'>min</th>
                                <th style='width: 10%; text-align: center;'>max</th>
                                <th style="width: 10%; text-align: center;">สถานะ</th>
                                <th style="width: 5%; text-align: center;">คงเหลือ</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th style='width: 10%; text-align: center;'>รหัส</th>
                                <th style='width: 25%; text-align: center;'>ชื่อ</th>
                                <th style='width: 10%; text-align: center;'>หมวดหมู่</th>
                                <th style='width: 10%; text-align: center;'>ที่เก็บ</th>
                                <th style='width: 10%; text-align: center;'>หน่วยนับ</th>
                                <th style='width: 10%; text-align: center;'>min</th>
                                <th style='width: 10%; text-align: center;'>max</th>
                                <th style="width: 10%; text-align: center;">สถานะ</th>
                                <th style="width: 5%; text-align: center;">คงเหลือ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- </div> -->
                <!-- </div> -->
            </div>
            <div class="box-body" id="test"></div>
        </div>
    </div>
</div>

<script src="<?php print(site_url('system/template/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js', true)); ?>"></script>
<script src="<?php print(site_url('system/template/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', true)); ?>"></script>
<script>
    var datatable = $('#tbData').DataTable();

    $('#optType').change(function() {
        $('#dlPdf').attr('disabled',false);
        $.post('<?php print site_url('ajax/admin/report/getRemainDetail'); ?>', {
            type: this.value,
            group: $('#optGroup').val()
        }, function(res) {
            // console.log(res);
            datatable.clear();
            if (res.table != null) datatable.rows.add(res.table);
            // datatable.columns(1).footer().to$().text('My title');
            datatable.draw();
        }, "json");
    });
    $('#optGroup').change(function() {
        $('#dlPdf').attr('disabled',false);
        $.post('<?php print site_url('ajax/admin/report/getRemainDetail'); ?>', {
            type: $('#optType').val(),
            group: this.value
        }, function(res) {
            // console.log(res);
            datatable.clear();
            if (res.table != null) datatable.rows.add(res.table);
            datatable.draw();
        }, "json");
    });
    $('#dlPdf').on('click', function() {
        var oldHtml=$('#dlPdf').html();
        $('#dlPdf').html('<i class="fa fa-spinner"></i> กรุณารอสักครู่');
        $('#dlPdf i').addClass('fa fa-spin');
        $.post('<?php print site_url('ajax/admin/report/genRemainPdf'); ?>', {
            type: $('#optType').val(),
            group: $('#optGroup').val()
        }, function(res) {
            console.log(res);
            if (res.code === 200) {
                $('#dlPdf').html(oldHtml);
                newlink = document.createElement('a');
                newlink.setAttribute('download',res.name);
                newlink.setAttribute('href', res.pdf);
                newlink.click();
                newlink.remove();
                // $('#dlPdf').attr('disabled',true);
            }
        }, "json");
    });
</script>