<?php
    $title='แก้ไขข้อมูลผู้ใช้งาน';
    if(is_numeric($hGET['id'])){
        $userData=selectTb('userdata','*','user_id="'.$hGET['id'].'"');
        $userData=$userData[0];
//        print_r($userData);
    }else{
        exit();
    }
    $picPath='system/pictures/profile/'.$userData['username'].'.png';
    if(!file_exists(BASE_PATH.$picPath))$picPath='system/pictures/profile/noimage.png';
    
?>

<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?php print site_url($picPath, true); ?>" alt="User profile picture">

                <h3 class="profile-username text-center"><?php print $userData['name'] . " " . $userData['surname']; ?></h3>
                <?php
                $accession = json_decode($userData['accession']);
                ?>
                <p class="text-muted text-center"><?php
                    print "<b>" . ucfirst($userData['user_type']) . "</b>";
                    ?></p>
                <p class="text-muted text-center">ข้อมูลพื้นฐาน</p>
                <form class="form-horizontal">
                    <input type="hidden" name="userid" id="userid" value="<?php print $hGET['id'];?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label">ชื่อผู้ใช้</label>
                            <div class="col-sm-9">
                                <input disabled type="text" class="form-control" id="username" placeholder="username" value="<?php
                                print $userData['username'];
                                ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="col-sm-3 control-label">หมายเลขโทรศัพท์</label>
                            <div class="col-sm-9">
                                <input disabled type="text" class="form-control" id="mobile" placeholder="0xxxxxxxxxx" value="<?php
                                print $userData['mobile'];
                                ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">สถานะ</label> 
                            <div class="col-sm-9" id="showStatus">
                                <?php
                                if ($userData['active'] == ''||$userData['active']=='N') {
                                    print " <a class=\"btn btn-default col-sm-9\" id=\"changeStatus\">"
                                            . "<i class=\"fa fa-hand-stop-o\" id=\"iconStatus\"></i> ยังไม่เปิดใช้"
                                            . "</a>";
                                } else if ($userData['active'] == 'Y') {
                                    print " <a class=\"btn btn-success col-sm-9\" id=\"changeStatus\">"
                                            . "<i class=\"fa fa-thumbs-o-up\" id=\"iconStatus\"></i> เปิดใช้งาน"
                                            . "</a>";
                                } else if ($userData['active'] == 'B') {
                                    print " <a class=\"btn btn-danger col-sm-9\" id=\"changeStatus\">"
                                            . "<i class=\"fa fa fa-hand-stop-o\" id=\"iconStatus\"></i> ปิดกั้น"
                                            . "</a>";
                                }
                                ?>
                            </div>                         
                        </div>
                        <div class="form-group">
                            <label for="isAdmin" class="col-sm-3 control-label">ผู้ดูแลระบบ</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="usertype" id="isadmin" class="flat-red"<?php
                                if ($userData['user_type'] == 'administrator')
                                    print " checked";
                                ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <!-- <a href="#"></a> -->
                                <input id="editUser" type="button" class="btn btn-info" value="แก้ไขข้อมูล">
                                <a href="<?php print site_url('main/admin/userManage/listUser/type/user');?>">
                                    <input type="button" class="btn btn-danger" value="ยกเลิก">
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- <a href="#" class="btn btn-primary btn-block"><b>แก้ไขข้อมูล</b></a> -->
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
        
</div>
<script src="<?php print site_url("system/template/AdminLTE/plugins/iCheck/icheck.min.js", true); ?>"></script>
<script>

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

</script>
<script>
    $("#updateAccession").submit(function (event) {
        event.preventDefault();
        var $form = $(this),
<?php
print $biddingVar;
?>accArr = [
<?php
print $bidtoArr;
if ($bidtoArr && $systemAppArr)
    print ",";
print $systemAppArr;
?>
                ],
                url = $form.attr("action");
        //alert(accArr);

        var posting = $.post(url, {accession: accArr});
        posting.done(function (data) {
            //$( "#result" ).empty().append( data );
            showUpdate(data,false);
        });
    });

    function showUpdate(txt,updateUserType) {
        $("#systemAlert").html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i><b>'
                + txt +
                '</b></div>').hide().slideDown();
        // this.slideDown();
        $(function(){
            setTimeout(function(){
                $("#systemAlert").slideUp();
            },1000);
            if(updateUserType){
                setTimeout(function(){
                    window.location.reload();
                },2000);
            }
        });
    }

    $('#changeStatus').click(function () {
        $('#changeStatus').html("<i id='iconStatus'></i>...");
        $('#iconStatus').removeClass().addClass('fa fa-refresh fa-spin');
        //$('#changeStatus').load("<?php print site_url('ajax/admin/userManage/changeStatus/id/' . pq($hGET['id'])); ?>");

        $.getJSON('<?php print site_url('ajax/admin/userManage/changeStatus/id/' . pq($hGET['id'])); ?>', function (data) {
            $.each(data, function (i, field) {
                if (i == 0) {
                    $('#changeStatus').html(field);
                    //alert(field);
                } else if (i == 1) {
                    //alert(field);
                    $('#changeStatus').removeClass().addClass(field);
                }
            });
        });
    });

    $('#editUser').click(function(){
        $.post('<?php print site_url('ajax/admin/userManage/editUser')?>',{
            user_id: $('#userid').val(),
            is_admin: $('#isadmin').prop("checked")
        },function(res){
            console.log(res);
            showUpdate(res.status,true);
            // $("#systemAlert").html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i><b>'
            //     + res.status +
            //     '</b></div>').hide().slideDown('slow').delay(1000).slideUp();
            //     window.location.reload();
        },"json");
    });
</script>