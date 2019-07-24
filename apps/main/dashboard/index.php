<?php
$normalAmount = selectTb('supplies', 'count(*)', 'statusid="1" OR statusid="3"')[0]['count(*)'];
$almostEmp = selectTb('supplies', 'count(*)', 'statusid="3"')[0]['count(*)'];
$Empty = selectTb('supplies', 'count(*)', 'statusid="2"')[0]['count(*)'];
?>
<div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php print $normalAmount; ?></h3>
                <p>เบิกได้</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer" href="<?php print site_url('main/home/withdraw/index');?>">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php print $almostEmp; ?></h3>
                <p>ใกล้หมด</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a class="small-box-footer" href="#" id="btnBoxAlmostEmp">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?php print $Empty; ?></h3>
                <p>หมด</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a class="small-box-footer" href="#" id="btnBoxEmpty">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<?php
$almostEmpData = selectTb('supplies', 'sid,name,cname,min,remain_amount', 'statusid="3"');
$emptyData = selectTb('supplies', 'sid,name,cname,min,remain_amount', 'statusid="2"');
?>
<div class="row">
    <section class="col-lg-6 connectedSortable ui-sortable">
        <div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-envelope"></i>
                <h3 class="box-title">ใกล้หมดสต็อค</h3>
                <div class="pull-right box-tools">
                    <button id="btnAlmostEmp" class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" type="button" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body no-padding">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width: 10%; text-align:center;">#</th>
                            <th style="text-align:center;">รายการ</th>
                            <th style="width: 15%; text-align:center;">คงเหลือ</th>
                            <th style="width: 15%; text-align:center;">ต่ำสุด</th>
                        </tr>
                        <?php
                        $i = 0;
                        if (!count($almostEmpData)) print("<tr><td colspan='4' style='text-align:center;'>ไม่พบข้อมูล</td></tr>");
                        else {
                            foreach ($almostEmpData as $k) {
                                print("<tr>" .
                                        "<td style='text-align:center;'>" . ++$i . "</td>" .
                                        "<td style='word-wrap: break-word;'>
                                        <b>รหัส : </b>" . $k['sid'] . "<br>
                                        <b>ชื่อ : </b>" . $k['name'] . "<br>
                                        <b>ชื่อเรียก : </b>" . $k['cname'] . "<br>
                                    </td>" .
                                        "<td style='text-align:center; word-wrap: break-word;'>" . $k['remain_amount'] . "</td>" .
                                        "<td style='text-align:center;'>" . $k['min'] . "</td>" .
                                        "</tr>");
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <section class="col-lg-6 connectedSortable ui-sortable">
        <div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-envelope"></i>
                <h3 class="box-title">หมดสต็อค</h3>
                <div class="pull-right box-tools">
                    <button id="btnEmp" class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" type="button" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body no-padding">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width: 10%; text-align:center;">#</th>
                            <th style="text-align:center;">รายการ</th>
                            <th style="width: 15%; text-align:center;">คงเหลือ</th>
                            <th style="width: 15%; text-align:center;">ต่ำสุด</th>
                        </tr>
                        <?php
                        $i = 0;
                        if (!count($emptyData)) print("<tr><td colspan='4' style='text-align:center;'>ไม่พบข้อมูล</td></tr>");
                        else {
                            foreach ($emptyData as $k) {
                                print("<tr>" .
                                        "<td style='text-align:center;'>" . ++$i . "</td>" .
                                        "<td style='word-wrap: break-word;'>
                                            <b>รหัส : </b>" . $k['sid'] . "<br>
                                            <b>ชื่อ : </b>" . $k['name'] . "<br>
                                            <b>ชื่อเรียก : </b>" . $k['cname'] . "<br>
                                    </td>" .
                                        "<td style='text-align:center; word-wrap: break-word;'>" . $k['remain_amount'] . "</td>" .
                                        "<td style='text-align:center;'>" . $k['min'] . "</td>" .
                                        "</tr>");
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<script>
    $('#btnBoxAlmostEmp').click(function(e){
        e.preventDefault();
        $('#btnAlmostEmp').click();
    });
    $('#btnBoxEmpty').click(function(e){
        e.preventDefault();
        $('#btnEmp').click();
    });
</script>