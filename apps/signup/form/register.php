<body class="hold-transition login-page">
<!-- jQuery 3 -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/jquery/dist/jquery.min.js',true);?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js',true);?>"></script>
<!-- iCheck -->
<script src="<?php print site_url('system/template/AdminLTE/plugins/iCheck/icheck.min.js',true);?>"></script>
<?php
  $title="ลงทะเบียน";
  load_fun('tinyDB');
  ?><div class="register-box">
  <div class="register-logo">
   <a href="<?php print site_url(); ?>"><b><?php
      $siteName_data=getConfig('siteName','*');
      print $siteName_data['detail'];
      
      load_fun("google");
        googleINI();
  ?></b></a>
  </div>
<div class="callout callout-warning" id='alertDiv'>
                โปรดตรวจสอบข้อมูลของท่าน.<br>
                <div id='alertArea'>
                </div> 
              </div>
  <div class="register-box-body">
    <p class="login-box-msg">ลงทะเบียนสมาชิก</p>

    <form action="<?php print site_url("signin/signup/submit/checking"); ?>" method="post" onSubmit="return checkRegister();">
      <div id="userNameDiv" class="form-group has-feedback">
        <input type="text" class="form-control" name="username" id="username" placeholder="ชื่อผู้ใช้">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div id="nameDiv" class="form-group has-feedback">
        <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div id="surnameDiv" class="form-group has-feedback">
        <input type="text" class="form-control" name="surname" id="surname" placeholder="สกุล">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div id="mobileDiv" class="form-group has-feedback">
        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="หมายเลขโทรศัพท์เคลื่อนที่" data-inputmask='"mask": "0999999999"' data-mask>
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div id="emailDiv" class="form-group has-feedback" >
        <input id="email" type="email" class="form-control" name="email" placeholder="อีเมล">
        <span id="emailSpan" class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div id="passDiv" class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div id="confirmPassDiv" class="form-group has-feedback">
        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="ยืนยันรหัสผ่าน">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
                <input type="checkbox" name="agreeBox" id="agreeBox" value="agree"> ฉันยอมรับ<a href="<?php print site_url("signin/signup/form/agreement/"); ?>" target="_blank">ข้อตกลง</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="register" class="btn btn-primary btn-block btn-flat">ลงทะเบียน</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>
