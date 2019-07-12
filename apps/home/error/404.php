<?php
  $title="Error-404";
  $subtitle="ไม่พบไฟล์ที่ระบุ";
    ?>
<div class="row">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> ไม่พบไฟล์.</h3>

          <p>
            ระบบไม่พบไฟล์ที่คุณต้องการ.
            ข้อผิดพลาดนี้อาจจะเป็นเพียงชั่วคราวหรือถาวรก็ได้กรุณาลองใหม่ในภายหลัง, คุณอาจจะ <a href="<?php print site_url(); ?>">กลับไปหน้าหลัก</a> หรือค้นหาสิ่งที่คุณต้องการ.
          </p>

          <form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="คำค้น">

              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
      </div>