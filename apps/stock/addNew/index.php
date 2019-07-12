<?php
$title = "เพิ่มพัสดุ";
$subtitle = "Add new parcel";

$group_data = selectTb('cat_group', 'group_id,detail');



?>

<link rel="stylesheet" href="<?php print(site_url('system/template/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', true)); ?>">
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>

<div class="box box-info col-xs-12">
    <div class="box-header with-border">
        <h3 class="box-title">กรอกรายละเอียดพัสดุ</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-3">
                <div class="row">
                    <select id="selectGroup" class="form-control" onchange="otherGroup(this.value);">
                        <option disabled selected value="def">เลือกกลุ่มประเภท</option>
                        <?php
                        foreach ($group_data as $k => $v) {
                            print("<option value='" . $v['group_id'] . "'>" . $v['group_id'] . " (" . $v['detail'] . ") </option>");
                        }
                        ?>
                        <option value="others">อื่น ๆ</option>
                    </select>
                    <div id="otherGroup" style="display:none;">
                        <input id="groupCode" type="number" class="col-xs-3 quantity" placeholder="รหัส" min="0" max="9999" maxlength="4">
                        <input id="groupDetail" class="col-xs-9" type="text" placeholder="ชื่อกลุ่มประเภท" />
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="row">
                    <select class="form-control" id="selectCat" onchange="otherCat(this.value);">
                        <option disabled selected value="def">กรุณาระบุกลุ่มประเภทก่อน</option>
                    </select>
                    <div id="otherCat" style="display:none;">
                        <input id="catCode" type="number" class="col-xs-3 quantity" placeholder="รหัสชนิด" min="0" max="999" maxlength="3">
                        <input id="catDetail" class="col-xs-9" type="text" placeholder="ชื่อชนิดพัสดุ" />
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="row">
                    <select id="selectDetail" class="form-control" onchange=''>
                        <option disabled selected value="def">รายละเอียด</option>
                        <option value="11">ใช้แล้วไม่หมดไป</option>
                        <option value="22">ใช้แล้วหมดไป</option>
                        <!-- <option value="others">อื่น ๆ</option> -->
                    </select>
                    <!-- <div id="otherDetails" class="" style="display:none;">
                            <input id="detailCode" class="col-xs-3 quantity" type="number" placeholder="รหัส" min="0" max="99" maxlength="2" />
                            <input id="detailDetail" class="col-xs-9" type="text" placeholder="รายละเอียด" />
                        </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <button id="addData" class="btn btn-info pull-right">เพิ่มข้อมูล</button>
    </div>
</div>