-->
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
        <a class="btn btn-block btn-social btn-default" href="<?php print site_url("signin/login/form/regular/"); ?>">
                <i class="fa  fa-sign-in"></i>
                ลงชื่อเข้าใช้ด้วยตนเอง
        </a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
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
<script src="<?php print site_url('system/template/AdminLTE/plugins/input-mask/jquery.inputmask.js',true); ?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js',true); ?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js',true); ?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/jQuery/validationEngine.js',true); ?>"></script>
<script>
        function checkRegister(){
         var mobile=$('#mobile').val();
         var password=$('#password').val();
         var confirmPassword=$('#confirm_password').val();
        
          if(chkName() && chkSurname() && chkMobile() && chkMail() && chkPassword() && chkConfirmPass() && chkAgree()){
                return true;
          }else{
                return false;
          }
        }
  function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}
  function validateUserName(UserName){
      var filter=/^[A-Za-z0-9]+$/;
      if(filter.test(UserName))return true;
      else return false;
  }
  
  function alertEmail(){
    $("#emailDiv").attr('class','form-group has-error has-feedback');
    $("#alertArea").text("กรุณาระบุ \"อีเมล\" ของท่านให้ถูกต้อง");
    $("#alertDiv").slideDown();
  } 
  
  function alertUserName(){
      $("#usernameDiv").attr('class','form-group has-error has-feedback');
      $("#alertArea").text("\"ชื่อผู้ใช้\" ของท่านต้องประกอบไปด้วยตัวอักษรภาษาอังกฤษและ/หรือตัวเลขเท่านั้น");
      $("alertDiv").slideDown();
  }
  
  function chkName(){
          var name=$('#name').val();
          if($.trim(name).length<3){
                $("#nameDiv").attr('class','form-group has-error has-feedback');
                $("#alertArea").text("กรุณาระบุ \"ชื่อ\" ของท่าน (อย่างน้อย 3 ตัวอักษร)");
                $("#alertDiv").slideDown();
                return false;
          }else{
                $("#nameDiv").attr('class','form-group has-success has-feedback');
                return true;
          }
          
  }
  function chkSurname(){
          var surname=$('#surname').val();
          if($.trim(surname).length<3){
                $("#surnameDiv").attr('class','form-group has-error has-feedback');
                $("#alertArea").text("กรุณาระบุ \"สกุล\" ของท่าน (อย่างน้อย 3 ตัวอักษร)");
                $("#alertDiv").slideDown();
                return false;
          }else{
                $("#surnameDiv").attr('class','form-group has-success has-feedback');
                return true;
          }
          
  }
  function chkMobile(){
          var mobile=$('#mobile').val();
          if($.trim(mobile).length==10&&$.isNumeric(mobile)){
                $("#mobileDiv").attr('class','form-group has-success has-feedback');
                return true;
          }else{
                $("#mobileDiv").attr('class','form-group has-error has-feedback');
                $("#alertArea").text("กรุณาระบุ \"หมายเลขโทรศัพท์\" ของท่าน (จำนวน 10 หลัก)");
                $("#alertDiv").slideDown();
                return false;
          }
          
  }
  
  function chkUserName(){
      var UserName=$('#username').val();
      if($.trim(UserName).length<6){
          $("#usernameDiv").attr('class','form-group has-error has-feedback');
          $("#alertArea").text("กรุณาระบุ \"ชื่อผู้ใช้\" ของท่าน (อย่างน้อย 6 ตัวอักษร)");
          $("#alertDiv").slideDown();
          return false;
      }
      if(validateUserName(UserName)){
          $("#usernameDiv").attr('class','form-group has-success has-feedback');
          return true;
      }else{
          alertUserName();
          return false;
      }
  }
  
  function chkMail(){
          var sEmail = $('#email').val();
        if ($.trim(sEmail).length == 0) {
          
          alertEmail();
          return false;
        }
        if (validateEmail(sEmail)) {
          //alert('Email is valid');
          $("#emailDiv").attr('class','form-group has-success has-feedback');
          return true;
        }
        else {
          alertEmail();
          return false;
        }
  }
  function chkPassword(){
        var password=$('#password').val();
           if($.trim(password).length<8){
                $("#passDiv").attr('class','form-group has-error has-feedback');
                $("#alertArea").text("กรุณาระบุ \"รหัสผ่าน\" ของท่าน (อย่างน้อย 8 ตัวอักษร)");
                $("#alertDiv").slideDown();
                return false;
          }else{
                $("#passDiv").attr('class','form-group has-success has-feedback');
                return true;
          }
          
  }
  
  function chkConfirmPass(){
        var password=$('#password').val();
        var confirmPassword=$('#confirm_password').val();
        if($.trim(password).length>=8){
          if(password==confirmPassword){
                $("#confirmPassDiv").attr('class','form-group has-success has-feedback');
                return true;
          }else{
                $("#confirmPassDiv").attr('class','form-group has-error has-feedback');
                $("#alertArea").text("กรุณา \"ยืนยันรหัสผ่าน\" ให้ตรงกันกับรหัสผ่านของท่าน");
                $("#alertDiv").slideDown();
                return false;
          }
        }
          
  }
  
  function chkAgree(){
        if($('#agreeBox').is(':checked')){
                return true;
        }else{
                $("#alertArea").text("กรุณา \"ยอมรับข้อตกลงการใช้งาน\" เพื่อลงทะเบียน");
                $("#alertDiv").slideDown();
                return false;
        }
          
  }
  
$(document).ready(function() {

$("#alertDiv").hide();

$("[data-mask]").inputmask();

$('#name').focusout(function(){
        chkName();
  });
  $('#surname').focusout(function(){
        chkSurname();
  });
  $('#mobile').focusout(function(){
        chkMobile();
  });
   $('#email').focusout(function() {
        chkMail();
    });
    $('#password').focusout(function(){
         chkPassword();
  });
  $('#confirm_password').focusout(function(){
        chkConfirmPass();
  });
  $('#username').focusout(function(){
      chkUserName();
  });
});
  </script>
