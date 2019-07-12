  <?php

  $title="ข้อมูลผู้ใช้";

  $subtitle=(current_user('name')." ".current_user('surname'));

  ?>

    <link rel="stylesheet" href="<?php print site_url("system/template/AdminLTE/plugins/iCheck/all.css",true); ?>">

    <!-- Main content -->

    <section class="content">



      <div class="row">

        <div class="col-md-4">



          <!-- Profile Image -->

          <div class="box box-primary">

            <div class="box-body box-profile">

              <img class="profile-user-img img-responsive img-circle" src="<?php print current_user('picture'); ?>" alt="User profile picture">



              <h3 class="profile-username text-center"><?php print current_user('name')." ".current_user('surname');?></h3>



              <p class="text-muted text-center"><?php print ucfirst(current_user('user_type')); ?></p>



              <!-- <ul class="list-group list-group-unbordered">

                <li class="list-group-item">

                  <b>ลงทะเบียนเมื่อ</b> <a class="pull-right"><?php print current_user('signup'); ?></a>

                </li>

                <li class="list-group-item">

                  <b>เข้าใช้งานเมื่อ</b> <a class="pull-right"><?php print current_user('last_login'); ?></a>

                </li>

               <li class="list-group-item">

                  <b>สถานศึกษา</b> <a class="pull-right"><?php

//                    $academy_data=selectTb('academy_data','name','academy_id='.current_user('academy_id'));

//                    print $academy_data[0]['name'];

                    ?></a>

                </li>

              </ul> -->

<!--

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->

            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->



          <!-- About Me Box -->

          <!--

          <div class="box box-primary">

            <div class="box-header with-border">

              <h3 class="box-title">เกียวกับ</h3>

            </div>-->

            <!-- /.box-header -->

            <!--<div class="box-body">-->

            <!--

              <strong><i class="fa fa-book margin-r-5"></i> การศึกษา</strong>



              <p class="text-muted">

                B.S. in Computer Science from the University of Tennessee at Knoxville

              </p>



              <hr>



              <strong><i class="fa fa-map-marker margin-r-5"></i> ที่อยู่</strong>



              <p class="text-muted">Malibu, California</p>



              <hr>



              <strong><i class="fa fa-pencil margin-r-5"></i> ความสามารถ</strong>



              <p>-->

              <?php /*

                $accession=current_user('accession');

                $accession=json_decode($accession);

                //print_r($accession);

                foreach ($accession as $row) {

                  print ("<span class=\"label label-danger margin-r-5\">".$row."</span>\n");

                } */

              ?>

              <!-- </p> -->

