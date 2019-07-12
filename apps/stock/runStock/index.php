<?php
$title = "รันเลขพัสดุ";
$group_data = selectTb('cat_group', 'group_id,detail');

$group_datas = "";
foreach ($group_data as $k => $v) {
    $group_datas .= "<option value='" . $v['group_id'] . "'>" . $v['group_id'] . " (" . $v['detail'] . ") </option>";
}
?>
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>
<link rel="stylesheet" href="<?php print(site_url('system/template/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css', true)); ?>">
<div class="row">
    <div class="col-md-12">
        <div id="yearPicker" class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">ปีการศึกษาที่ต้องการรันเลขพัสดุ</h3>
                <div class="box-tools pull-right">
                    <button id="btnYearPicker" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="input-group date col-md-3">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input autocomplete="off" type="text" class="form-control pull-right" id="year">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div id="contentContainer" class="box box-default collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">กรอกข้อมูลพัสดุที่ต้องการ</h3>
                <div class="box-tools pull-right">
                    <button id="btnContentContainer" type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:25%">กลุ่มประเภทพัสดุ</th>
                            <th style="width:25%">ชนิดพัสดุ</th>
                            <th style="width:10%">จำนวน</th>
                            <th style="width:35%">หมายเหตุ</th>
                            <th style="width:5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:25%">
                                <select id="selectGroup" class="form-control">
                                    <option disabled selected value="def">เลือกกลุ่มประเภท</option>
                                    <?php
                                    foreach ($group_data as $k => $v) {
                                        print("<option value='" . $v['group_id'] . "'>" . $v['group_id'] . " (" . $v['detail'] . ") </option>");
                                    }
                                    ?>
                                </select>
                            </td>
                            <td style="width:25%">
                                <select id="selectCat" class="form-control">
                                    <option disabled selected value="def">กรุณาระบุกลุ่มประเภทก่อน</option>
                                </select>
                            </td>
                            <td style="width:10%"><input type="number" class="form-control" id="Amount" placeholder="จำนวน"></td>
                            <td style="width:35%"><input type="text" class="form-control" id="Remark" placeholder="หมายเหตุ"></td>
                            <td style="width:5%"><button type="button" class="btn btn-danger" id='rm'><i class="glyphicon glyphicon-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td style="width:25%">
                                <select id="selectGroup" class="form-control">
                                    <option disabled selected value="def">เลือกกลุ่มประเภท</option>
                                    <?php
                                    foreach ($group_data as $k => $v) {
                                        print("<option value='" . $v['group_id'] . "'>" . $v['group_id'] . " (" . $v['detail'] . ") </option>");
                                    }
                                    ?>
                                </select>
                            </td>
                            <td style="width:25%">
                                <select id="selectCat" class="form-control">
                                    <option disabled selected value="def">กรุณาระบุกลุ่มประเภทก่อน</option>
                                </select>
                            </td>
                            <td style="width:10%"><input type="number" class="form-control" id="Amount" placeholder="จำนวน"></td>
                            <td style="width:35%"><input type="text" class="form-control" id="Remark" placeholder="หมายเหตุ"></td>
                            <td style="width:5%"><button type="button" class="btn btn-danger" id='rm'><i class="glyphicon glyphicon-trash"></i></button></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>กลุ่มประเภทพัสดุ</th>
                            <th>ชนิดพัสดุ</th>
                            <th>จำนวน</th>
                            <th>หมายเหตุ</th>
                            <th><button type='button' class="btn btn-info" onclick="addRow('example')"><i class="glyphicon glyphicon-plus"></i></button></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="box-footer">
                <button type='button' class='btn btn-info pull-right' value='Process' onclick='processData();'>บันทึก&nbsp;&nbsp;<i class="glyphicon glyphicon-floppy-saved"></i></button>
            </div>
        </div>
    </div>
</div>

