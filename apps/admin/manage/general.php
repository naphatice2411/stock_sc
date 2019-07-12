<?php

$title = "ตั้งค่าทั่วไป";

$siteName_data = getConfig('siteName', 'detail');

$subName_data = getConfig('subName', 'detail');

//$subtitle=current_user('name')." ".current_user('surname');

?>

<!-- Main content -->

<div class="callout callout-info" id="saveAlert">

    <h4><i class="icon fa fa-info"></i> บันทึก!</h4>

    บันทึกข้อมูลเรียบร้อยแล้ว.

</div>



<script>

    //$(document).ready(function (e) {

    $('#saveAlert').hide();

    // });

</script>



<div class="row">



    <div class="col-md-12">

        <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">

                <li class="active"><a href="#display" data-toggle="tab">การแสดงผล</a></li>

                <li><a href="#system" data-toggle="tab">ระบบ</a></li>

                <li><a href="#applications" data-toggle="tab">แอปปลิเคชั่น</a></li>

                <li><a href="#openAuthen" data-toggle="tab">การตรวจสอบตัวตนแบบเปิด</a></li>

                <li><a href="#security" data-toggle="tab">ความปลอดภัย</a></li>



            </ul>

            <div class="tab-content">

                <div class="active tab-pane" id="display">

                    <form id="updateDisplay" action="<?php print site_url("ajax/admin/manage/submit"); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group">

                            <label for="inputNameSite" class="col-sm-2 control-label">ชื่อระบบ</label>



                            <div class="col-sm-4">

                                <input type="text" class="form-control" id="inputNameSite" name="inputNameSite" placeholder="ชื่อระบบ" value="<?php print_r($siteName_data[0]); ?>">

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="inputSubNameSite" class="col-sm-2 control-label">ชื่อย่อระบบ</label>



                            <div class="col-sm-4">

                                <input type="text" class="form-control" id="inputSubNameSite" name="inputSubNameSite" placeholder="ชื่อย่อระบบ" value="<?php print_r($subName_data[0]); ?>">

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-sm-offset-2 col-sm-4">

                                <button type="submit" class="btn btn-primary">บันทึก</button>

                            </div>

                        </div>

                    </form>

                </div>



                <script>

                    var saveAlert;

                    $("#updateDisplay").submit(function (event) {



                        event.preventDefault();

                        saveAlert = setInterval(hideSaveAlert, 3000);



                        var formData = {

                            'inputNameSite': $('input[name=inputNameSite]').val(),

                            'inputSubNameSite': $('input[name=inputSubNameSite]').val(),

                            'save': "display",

                        };

                        $.ajax({

                            type: 'POST',

                            url: '<?php print site_url("ajax/admin/manage/submit"); ?>',

                            data: formData,

                            dataType: 'text',

                            encode: true

                        }).done(function (data) {

                            $('#saveAlert').slideDown('slow');

                            console.log(data);



                        });

                    });

                    function hideSaveAlert() {

                        $('#saveAlert').slideUp('slow');

                        clearInterval(saveAlert);

                    }

                </script>



                <!-- /.tab-pane -->

                <div class="tab-pane" id="system">



                </div>

                <!-- /.tab-pane -->

                <div class="tab-pane" id="applications">

                    <form class="form-horizontal">

                        <div class="box-body">

                            <button type="button" id="installNewApplication"

                                    class="btn btn-default">ติดตั้งแอปปลิเคชั่นใหม่ <i id="installAppBtn" class="fa fa-refresh"></i></button>

                            <script>

                                $("#installNewApplication").click(function () {

                                    $("#installAppBtn").addClass("fa-spin");

                                    $("#appsListArea").text("");

                                    $("#appsListArea").slideUp('slow');

                                    $.get("<?php print site_url('ajax/admin/manage/installNewApps'); ?>", function (data) {

                                        // alert(data);

                                        if (data == 1) {
                                            $("#installAppBtn").removeClass("fa-spin");

                                            loadAppList();

                                        }

                                    });

                                });

                            </script>

                            <p>

                            <div id="appsListArea"></div>

                            </p>

                        </div>

                    </form>

                </div>

                <!-- /.tab-pane -->



                <div class="tab-pane" id="openAuthen">

                    <form id="updateOAuthen" action="<?php print site_url("ajax/admin/manage/submit"); ?>" method="post" class="form-horizontal">

                        <div class="form-group">

                            <label for="activeGoogleAuthen" class="col-sm-2 control-label">เปิดใช้งาน Google Open ID</label>

                            <?php

                            $googleOpenIDActive = get_system_config('activeGoogleOpenID');

                            ?>

                            <div class="col-sm-4"><input type="checkbox" name="activeGoogleOpenID" value="activate"<?php if ($googleOpenIDActive == 'activated') print " checked"; ?>></div>

                        </div>

                        <div class="form-group">

                            <label for="inputGoogleAppID" class="col-sm-2 control-label">Google App ID</label>



                            <div class="col-sm-4">

                                <input type="text" class="form-control" id="inputGoogleAppID" name="inputGoogleAppID" placeholder="GoogleAppID" value="<?php print get_system_config('googleAppID');

                            ?>">

                            </div>

                            <a class="btn btn-default" href="https://console.developers.google.com" target="_blank" title="ฉันจะหาสิ่งนี้จากที่ไหน?">

                                <i class="fa fa-question-circle"></i>

                            </a>

                        </div>



                        <div class="form-group">

                            <label for="inputGoogleAppSecret" class="col-sm-2 control-label">Google App Secret</label>



                            <div class="col-sm-4">

                                <input type="text" class="form-control" id="inputGoogleAppSecret" name="inputGoogleAppSecret" placeholder="GoogleAppSecret" value="<?php print get_system_config('googleAppSecret');

                            ?>">

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-sm-offset-2 col-sm-4">

                                <button type="submit" class="btn btn-primary">บันทึก</button>

                            </div>

                        </div>

                    </form>

                </div>

                <script>

                    $(function () {

                        $('input').iCheck({

                            checkboxClass: 'icheckbox_square-blue',

                            radioClass: 'iradio_square-blue',

                            increaseArea: '20%' // optional

                        });

                    });

                </script>

                <!-- /.tab-pane -->



                <script>

                    $("#updateOAuthen").submit(function (event) {



                        event.preventDefault();

                        saveAlert = setInterval(hideSaveAlert, 3000);

                        var activeGoogleID;

                        if ($('input[name=activeGoogleOpenID]').prop("checked")) {

                            activeGoogleID = "activated";

                        } else {

                            activeGoogleID = "deactivated";

                        }



                        var formData = {

                            'activeGoogleOpenID': activeGoogleID,

                            'inputGoogleAppID': $('input[name=inputGoogleAppID]').val(),

                            'inputGoogleAppSecret': $('input[name=inputGoogleAppSecret]').val(),

                            'save': "oAuthen",

                        };

                        $.ajax({

                            type: 'POST',

                            url: '<?php print site_url("ajax/admin/manage/submit"); ?>',

                            data: formData,

                            dataType: 'text',

                            encode: true

                        }).done(function (data) {

                            $('#saveAlert').slideDown('slow');

                            console.log(data);

                        });

                    });

                </script>



                <div class="tab-pane" id="security">



                </div>

                <!-- /.tab-pane -->

            </div>

            <!-- /.tab-content -->

        </div>

        <!-- /.nav-tabs-custom -->

    </div>

    <!-- /.col -->

</div>

<!-- /.row -->

<script src="<?php print site_url("system/template/AdminLTE/plugins/iCheck/icheck.min.js", true); ?>"></script>

<script>



                  //Flat red color scheme for iCheck





                  function loadAppList() {



                      //$("#appsListArea").addClass("fa fa-refresh fa-spin");

                      $.get("<?php print site_url('ajax/admin/manage/appList'); ?>", function (data) {

                          //alert(data);



                          $("#appsListArea").html(data);

                          $("#appsListArea").slideDown('slow');

                          if (data)

                              iCheckActive();

                      });





                  }



                  function iCheckActive() {

                      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({

                          checkboxClass: 'icheckbox_flat-blue',

                          radioClass: 'iradio_flat-blue'

                      });

                  }

                  $(document).ready(function () {

                      loadAppList();

                  });

</script>