<!--

              <hr>



              <strong><i class="fa fa-file-text-o margin-r-5"></i> หมายเหตุ</strong>



              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>-->

            <!-- </div> -->

            <!-- /.box-body -->

          <!-- </div> -->

          <!-- /.box -->

        </div>

        <!-- /.col -->

        <div class="col-md-8">

          <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">

              <!-- <li class="active"><a href="#activity" data-toggle="tab">กิจกรรม</a></li>

              <li><a href="#timeline" data-toggle="tab">ช่วงเวลา</a></li> -->

              <li class="active"><a href="#updateData" data-toggle="tab">แก้ไขข้อมูล</a></li>



              <li><a href="#userPicture" data-toggle="tab">รูปประจำตัว</a></li>

            </ul>

            <div class="tab-content">

            <?php /*

              <div class="active tab-pane" id="activity">

                <!-- Post -->

                <div class="post">

                  <div class="user-block">

                    <img class="img-circle img-bordered-sm" src="<?php print site_url("system/template/AdminLTE/dist/img/user1-128x128.jpg",true)?>" alt="user image">

                        <span class="username">

                          <a href="#">Jonathan Burke Jr.</a>

                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>

                        </span>

                    <span class="description">Shared publicly - 7:30 PM today</span>

                  </div>

                  <!-- /.user-block -->

                  <p>

                    Lorem ipsum represents a long-held tradition for designers,

                    typographers and the like. Some people hate it and argue for

                    its demise, but others ignore the hate as they create awesome

                    tools to help create filler text for everyone from bacon lovers

                    to Charlie Sheen fans.

                  </p>

                  <ul class="list-inline">

                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>

                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>

                    </li>

                    <li class="pull-right">

                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments

                        (5)</a></li>

                  </ul>



                  <input class="form-control input-sm" type="text" placeholder="Type a comment">

                </div>

                <!-- /.post -->



                <!-- Post -->

                <div class="post clearfix">

                  <div class="user-block">

                    <img class="img-circle img-bordered-sm" src="<?php print site_url("system/template/AdminLTE/dist/img/user7-128x128.jpg",true)?>" alt="User Image">

                        <span class="username">

                          <a href="#">Sarah Ross</a>

                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>

                        </span>

                    <span class="description">Sent you a message - 3 days ago</span>

                  </div>

                  <!-- /.user-block -->

                  <p>

                    Lorem ipsum represents a long-held tradition for designers,

                    typographers and the like. Some people hate it and argue for

                    its demise, but others ignore the hate as they create awesome

                    tools to help create filler text for everyone from bacon lovers

                    to Charlie Sheen fans.

                  </p>



                  <form class="form-horizontal">

                    <div class="form-group margin-bottom-none">

                      <div class="col-sm-9">

                        <input class="form-control input-sm" placeholder="Response">

                      </div>

                      <div class="col-sm-3">

                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>

                      </div>

                    </div>

                  </form>

                </div>

                <!-- /.post -->



                <!-- Post -->

                <div class="post">

                  <div class="user-block">

                    <img class="img-circle img-bordered-sm" src="<?php print site_url("system/template/AdminLTE/dist/img/user6-128x128.jpg",true)?>" alt="User Image">

                        <span class="username">

                          <a href="#">Adam Jones</a>

                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>

                        </span>

                    <span class="description">Posted 5 photos - 5 days ago</span>

                  </div>

                  <!-- /.user-block -->

                  <div class="row margin-bottom">

                    <div class="col-sm-6">

                      <img class="img-responsive" src="<?php print site_url("system/template/AdminLTE/dist/img/photo1.png",true)?>" alt="Photo">

                    </div>

                    <!-- /.col -->

                    <div class="col-sm-6">

                      <div class="row">

                        <div class="col-sm-6">

                          <img class="img-responsive" src="<?php print site_url("system/template/AdminLTE/dist/img/photo2.png",true)?>" alt="Photo">

                          <br>

                          <img class="img-responsive" src="<?php print site_url("system/template/AdminLTE/dist/img/photo3.jpg",true)?>" alt="Photo">

                        </div>

                        <!-- /.col -->

                        <div class="col-sm-6">

                          <img class="img-responsive" src="<?php print site_url("system/template/AdminLTE/dist/img/photo4.jpg",true)?>" alt="Photo">

                          <br>

                          <img class="img-responsive" src="<?php print site_url("system/template/AdminLTE/dist/img/photo1.png",true)?>" alt="Photo">

                        </div>

                        <!-- /.col -->

                      </div>

                      <!-- /.row -->

                    </div>

                    <!-- /.col -->

                  </div>

                  <!-- /.row -->



                  <ul class="list-inline">

                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>

                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>

                    </li>

                    <li class="pull-right">

                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments

                        (5)</a></li>

                  </ul>



                  <input class="form-control input-sm" type="text" placeholder="Type a comment">

                </div>

                <!-- /.post -->

              </div>

              <!-- /.tab-pane -->

              <div class="tab-pane" id="timeline">

                <!-- The timeline -->

                <ul class="timeline timeline-inverse">

                  <!-- timeline time label -->

                  <li class="time-label">

                        <span class="bg-red">

                          10 Feb. 2014

                        </span>

                  </li>

                  <!-- /.timeline-label -->

                  <!-- timeline item -->

                  <li>

                    <i class="fa fa-envelope bg-blue"></i>



                    <div class="timeline-item">

                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>



                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>



                      <div class="timeline-body">

                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,

                        weebly ning heekya handango imeem plugg dopplr jibjab, movity

                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle

                        quora plaxo ideeli hulu weebly balihoo...

                      </div>

                      <div class="timeline-footer">

                        <a class="btn btn-primary btn-xs">Read more</a>

                        <a class="btn btn-danger btn-xs">Delete</a>

                      </div>

                    </div>

                  </li>

                  <!-- END timeline item -->

                  <!-- timeline item -->

                  <li>

                    <i class="fa fa-user bg-aqua"></i>



                    <div class="timeline-item">

                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>



                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request

                      </h3>

                    </div>

                  </li>

                  <!-- END timeline item -->

                  <!-- timeline item -->

                  <li>

                    <i class="fa fa-comments bg-yellow"></i>



                    <div class="timeline-item">

                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>



                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>



                      <div class="timeline-body">

                        Take me to your leader!

                        Switzerland is small and neutral!

                        We are more like Germany, ambitious and misunderstood!

                      </div>

                      <div class="timeline-footer">

                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>

                      </div>

                    </div>

                  </li>

                  <!-- END timeline item -->

                  <!-- timeline time label -->

                  <li class="time-label">

                        <span class="bg-green">

                          3 Jan. 2014

                        </span>

                  </li>

                  <!-- /.timeline-label -->

                  <!-- timeline item -->

                  <li>

                    <i class="fa fa-camera bg-purple"></i>



                    <div class="timeline-item">

                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>



                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>



                      <div class="timeline-body">

                        <img src="http://placehold.it/150x100" alt="..." class="margin">

                        <img src="http://placehold.it/150x100" alt="..." class="margin">

                        <img src="http://placehold.it/150x100" alt="..." class="margin">

                        <img src="http://placehold.it/150x100" alt="..." class="margin">

                      </div>

                    </div>

                  </li>

                  <!-- END timeline item -->

                  <li>

                    <i class="fa fa-clock-o bg-gray"></i>

                  </li>

                </ul>

              </div>

              <!-- /.tab-pane -->

*/ ?>

              <div class="active tab-pane" id="updateData">

                <!--<form class="form-horizontal">-->

                <form id="updateDataForm" action="<?php print site_url("ajax/home/profile/updateData"); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                  
                <div class="form-group">
                    <label for="inputDept" class="col-sm-3 control-label">คำนำหน้า</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="optTitle" name="title">
                        <option disabled <?php if(current_user('title')=='0')print 'selected';?>>select one</option>
                        <option value="1" <?php if(current_user('title')=='1')print 'selected';?>>นาย</option>
                        <option value="2" <?php if(current_user('title')=='2')print 'selected';?>>นาง</option>
                        <option value="3" <?php if(current_user('title')=='3')print 'selected';?>>นางสาว</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">ชื่อ</label>
                    <div class="col-sm-9">
                      <input type="text" autocomplete='off' class="form-control" id="inputName" name="name" placeholder="ชือ่" value="<?php print current_user('name');?>">
                    </div>
                  </div>

                  <div class="form-group">

                    <label for="inputName" class="col-sm-3 control-label">สกุล</label>



                    <div class="col-sm-9">

                      <input type="text" autocomplete='off' class="form-control" id="inputSurename" name="surname" placeholder="สกุล" value="<?php print current_user('surname');?>">

                    </div>

                  </div>

                  <div class="form-group">
                    <label for="inputMobile" class="col-sm-3 control-label">หมายเลขโทรศัพท์</label>
                    <div class="col-sm-9">
                      <input type="mobile" autocomplete='off'class="form-control" id="inputMobile" name="mobile" placeholder="หมายเลขโทรศัพท์" value="<?php print current_user('mobile');?>">
                    </div>

                  </div>
                  <div class="form-group">
                    <label for="inputDept" class="col-sm-3 control-label">แผนก</label>
                    <div class="col-sm-9"> 
                      <select class="form-control" id="optDept" name="dept">
                        <option disabled <?php if(current_user('dept_id')=='0')print 'selected';?>>select one</option>
                        <option value="1" <?php if(current_user('dept_id')=='1')print 'selected';?>>PM</option>
                        <option value="2" <?php if(current_user('dept_id')=='2')print 'selected';?>>AM</option>
                        <option value="3" <?php if(current_user('dept_id')=='3')print 'selected';?>>Opr</option>
                        <option value="4" <?php if(current_user('dept_id')=='4')print 'selected';?>>QA</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPos" class="col-sm-3 control-label">ตำแหน่ง</label>
                    <div class="col-sm-9">
                      <input type="text" autocomplete='off'class="form-control" id="inputPos" name="pos" placeholder="ตำแหน่ง" value="<?php print current_user('position');?>">
                    </div>
                  </div>


                  <!-- <div class="form-group">

                    <label for="inputMobile" class="col-sm-3 control-label">หมายเลขโทรศัพท์</label>

                    <div class="col-sm-9">

                      <input type="text" class="form-control" id="inputMobile" name="mobile" placeholder="หมายเลขโทรศัพท์" value="<?php print current_user('mobile');?>">

                    </div>

                  </div> -->

