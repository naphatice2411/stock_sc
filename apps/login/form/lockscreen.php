<?php
  
  $title="ลงชื่อเข้าใช้";
  load_fun('tinyDB');
  //print_r($_COOKIE);
  ?>
  <body class="hold-transition lockscreen">
<!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
     <a href="<?php print site_url(); ?>"><b><?php
      $siteName_data=getConfig('siteName','*');
  //print_r($siteName_data);
      print $siteName_data['detail'];
  ?></b></a>
  </div>
 <!-- User name -->
  <div class="lockscreen-name"><?php print last_user('name')." ".last_user('surname'); ?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php print last_user('picture'); ?>" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" action="<?php print site_url("signin/login/check/userlogin/"); ?>" method="post">
      <div class="input-group">
      <input type="hidden" name="username" value="<?php print last_user('username'); ?>">
      <input type="hidden" name="remember_login" value="remember">
        <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน">

        <div class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    ป้อนรหัสผ่านเพื่อกลับเข้าสู่การใช้งาน
  </div>
  <div class="text-center">
    <a href="<?php print site_url("signin/login/form/regular/"); ?>" class="text-center" id="submitBt">ลงชื่อเข้าใช้ด้วยบัญชีอื่น</a
  </div>
</div>
<!-- /.center -->

</body>