<script>
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

    function otherDetails(val) {
        var element = document.getElementById('otherDetails');
        if (val == 'others')
            element.style.display = 'block';
        else
            element.style.display = 'none';
    }

    function otherCat(val) {
        var element = document.getElementById('otherCat');
        if (val == 'others')
            element.style.display = 'block';
        else
            element.style.display = 'none';

        $.post('<?php print site_url("ajax/stock/addNew/getType"); ?>', {
            group_id: $('#selectGroup').val(),
            cat_id: val
        }).done(function(data) {
            $("#selectDetail").val(parseInt(data));
            console.log(data);
        });
    }

    function otherGroup(val) {
        var element = document.getElementById('otherGroup');
        if (val == 'others')
            element.style.display = 'block';
        else
            element.style.display = 'none';

        $.post('<?php print site_url("ajax/stock/addNew/getSubCat"); ?>', {
            group_id: val
        }).done(function(data) {
            $("#otherCat").hide();
            $("#selectCat").html(data);
            console.log(data);
        });
    }

    $(function() {
        $("#addData").click(function() {
            var selectGroup = $('#selectGroup'),
                groupCode = $('#groupCode'),
                groupDetail = $('#groupDetail');
            var selectCat = $('#selectCat'),
                catCode = $('#catCode'),
                catDetail = $('#catDetail');
            var selectDetail = $('#selectDetail');
            if (selectGroup.val() === 'others') {
                if (groupCode.val() === '' || groupDetail.val() === '') {
                    systemAlert("กรุณาระบรหัสกลุ่มและ/หรือรายละเอียดกลุ่มด้วย");
                    return;
                }
                if (selectCat.val() === null || selectCat.val() === 'def') {
                    systemAlert("กรุณาระบุชนิดพัสดุด้วย");
                    return;
                } else {
                    if (catCode.val() === '' || catDetail.val() === '') {
                        systemAlert("กรุณาระบุรหัสชนิดและ/หรือรายละเอียดชนิดด้วย");
                        return;
                    } else {
                        if (selectDetail.val() === null || selectDetail.val() === 'def') {
                            systemAlert("กรุณาระบุรายละเอียดพัสดุด้วย");
                            return
                        }
                        $.post('<?php print site_url("ajax/stock/addNew/addGroupCat"); ?>', {
                            is_add_group: true,
                            group_id: groupCode.val(),
                            group_detail: groupDetail.val(),
                            cat_id: catCode.val(),
                            cat_name: catDetail.val(),
                            cat_type: selectDetail.val()
                        }).done(function(data) {
                            if (data.catInsert !== 0 && data.groupInsert !== 0) {
                                systemAlert("เพิ่มข้อมูลเรียบร้อย ท่านสามารถรันหมายเลขพัสดุได้ทันที");
                                selectGroup.val('def');
                                groupCode.val('');
                                groupDetail.val('');
                                selectCat.val('def');
                                catCode.val('');
                                catDetail.val('');
                                selectDetail.val('def');
                                $('#otherGroup').hide();
                                $('#otherCat').hide();
                                $.post('<?php print site_url('ajax/stock/addNew/regroup'); ?>', function(data) {
                                    selectGroup.html(data);
                                });
                            }
                            console.log(data);
                        });
                    }
                }
            } else if (selectGroup.val() === null || selectGroup.val() === 'def') {
                systemAlert("กรุณากรอกข้อมูลก่อน");
            } else {
                if (selectCat.val() === null || selectCat.val() === 'def') {
                    systemAlert("กรุณาระบุชนิดพัสดุด้วย");
                    return;
                } else if (selectCat.val() === 'others') {
                    if (catCode.val() === '' || catDetail.val() === '') {
                        systemAlert("กรุณาระบุรหัสชนิดและ/หรือรายละเอียดชนิดด้วย");
                        return;
                    } else {
                        if (selectDetail.val() === null || selectDetail.val() === 'def') {
                            systemAlert("กรุณาระบุรายละเอียดพัสดุด้วย");
                            return
                        }
                        $.post('<?php print site_url("ajax/stock/addNew/addGroupCat"); ?>', {
                            is_add_cat: true,
                            group_id: selectGroup.val(),
                            cat_id: catCode.val(),
                            cat_name: catDetail.val(),
                            cat_type: selectDetail.val()
                        }).done(function(data) {
                            if (data.catInsert !== 0 && data.groupInsert !== 0) {
                                systemAlert("เพิ่มข้อมูลเรียบร้อย ท่านสามารถรันหมายเลขพัสดุได้ทันที");
                                selectGroup.val('def');
                                groupCode.val('');
                                groupDetail.val('');
                                selectCat.val('def');
                                catCode.val('');
                                catDetail.val('');
                                selectDetail.val('def');
                                $('#otherGroup').hide();
                                $('#otherCat').hide();
                                $.post('<?php print site_url('ajax/stock/addNew/regroup'); ?>', function(data) {
                                    selectGroup.html(data);
                                });
                            } else {
                                systemAlert(data.error);
                            }
                            console.log(data);
                        });
                    }
                } else {
                    systemAlert("There's nothing to change/You don't have permission to change")
                }
            }
        });

        $('#year').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        }).on('changeDate', function() {
            alert($("#year").val());
        });

        var inputQuantity = [];
        $(".quantity").each(function(i) {
            inputQuantity[i] = this.defaultValue;
            $(this).data("idx", i); // save this field's index to access later
        }).on("keyup", function(e) {
            var $field = $(this),
                val = this.value,
                $thisIndex = parseInt($field.data("idx"), 10); // retrieve the index
            //        window.console && console.log($field.is(":invalid"));
            //  $field.is(":invalid") is for Safari, it must be the last to not error in IE8
            if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid")) {
                this.value = inputQuantity[$thisIndex];
                return;
            }
            if (val.length > Number($field.attr("maxlength"))) {
                val = val.slice(0, Number($field.attr("maxlength")));
                $field.val(val);
            }
            inputQuantity[$thisIndex] = val;
        });

    })
</script>