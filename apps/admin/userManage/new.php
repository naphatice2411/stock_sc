<?php
$title = "เพิ่มผู้ใช้งาน";
load_fun('tinyDB');
?>
<div class="callout callout-warning" id='alertDiv'>
  <div id='alertArea'>
  </div>
</div>
<div class="register-box-body">
  <p class="login-box-msg">ลงทะเบียนสมาชิก</p>

  <form id="regisForm">
    <div id="usernameDiv" class="form-group has-feedback">
      <input autocomplete="off" type="text" class="form-control" name="username" id="username" placeholder="ชื่อผู้ใช้">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div id="nameDiv" class="form-group has-feedback">
      <input autocomplete="off" type="text" class="form-control" name="name" id="name" placeholder="ชื่อ">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div id="surnameDiv" class="form-group has-feedback">
      <input autocomplete="off" type="text" class="form-control" name="surname" id="surname" placeholder="สกุล">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div id="mobileDiv" class="form-group has-feedback">
      <input autocomplete="off" type="text" class="form-control" name="mobile" id="mobile" placeholder="หมายเลขโทรศัพท์เคลื่อนที่" data-inputmask='"mask": "0999999999"' data-mask>
      <span class="glyphicon glyphicon-phone form-control-feedback"></span>
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
      <!-- /.col -->
      <div class="col-xs-4">
        <input type="button" class="btn btn-primary" id="registerNewAcc" value="ลงทะเบียน">
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
</div>
<script src="<?php print site_url('system/template/AdminLTE/plugins/input-mask/jquery.inputmask.js', true); ?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js', true); ?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js', true); ?>"></script>
<script>
  $('#registerNewAcc').click(function() {
    // $('#regisForm')[0].reset();
    var valid=checkRegister();
    if(valid){
      $.post('<?php print site_url("ajax/signup/submit/checking"); ?>', {
        username: $('#username').val(),
        name: $('#name').val(),
        surname: $('#surname').val(),
        mobile: $('#mobile').val(),
        email: "",
        password: $('#password').val()
      },function(res) {
        console.log(res);
        if(res.code==200){
          $('#alertArea').text(res.data);
          $('#alertDiv').slideDown('slow').delay(1500).slideUp();
          $('#regisForm')[0].reset();
        }else{
          $('#alertArea').text(res.data);
          $('#alertDiv').slideDown('slow').delay(1500).slideUp();
        }
        
      },"json");
    }
  });
  $("#alertDiv").hide();

  $("[data-mask]").inputmask();

  $('#name').focusout(function() {
    chkName();
  });
  $('#surname').focusout(function() {
    chkSurname();
  });
  $('#mobile').focusout(function() {
    chkMobile();
  });
  $('#password').focusout(function() {
    chkPassword();
  });
  $('#confirm_password').focusout(function() {
    chkConfirmPass();
  });
  $('#username').focusout(function() {
    chkUserName();
  });

  function checkRegister() {
    var mobile = $('#mobile').val();
    var password = $('#password').val();
    var confirmPassword = $('#confirm_password').val();

    if (chkUserName() && chkName() && chkSurname() && chkMobile() && chkPassword() && chkConfirmPass()) {
      return true;
    } else {
      return false;
    }
  }

  function validateUserName(UserName) {
    var filter = /^[A-Za-z0-9]+$/;
    if (filter.test(UserName)) return true;
    else return false;
  }

  function alertEmail() {
    $("#emailDiv").attr('class', 'form-group has-error has-feedback');
    $("#alertArea").text("กรุณาระบุ \"อีเมล\" ของท่านให้ถูกต้อง");
    $("#alertDiv").slideDown('slow').delay(1500).slideUp();
  }

  function alertUserName() {
    $("#usernameDiv").attr('class', 'form-group has-error has-feedback');
    $("#alertArea").text("\"ชื่อผู้ใช้\" ของท่านต้องประกอบไปด้วยตัวอักษรภาษาอังกฤษและ/หรือตัวเลขเท่านั้น");
    $("alertDiv").slideDown('slow').delay(1500).slideUp();
  }

  function chkName() {
    var name = $('#name').val();
    if ($.trim(name).length < 3) {
      $("#nameDiv").attr('class', 'form-group has-error has-feedback');
      $("#alertArea").text("กรุณาระบุ \"ชื่อ\" ของท่าน (อย่างน้อย 3 ตัวอักษร)");
      $("#alertDiv").slideDown('slow').delay(1500).slideUp();
      return false;
    } else {
      $("#nameDiv").attr('class', 'form-group has-success has-feedback');
      return true;
    }

  }

  function chkSurname() {
    var surname = $('#surname').val();
    if ($.trim(surname).length < 3) {
      $("#surnameDiv").attr('class', 'form-group has-error has-feedback');
      $("#alertArea").text("กรุณาระบุ \"สกุล\" ของท่าน (อย่างน้อย 3 ตัวอักษร)");
      $("#alertDiv").slideDown('slow').delay(1500).slideUp();
      return false;
    } else {
      $("#surnameDiv").attr('class', 'form-group has-success has-feedback');
      return true;
    }

  }

  function chkMobile() {
    var mobile = $('#mobile').val();
    if ($.trim(mobile).length == 10 && $.isNumeric(mobile)) {
      $("#mobileDiv").attr('class', 'form-group has-success has-feedback');
      return true;
    } else {
      $("#mobileDiv").attr('class', 'form-group has-error has-feedback');
      $("#alertArea").text("กรุณาระบุ \"หมายเลขโทรศัพท์\" ของท่าน (จำนวน 10 หลัก)");
      $("#alertDiv").slideDown('slow').delay(1500).slideUp();
      return false;
    }

  }

  function chkUserName() {
    var UserName = $('#username').val();
    if ($.trim(UserName).length < 6) {
      $("#usernameDiv").attr('class', 'form-group has-error has-feedback');
      $("#alertArea").text("กรุณาระบุ \"ชื่อผู้ใช้\" ของท่าน (อย่างน้อย 6 ตัวอักษร)");
      $("#alertDiv").slideDown('slow').delay(1500).slideUp();
      return false;
    }
    if (validateUserName(UserName)) {
      $("#usernameDiv").attr('class', 'form-group has-success has-feedback');
      return true;
    } else {
      alertUserName();
      return false;
    }
  }

  function chkPassword() {
    var password = $('#password').val();
    if ($.trim(password).length < 8) {
      $("#passDiv").attr('class', 'form-group has-error has-feedback');
      $("#alertArea").text("กรุณาระบุ \"รหัสผ่าน\" ของท่าน (อย่างน้อย 8 ตัวอักษร)");
      $("#alertDiv").slideDown('slow').delay(1500).slideUp();
      return false;
    } else {
      $("#passDiv").attr('class', 'form-group has-success has-feedback');
      return true;
    }

  }

  function chkConfirmPass() {
    var password = $('#password').val();
    var confirmPassword = $('#confirm_password').val();
    if ($.trim(password).length >= 8) {
      if (password == confirmPassword) {
        $("#confirmPassDiv").attr('class', 'form-group has-success has-feedback');
        return true;
      } else {
        $("#confirmPassDiv").attr('class', 'form-group has-error has-feedback');
        $("#alertArea").text("กรุณา \"ยืนยันรหัสผ่าน\" ให้ตรงกันกับรหัสผ่านของท่าน");
        $("#alertDiv").slideDown('slow').delay(1500).slideUp();
        return false;
      }
    }

  }
</script>