<!--

                  <div class="form-group">

                    <label for="inputAdmin" class="col-sm-3 control-label">ผู้ดูแลระบบ</label>

                    <div class="col-sm-9">

                      <input type="checkbox" class="flat-red" class="form-control" id="inputAdmin" value="admin">

                    </div>

                  </div> -->

                

                  <div class="form-group">

                    <div class="col-sm-offset-3 col-sm-9">

                      <button type="submit" class="btn btn-danger">บันทึกการแก้ไข</button><span id="updateMessage"></span>

                    </div>

                  </div>

                  </form>

                  </div> 



                  <div class="tab-pane" id="userPicture">

                  <!--<form class="form-horizontal">-->

                  <form id="uploadimage" action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                    <div class="form-group">

                      <label for="inputSkills" class="col-sm-2 control-label">&nbsp;</label>



                      <div class="col-sm-10">

                      <div id="image_preview"><img id="previewing" src="<?php print current_user('picture'); ?>"  width="160"/></div>

                        <div class="btn btn-default btn-file">

                          <i class="fa fa-photo"></i> เลือกรูปประจำตัว

                          <input type="file" class="form-control" id="profilePicture" name="profilePicture">

                        </div>

                        <span id="loading">กรุณารอ..</span>

                        <span id="message"></span>

                      </div>

                  </div>

                  <div class="form-group">

                    <div class="col-sm-offset-2 col-sm-10">

                      <button type="submit" class="btn btn-danger">อัปโหลดรูปภาพ</button>

                    </div>

                  </div>

                  </form>

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

