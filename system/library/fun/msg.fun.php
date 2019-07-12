<?php
    function getMsg($target,$tagid){
        load_fun('tinyDB');
        load_fun('user');
        $msgData=selectTb('msgData',$target,' tagID="'.$tagid.'" and user_id="'.current_user('user_id').'" limit 1');
//        print_r($msgData);
        if(!count($msgData))return false;
        $msgData=$msgData[0];
        return $msgData[$target];
    }