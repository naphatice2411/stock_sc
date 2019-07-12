<?php
        $updateData=array("default_uri"=>"'".$_POST['newHomepage']."'");
        updateTb("userdata",$updateData,"user_id=".current_user('user_id')." limit 1",true);
//        exit();