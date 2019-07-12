<body class="hold-transition login-page">
  <!-- jQuery 2.1.4 -->
<script src="<?php print site_url('system/template/AdminLTE/plugins/jQuery/jQuery-2.2.3.min.js',true); ?>"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php print site_url('system/template/AdminLTE/bootstrap/js/bootstrap.min.js',true); ?>"></script>
<!-- iCheck -->
<script src="<?php print site_url('system/template/AdminLTE/plugins/iCheck/icheck.min.js',true); ?>"></script>
<?php
  
  $title="ลงชื่อเข้าใช้";
  load_fun('tinyDB');
  print_r($_COOKIE);
//  load_fun("google");
//        googleINI();
  ?>
  
<div class="login-box">
<!--<div class="callout callout-warning">
        <h4>กำลังพัฒนา</h4>
        ระบบกำลังอยู่ในช่วงพัฒนาโปรดรอจนกว่าเราจะพร้อม..
      </div>-->
  <div class="login-logo">
    <a href="<?php print site_url(); ?>"><b><?php
      $siteName_data=getConfig('siteName','*');
      
  //print_r($siteName_data);
      print $siteName_data['detail'];
  ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">ลงชื่อเข้าใช้งาน</p>

    <form action="<?php print site_url("signin/login/check/userlogin/"); ?>" method="post">
      <div class="form-group has-feedback">
        <input name="username" type="username" class="form-control" placeholder="อีเมล์/ชื่อผู้ใช้">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input  name="password" type="password" class="form-control" placeholder="รหัสผ่าน">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember_login" value="remember"> จดจำการลงชื่อเข้าใช้
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">เข้าสู่ระบบ</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
<!--
    <div class="social-auth-links text-center">
      <p>- หรือ -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> ลงชื่อเข้าใช้ผ่าน
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> ลงชื่อเข้าใช้ผ่าน
        Google+</a>
    </div>
    
    <!-- /.social-auth-links -->
    <!--
    <a href="#">ลืมรหัสผ่าน</a><br>-->
    <hr>
	<?php
	if(get_system_config("activeGoogleOpenID")=='activated'){
	?>
        <a class="btn btn-block btn-social btn-google" href="<?php print genGoogleLinkLogin(); ?>">
                <i class="fa fa-google-plus"></i>ลงชื่อเข้าใช้ด้วย Gmail
        </a>
		<?php
	}
		?>
        <a class="btn btn-block btn-social btn-default" href="<?php print site_url("signin/signup/form/register/"); ?>">
                <i class="fa fa-pencil-square-o"></i>
                ลงทะเบียน
        </a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src="<?php print site_url("system/template/AdminLTE/plugins/iCheck/icheck.min.js",true); ?>"></script>
  <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
