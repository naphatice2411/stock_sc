<?php
  $title="ยืนยันอีเมล์";
  load_fun('tinyDB');
  $sid=$hGET['sid'];
  $uid=$hGET['uid'];
  $acTive='';
  $curStatus=selectTb('userdata','*','username="'.$uid.'" and sid="'.$sid.'"');
  if($curStatus){
//      print_r($curStatus);
      $curStatus=$curStatus[0];
      updateTb("userdata",array("active"=>"'Y'"),"username='".$uid."' and sid='".$sid."'");
      $acTive='Y';
  }else{
      $acTive='N';
  }
  ?>
  <body class="hold-transition lockscreen">
<!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
     <a href="<?php print site_url(); ?>"><b><?php
      $siteName_data=getConfig('siteName','*');
  //print_r($siteName_data);
      print $siteName_data['detail'];
      ?></b></a><br><b><h4><?php if($acTive=='Y')print 'ลงทะเบียนเสร็จสิ้น';else{print 'ลงทะเบียนล้มเหลว'; redirect('signin/login/form/regular',false,3);} ?>
      </h4></b></div>
 <!-- User name -->
  <div class="lockscreen-name"><?php print $curStatus['name']." ".$curStatus['surname']; ?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php print site_url('system/pictures/profile/noimage.png',true); ?>" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" action="<?php print site_url("signin/login/check/userlogin/"); ?>" method="post">
      <div class="input-group">
      <input type="hidden" name="username" value="<?php print $curStatus['username']; ?>">
      <input type="hidden" name="remember_login" value="">
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
    ป้อนรหัสผ่านเพื่อเข้าใช้งาน
  </div>
  <div class="text-center">
    <a href="<?php print site_url("signin/login/form/regular/"); ?>" class="text-center" id="submitBt">ลงชื่อเข้าใช้ด้วยบัญชีอื่น</a
  </div>
  <div class="lockscreen-footer text-center">
    สงวนลิขสิทธิ์ &copy; 2017 <b><a href="http://www.edulearned.com" class="text-black">EduLearned.com</a></b><br>
    All rights reserved
  </div>
</div>
<!-- /.center -->

</body>