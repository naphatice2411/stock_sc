<?php
$title = "รายงานการเคลื่อนไหว";
?>
<link rel="stylesheet" href="<?php print(site_url('system/template/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css', true)); ?>">
<link href="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css', true); ?>" rel="stylesheet">
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
                    <div class="form-group col-sm-12">
                        <label for="inputType" class="col-sm-2 control-label">เลือกประเภทรายงาน</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="optType" name="type">
                                <option disabled selected>select one</option>
                                <option value="1">รายงานเพิ่มเข้า/ปรับยอดจำนวนวัสดุ</option>
                                <option value="2">รายงานการสั่งวัสดุ</option>
                                <option value="3">รายงานการเบิกวัสดุ</option>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">ในช่วงวันที่</label>
                        <div class="input-group col-sm-4">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="form-control pull-right" id="dateRange" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- /.input group -->
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

<script src="<?php print site_url('system/template/AdminLTE/bower_components/moment/min/moment.min.js', true); ?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js', true); ?>"></script>
<script>
    var datatable = $('#tbData').DataTable();
    var reCreate = false;
    var title;
    var startDate = moment();
    var endDate = moment();
    $('#dateRange').daterangepicker({
        startDate: moment(),
        endDate: moment(),
        opens: 'left',
        maxDate: moment()
    }).on('apply.daterangepicker', function(ev, picker) {
        startDate = picker.startDate;
        endDate = picker.endDate;
        if ($('#optType').val() == null) {
            alert("กรุณาเลือกประเภทรายงานก่อน");
            return;
        }
        // console.log(startDate.format('YYYY-MM-DD') + "' to '" + endDate.format('YYYY-MM-DD'));
        $('#dlPdf').attr('disabled', false);
        $.post('<?php print site_url('ajax/admin/report/getTransacDetail'); ?>', {
            type: $('#optType').val(),
            start: startDate.format('YYYY-MM-DD'),
            end: endDate.format('YYYY-MM-DD'),
        }, function(res) {
            // console.log(res);
            datatable.clear();
            $.each(res.title, function(k, v) {
                datatable.columns(k).header().to$().text(v);
                datatable.columns(k).footer().to$().text(v);
            });
            if (res.table != null) {
                $.each(res.table, function(i, v) {
                    var rowNode = datatable.row.add(v).draw().node();
                    $(rowNode).attr('style', 'text-align:center;');
                });
                // datatable.rows.add(res.table);
                // datatable.draw();
            }else{
                datatable.draw();
            }
        }, 'json');
    });

    $('#optType').change(function() {
        // console.log(startDate.format('YYYY-MM-DD') + "' to '" + endDate.format('YYYY-MM-DD'));
        $('#dlPdf').attr('disabled', false);
        $.post('<?php print site_url('ajax/admin/report/getTransacDetail'); ?>', {
            type: this.value,
            start: startDate.format('YYYY-MM-DD'),
            end: endDate.format('YYYY-MM-DD'),
        }, function(res) {
            // console.log(res);
            datatable.clear();
            $.each(res.title, function(k, v) {
                datatable.columns(k).header().to$().text(v);
                datatable.columns(k).footer().to$().text(v);
            });
            if (res.table != null) {
                $.each(res.table, function(i, v) {
                    var rowNode = datatable.row.add(v).draw().node();
                    $(rowNode).attr('style', 'text-align:center;');
                });
                // datatable.rows.add(res.table);
                // datatable.draw();
            }else{
                datatable.draw();
            }
        }, 'json');
    });

    $('#dlPdf').on('click', function() {
        var oldHtml=$('#dlPdf').html();
        $('#dlPdf').html('<i class="fa fa-spinner"></i> กรุณารอสักครู่');
        $('#dlPdf i').addClass('fa fa-spin');
        $.post('<?php print site_url('ajax/admin/report/genTransacPdf'); ?>', {
            type: $('#optType').val(),
            start: startDate.format('YYYY-MM-DD'),
            end: endDate.format('YYYY-MM-DD'),
        }, function(res) {
            // console.log(res);
            // $('#test').html(res);
            if (res.code === 200) {
                $('#dlPdf').html(oldHtml);
                newlink = document.createElement('a');
                newlink.setAttribute('download',res.name);
                newlink.setAttribute('href', res.pdf);
                newlink.click();
                newlink.remove();
                // $('#dlPdf').attr('disabled',true);
            }
        },'json');
    });
</script>