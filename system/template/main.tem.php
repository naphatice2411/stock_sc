<?php
//print_r($_COOKIE);
//print current_user('accession');
//print current_user('user_type');
//print site_url("ajax/user/setHomepage/submit");
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="<?php print site_url("system/template/AdminLTE/plugins/iCheck/all.css", true); ?>">
  <script src="<?php print site_url("system/template/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js", true); ?>"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?php print site_url("favicon.ico", true); ?>" type="image/x-icon" />
        <?php
        if (!$title)
            $showTitle = $_SESSION['siteConfig']['subName'];
        else
            $showTitle = $_SESSION['siteConfig']['subName'] . " : " . $title;
        ?>
  <title><?php print $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css',true)?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php print site_url('system/template/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css',true)?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php print site_url('system/template/AdminLTE/bower_components/Ionicons/css/ionicons.min.css',true)?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php print site_url('system/template/AdminLTE/dist/css/AdminLTE.min.css',true)?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php print site_url('system/template/AdminLTE/dist/css/skins/_all-skins.min.css',true)?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php print site_url('system/template/AdminLTE/bower_components/morris.js/morris.css',true)?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php print site_url('system/template/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css',true)?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',true)?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css',true)?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php print site_url('system/template/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',true)?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php print site_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php print_r($_SESSION['siteConfig']['subName']); ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php print_r($_SESSION['siteConfig']['siteName']);?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <?php print $notificationMenu;?>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            <img src="<?php print current_user('picture')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php print current_user('name')." ".current_user('surname');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
        </div>
      </div>
      <!-- ช่องค้นหาตรงหน้าเทมเพลทหลัก -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
          <?php 
//          print $MainMenu;
          $listMenu=json_decode(current_user('accession'));
          if(current_user('user_type')){
              $appPath=APP_PATH;
              $lsResult=array_slice(scandir($appPath),2);
            //  print_r($lsResult);
              $i=0;
              foreach($lsResult as $row){
                  $menuPath=$appPath.$row.'/menu.php';
                  if(!file_exists($menuPath))continue;
                  $configPath=$appPath.$row.'/config.php';
                  if(!file_exists($configPath))continue;
                  include_once($configPath);
                //   print(current_user('user_type'));
                  if(is_array($appConfig['userType'])){
                      // print_r($appConfig['userType']);
                      if(array_search(current_user('user_type'),$appConfig['userType']))array_push($listMenu,$row);
                  }else{
                      // print($appConfig['userType']);
                      if($appConfig['userType']==current_user('user_type'))array_push($listMenu,$row);
                  }
              }
          }
        //  print_r($listMenu);
          sort($listMenu);
          global $app;
          global $function;
          global $file;
          $menuArr=array(
              'app'=>$app,
              'function'=>$function,
              'file'=>$file,
          );
          $mainMenu=array();
          // print_r($listMenu);
          if(count($listMenu)){
              foreach($listMenu as $menu){
                  $menuPath=APP_PATH.$menu.'/menu.php';
                  if(file_exists($menuPath))include_once($menuPath);
              }
          }
          print gen_menu('mainMenu',$mainMenu,$menuArr,'sidebar-menu');
          ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php print $title;?>
        <small id="subtitle"><?php print $subtitle;?></small>
      </h1>
      <ol class="breadcrumb">
                            <?php
                            global $template;
                            global $app;
                            global $function;
                            global $file;
                            global $curCRI;
                            ?>
                            <li><a href="<?php print site_url($template . '/'); ?>"><i class="fa fa-home"></a></i> <?php print $template; ?></a></li>
                            <li><a href="<?php print site_url($template . '/' . $app . '/'); ?>"><?php print $app; ?></a></li>
                            <li class="active"><?php print $function; ?></li>

                            <li><a id="setHome" href="#" title="ตั้งหน้านี้เป็นหน้าหลัก"><i class="fa fa-map-pin"></a></i>
                        </ol>
    </section>
    <script>
                        setInterval(function () {
                            callJob()
                        }, 10000);
                        function callJob() {
                            console.log($.get("<?php // print site_url("ajax/cron/call/job/by/web/num/10"); ?>"));
                        }

                        $("#setHome").click(function () {
                            setHome('<?php print $curCRI; ?>');
                        });
                        function setHome(URI) {
                            formData = {
                                'newHomepage': URI,
                            };
                            $.ajax({
                                type: 'POST',
                                url: '<?php print site_url("ajax/user/setHomepage/submit"); ?>',
                                data: formData,
                                dataType: 'text',
                                encode: true
                            }).done(function (data) {
                                showUpdateHome(URI);
                                console.log(data);
                            });
                        }
                        function showUpdateHome(URI) {
                            $("#systemAlert").html('<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-info"></i> โปรดทราบ!</h4>ตั้งหน้าหลักของคุณเป็น "<b>'
                                    + URI +
                                    '</b>" เรียบร้อยแล้ว</div>').hide().slideDown();
                            $(function(){
                              setTimeout(function(){
                                $("#systemAlert").slideUp()
                              },3000);
                            });

                        }
                    </script>

    <!-- Main content -->
    <section class="content">
        <div id="systemAlert"></div>
      <?php print $content; ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2017 <a href="http://edulearned.com">EducationLearned</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->
<?php print $sidebar;?>
<div class="control-sidebar-bg"></div>
<!-- jQuery 3 -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/jquery/dist/jquery.min.js',true);?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/jquery-ui/jquery-ui.min.js',true);?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js',true);?>"></script>
<!-- Morris.js charts -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/raphael/raphael.min.js',true);?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/bower_components/morris.js/morris.min.js',true);?>"></script>
<!-- Sparkline -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js',true);?>"></script>
<!-- jvectormap -->
<script src="<?php print site_url('system/template/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',true);?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',true);?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js',true);?>"></script>
<!-- daterangepicker -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/moment/min/moment.min.js',true);?>"></script>
<script src="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js',true);?>"></script>
<!-- datepicker -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',true);?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php print site_url('system/template/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',true);?>"></script>
<!-- Slimscroll -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',true);?>"></script>
<!-- FastClick -->
<script src="<?php print site_url('system/template/AdminLTE/bower_components/fastclick/lib/fastclick.js',true);?>"></script>
<!-- AdminLTE App -->
<script src="<?php print site_url('system/template/AdminLTE/dist/js/adminlte.min.js',true);?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php print site_url('system/template/AdminLTE/dist/js/pages/dashboard.js',true);?>"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="<?php // print site_url('system/template/AdminLTE/dist/js/demo.js',true);?>"></script>-->
<script src="<?php print site_url("system/include/js/rightMenu.js", true); ?>"></script>
<script>
    $(document).ready(function () {
        $("#renderTime").text("<?php print number_format(microtime(true) - $startRender, 2) . " วินาที"; ?>");
        $(window).keydown(function(event){
          if(event.keyCode == 13) {
            event.preventDefault();
            return false;
          }
        });
      });
            </script>
</body>
</html>
