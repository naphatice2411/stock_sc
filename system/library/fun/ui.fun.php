<?php

function genIcon($data){
        if(!$data['color'])$data['color']="bg_aqua";
        if(!$data['icon'])$data['icon']="fa fa-file-o";
        
        if(!$data['url'])$data['url']="#";
        
        return '
         <div class="col-lg-3 col-xs-6">
         	<div class="info-box '.$data['bgColor'].'">
  			<span class="info-box-icon '.$data['color'].'"><i class="'.$data['icon'].'" style="padding-top: 18px;"></i></span>
  				<div class="info-box-content">
  				<a href="'.$data['url'].'">
    				<span class="info-box-text">'.$data['title'].'</span>
    				<span class="info-box-number">'.$data['subTitle'].'</span>
    				</a>
    				<span class="info-box-text">'.$data['detail'].'</span>
    				
  				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
        ';
}

?>