</section>



<script>

  $(document).ready(function () {

    $("#message").empty();
    $('#loading').hide();

  });

                  

$("#uploadimage").on('submit',(function(e) {

e.preventDefault();

$("#message").empty();

$('#loading').show();

$.ajax({

url: "<?php print site_url('ajax/home/profile/uploadProfilePicture/'); ?>", // Url to which the request is send

type: "POST",             // Type of request to be send, called as method

data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)

contentType: false,       // The content type used when sending data to the server.

cache: false,             // To unable request pages to be cached

processData:false,        // To send DOMDocument or non processed data file it is set to false

success: function(data)   // A function to be called if request succeeds

{

$('#loading').hide();

$("#message").html(data);

}

});

return false;

}));

//$("#updateData").ajaxForm({url: '<?php print site_url('ajax/home/profile/update/'); ?>', type: 'post'});



// Function to preview image after validation

$(function() {

$("#profilePicture").change(function() {

$("#message").empty(); // To remove the previous error message

var file = this.files[0];

if(!file){



$('#previewing').attr('src','<?php print site_url('pictures/profile/noimage.png',true); ?>');



    

}else{

var imagefile = file.type;

var match= ["image/jpeg","image/png","image/jpg"];



if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))

{

$('#previewing').attr('src','<?php print site_url('pictures/profile/noimage.png',true); ?>');

$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");

return false;

}

else

{

var reader = new FileReader();

reader.onload = imageIsLoaded;

reader.readAsDataURL(this.files[0]);



}

}

});

});

function imageIsLoaded(e) {

      $("#profilePicture").css("color","green");

      $('#image_preview').css("display", "block");

      $('#previewing').attr('src', e.target.result);

      $('#previewing').attr('width', '160px');

    };

  

</script>



<script>

$( "#updateDataForm" ).submit(function( event ) {

  event.preventDefault();

  var $form = $( this ),

    optDept=$form.find("select[name='dept']").val(),

    inputPos=$form.find("input[name='pos']").val(),

    inputTitle=$form.find("select[name='title']").val(),

    inputName = $form.find( "input[name='name']" ).val(),

    inputSurname = $form.find( "input[name='surname']" ).val(),

    inputEmail = $form.find("input[name='email']").val(),

    inputMobile = $form.find("input[name='mobile']").val(),

    url = $form.attr( "action" );

    //alert(inputMobile);

  var posting = $.post( url, {dept_id:optDept, position:inputPos, title:inputTitle, name: inputName, surname: inputSurname, email : inputEmail, mobile : inputMobile} );

  posting.done(function( data ) {

    //$( "#result" ).empty().append( data );

    showUpdate(data);

  });

});

</script>



<script src="<?php print site_url("system/template/AdminLTE/plugins/iCheck/icheck.min.js",true); ?>"></script>

        <script>

    

    //Flat red color scheme for iCheck

    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({

      checkboxClass: 'icheckbox_flat-blue',

      radioClass: 'iradio_flat-blue'

    });

    function showUpdate(txt){
        $("#systemAlert").html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i><b>'
                  +txt+
                  '</b></div>').hide().slideDown();
                  $(function(){
                    setTimeout(function(){
                      $("#systemAlert").slideUp()
                    },3000);
                  });
        }

  </script>