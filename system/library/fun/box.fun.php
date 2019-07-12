<?php
function genSmallBox($data){
    foreach($data as $row){
        $_SESSION['old_'.$row['id']]=$row['end_number'];
        if(!$row['color'])$row['color']='aqua';
        if(!$row['url'])$row['url']='#';
        $box.='<div class="col-lg-3 col-xs-6">'
                . '<div class="small-box bg-'.$row['color'].'">'
                . '<div class="inner">'
                . '<h3 id="number_'.$row['id'].'">'.number_format($row['start_number']).'</h3>'
                . '<p>'.$row['title'].'</p>'
                . '</div>'
                . '<div class="icon">'
                . '<i class="'.$row['icon'].'" style="padding-top: 18px;"></i>'
                . '</div>'
                . '<a href="'.$row['url'].'" target="'.$row['target'].'" class="small-box-footer">'
                . 'ข้อมูลเพิ่มเติม <i class="fa fa-arrow-circle-right"></i>'
                . '</a>'
                . '</div>'
                . '</div>';
        $animation="";
        if($row['start_number']!=$row['end_number']){
			$animation="<script>
			var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('#number_".$row['id']."')
  					.prop('number', ".$row['start_number'].")
  					.animateNumber(
    				{
      					number: ".$row['end_number'].",
      					numberStep: comma_separator_number_step
    				},
    			5000
  				);
			</script>";
        }
        $box.=$animation;
    }
    return '<div class="row">'.$box.'</div>';
}
?>
<!--<div class="col-lg-3 col-xs-6">
           small box 
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
-->

<?php
    function genSocialWidgets($data){
        foreach($data as $row){
            if(!$row['color'])$row['color']='blue';
            $picPath=BASE_PATH.'system/pictures/profile/'.$row['username'].'.png';
//            print $picPath;
            if(file_exists($picPath))$picture=site_url('system/pictures/profile/'.$row['username'].'.png',true);
            else $picture=site_url('system/pictures/profile/noimage.png',true);
//            print $picture;
            $accessionData=json_decode($row['accession']);
            $accessions="";
            global $AdminLTE_color;
            $i=0;
            if(is_array($accessionData)){
                foreach($accessionData as $a){
                    $accessions.='<span class="pull-right badge bg-'.$AdminLTE_color[$i].'">';
                    $accessions.= ucfirst($a).'</span>';
                    $i++;
                }
            }
            $box.='<div class="col-md-4">'
                    . '<div class="box box-widget widget-user-2">'
                    . '<div class="widget-user-header bg-'.$row['color'].'">'
                    . '<div class="widget-user-image">'
                    . '<img class="img-circle" src="'.$picture.'" alt="'.$row['username'].'">'
                    . '</div>'
                    . '<h3 class="widget-user-username">'.$row['name'].' '.$row['surname'].'</h3>'
                    . '<h5 class="widget-user-desc">'.ucfirst($row['user_type']).'</h5>'
                    . '</div>'
                    . '<div class="box-footer no-padding">'
                    . '<ul class="nav nav-stacked">'
                    . '<li><a href="#">ลงทะเบียน<span class="pull-right badge bg-'.$row['color'].'">'.thai_date_time($row['signup'],true).'</span></a></li>'
                    . '<li><a href="#">แอพพลิเคชั่น'.$accessions.'</a></li>'
                    . '<li><a href="#">เข้าใช้งานครั้งล่าสุด<span class="pull-right badge bg-'.$row['color'].'">'.thai_date_time($row['last_login'],true).'</span></a></li>'
                    . '<li><a href="'.site_url('main/admin/userManage/detail/id/'.$row['user_id']).'">แก้ไข<span class="pull-right"><i class="fa fa-edit"></i></span></a></li>'
                    . '</ul>'
                    . '</div>'
                    . '</div>'
                    . '</div>';
        }
        return '<div class="row">'.$box.'</div>';
    }
?>

<!--<div class="col-md-4">
           Widget: user widget style 1 
          <div class="box box-widget widget-user-2">
             Add the bg color to the header using any of the bg-* classes 
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
              </div>
               /.widget-user-image 
              <h3 class="widget-user-username">Nadia Carmichael</h3>
              <h5 class="widget-user-desc">Lead Developer</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
              </ul>
            </div>
          </div>
           /.widget-user 
        </div>-->

<?php
    function genInfoBox($data){
	
	foreach($data as $row){
		$_SESSION['old_'.$row['id']]=$row['end_number'];
	if(!$row['color'])$row['color']="aqua";
	if(!$row['url'])$row['url']="#";
	$box.=' <div class="col-lg-3 col-xs-6">
         	<div class="info-box">
  			<!-- Apply any bg-* class to to the icon to color it -->
  			<a href="'.$row['url'].' target="'.$row['target'].'">
  			<span class="info-box-icon bg-'.$row['color'].'"><i class="'.$row['icon'].'" style="padding-top: 18px;"></i></span>
  				<div class="info-box-content">
    				<span class="info-box-text">'.$row['title'].'</span>
    				<span class="info-box-number" id="number_'.$row['id'].'">
    				'.number_format($row['start_number']).'
    				</span>
    				</a>
  				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>';
		$animation="";
		 if($row['start_number']!=$row['end_number']){
			$animation="<script>
			var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('#number_".$row['id']."')
  					.prop('number', ".$row['start_number'].")
  					.animateNumber(
    				{
      					number: ".$row['end_number'].",
      					numberStep: comma_separator_number_step
    				},
    			5000
  				);
			</script>";
        }
        $box.=$animation;
	}
	
	return '<div class="row">'.$box."</div>";
}
?>