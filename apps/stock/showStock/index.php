<?php
    $title = "showStock";
    function genSCNumber($year, $subCat, $number){
        $prefixData = selectTb('sub_cat', 'group_id,cat_id,type,name', 'id="' . $subCat . '"');
        // print_r($prefixData);
        $prefixData = $prefixData[0];
        $year += 543;
        $year %= 100;
        $ret = $year . " สภ. " . $prefixData['group_id'] . "-" . $prefixData['cat_id'] . "-" . $prefixData['type'];
        $ret .= $number;
        $ret .= " (" . $prefixData['name'] . ")";
        return $ret;
    }

    function findStatus($No){
        $data=selectTb('status_data','detail','id="'.$No.'"');
        $data=$data[0];
        return $data['detail'];
    }

    if(isset($_POST['year'])){
        $year=$_POST['year'];
        $data=selectTb('stock_data','sub_cat_id,stk_number,stk_detail,status','stk_year="'.$year.'"');
        $ret='';
        foreach($data as $k){
            $ret.=  "<tr>".
                        "<td>".genSCNumber($year,$k['sub_cat_id'],$k['stk_number'])."</td>".
                        "<td>".$k['stk_detail']."</td>".
                        "<td>".findStatus($k['status'])."</td>".
                    "</tr>";
        }
    }
?>
<link rel="stylesheet" href="<?php print(site_url('system/template/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css', true)); ?>">

<div class="row">
    <div class="col-md-12">
        <div id="yearPicker" class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">ปีการศึกษาที่ต้องการตรวจสอบพัสดุ</h3>
                <div class="box-tools pull-right">
                    <button id="btnYearPicker" type="button" class="btn btn-box-tool" data-widget="collapse"><i id="plusMinus" class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form autocomplete="off" id="yrPicker" action="<?php print site_url('main/stock/showStock/index');?>" method="post">
                <div class="input-group date col-md-3">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input name="year" type="text" class="form-control pull-right" id="year" value="<?php if(isset($_POST['year']))echo $_POST['year'];?>">
                </div>
                <!-- <button type='submit'>Go</button> -->
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ตารางแสดงรายละเอียดพัสดุ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tbData" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>หมายเลขพัสดุ</th>
                            <th>ชื่อ</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php print $ret;?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>หมายเลขพัสดุ</th>
                            <th>ชื่อ</th>
                            <th>สถานะ</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?php print(site_url('system/template/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js', true)); ?>"></script>
<script src="<?php print(site_url('system/template/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', true)); ?>"></script>
<script>
    $('#tbData').DataTable()

    // $('#example2').DataTable({
    //   'paging'      : true,
    //   'lengthChange': false,
    //   'searching'   : false,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : false
    // })
    $(function() {
        $('#year').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        }).on('changeDate', function() {
            // $('#yearPicker').addClass("collapsed-box");
            $('#yrPicker').submit();
            // alert($("#year").val());
            // $('#contentContainer').removeClass("collapsed-box");
            // $.post('<?php print site_url("ajax/stock/showStock/genRecord"); ?>', {
            //     year: $('#year').val(),
            // }).done(function(data){
            //     $('#tbData > tbody').html(data);
            //     console.log(data);
            // })
        });
        if($('#year').val()!=""){
            $('#yearPicker').addClass("collapsed-box");
            $('#plusMinus').attr('class','fa fa-plus')
        }
    })
</script>