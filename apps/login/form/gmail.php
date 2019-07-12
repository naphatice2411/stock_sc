<body class="hold-transition login-page">
<?php
  
  $title="ลงชื่อเข้าใช้";
        load_fun("google");
        googleINI();
  ?>
  
<div class="login-box">

  <div class="login-logo">
    <a href="<?php print site_url(); ?>"><b><?php
  //print_r($siteName_data);
      print get_system_config('siteName');
  ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
   <p>
        <a class="btn btn-block btn-social btn-google" href="<?php print genGoogleLinkLogin(); ?>">
                <i class="fa fa-google-plus"></i>ลงชื่อเข้าใช้ด้วย Gmail
              </a>
     <!-- <hr> -->
     <!-- <a class="btn btn-block btn-social btn-twitter" href="<?php print site_url("signin/login/form/regular/"); ?>">
                <i class="fa  fa-sign-in"></i>
                ลงชื่อเข้าใช้ด้วยตนเอง
        </a>
        <a class="btn btn-block btn-social btn-twitter" href="<?php print site_url("signin/signup/form/register/"); ?>">
                <i class="fa fa-pencil-square-o"></i>
                ลงทะเบียน
        </a> -->
    </center>
</p>
  </div>
  <!-- /.login-box-body -->
</div>

</body>