<script src="<?php print(site_url('system/template/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js', true)); ?>"></script>
<script src="<?php print(site_url('system/template/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', true)); ?>"></script>
<script>
    initTable();

    function processData() {
        var tbData = new Array();
        var isEmpty=$("#example > tbody > tr").length===0;
        if(isEmpty){
            systemAlert('ต้องกรอกข้อมูลอย่างน้อย 1 ข้อมูล');
            return;
        }
        $('#example > tbody > tr').each(function(i, row) {
            tbData[i] = {
                "year":$('#year').val(),
                "groupNo": $(row).find('#selectGroup').val(),
                "catNo": $(row).find('[id^="selectCat"]').val(),
                "Amount": $(row).find('#Amount').val(),
                "Remark": $(row).find('#Remark').val()
            }
        });
        console.log(tbData);
        $.each(tbData,function(k,v){
            $.each(v,function(sk,sv){
                // console.log("test",sv);
                if(isEmpty===false){
                    if(sv===""||sv===null)isEmpty=true;
                }else return;
            });
        });
        if(isEmpty){
            systemAlert("กรุณากรอกข้อมูลให้ครบถ้วน");
            return;
        }
        $.post('<?php print site_url("ajax/stock/runStock/processData"); ?>', {
            tbData
        },function(data){
            // console.log(data);
            if(data.code===200){
                systemAlert("เพิ่มข้อมูลเรียบร้อยแล้ว ท่านสามารถปริ้นหมายเลขพัสดุได้ทันที");
                $('#example > tbody > tr').each(function(i, row) {
                    $(row).empty();
                })
            }
        },"json")
    }

    function addRow(tableID) {
        var rowContent = '<tr>' +
            '<td style="width:25%">' +
            '<select id="selectGroup" class="form-control">' +
            '<option disabled selected value="def">เลือกกลุ่มประเภท</option>' +
            <?php
            echo '"' . $group_datas . '"+';
            ?> '</select>' +
            '</td>' +
            '<td style="width:25%">' +
            '<select id="selectCat" class="form-control">' +
            '<option disabled selected value="def">กรุณาระบุกลุ่มประเภทก่อน</option>' +
            '</select>' +
            '</td>' +
            '<td style="width:10%"><input type="number" class="form-control" id="Amount" placeholder="จำนวน"></td>' +
            '<td style="width:35%"><input type="text" class="form-control" id="Remark" placeholder="หมายเหตุ"></td>' +
            '<td style="width:5%"><button type="button" class="btn btn-danger" id="rm"><i class="glyphicon glyphicon-trash"></i></button></td>' +
            '</tr>';
        // console.log(rowContent);
        $('#example tbody').append(rowContent);
        initTable();
    }

    function showCat(index, val) {
        $.post('<?php print site_url("ajax/stock/addNew/getSubCat"); ?>', {
            group_id: val,
            isRunStock: true
        }).done(function(data) {
            $("#selectCat_" + index).html(data);
            console.log(data);
        });
        // console.log(index,data);
    }

    function initTable() {
        $('#example > tbody > tr').each(function(i, row) {
            $(row).find('#selectGroup').attr('onchange', 'showCat(' + (i + 1) + ',this.value);');
            $(row).find('#selectCat').attr('id', 'selectCat_' + (i + 1));
            $(row).find('#rm').attr('onclick', 'rmRow(' + (i + 1) + ');');
            $(row).find('#Amount').attr('autocomplete','off');
            $(row).find('#Remark').attr('autocomplete','off');
            // console.log($(row).find('#rm').attr('class'));
            // console.log($(row).find('#selectGroup').attr('onchange'));
            // console.log($(row).find('[id^="selectCat"]').attr('id'));
            // $(row).remove();
            // console.log($(row).find('input'));
        });
    }

    function rmRow(i) {
        // console.log($('#selectCat_'+i).parent('td').parent('tr').html());
        $('#selectCat_' + i).parent('td').parent('tr').remove();
    }

    function systemAlert(data) {
        $("#systemAlert").html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i> โปรดทราบ!</h4>' +
            data +
            '</div>').hide().slideDown();
        $(function() {
            setTimeout(function() {
                $("#systemAlert").slideUp()
            }, 3000);
        });
    }

    $(function() {
        $('#year').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        }).on('changeDate', function() {
            // alert($("#year").val());
            $('#yearPicker').addClass("collapsed-box");
            $('#contentContainer').removeClass("collapsed-box");
        });

        // $('#btnYearPicker').click(function(){
        //     if($('#contentContainer').hasClass("collapsed-box")){
        //         $('#contentContainer').removeClass("collapsed-box");
        //     }else $('#contentContainer').addClass("collapsed-box");
        // })

        // $('#btnContentContainer').click(function(){
        //     if($('#yearPicker').hasClass('collapsed-box')){
        //         $('#yearPicker').removeClass("collapsed-box");
        //     }else $('#yearPicker').addClass("collapsed-box");
        // })
    })
    // $('#example').DataTable()

    // $('#example2').DataTable({
    //   'paging'      : true,
    //   'lengthChange': false,
    //   'searching'   : false,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : false
    // })
</script>