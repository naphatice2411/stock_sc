<?php



function gotoURL($url = '') {

    echo '<meta http-equiv="Refresh" content="0; url=' . $url . '" />';

}



function hs($s) {

    return htmlspecialchars($s);

}



function pq($s) {

    global $dbCon;

    return mysqli_real_escape_string($dbCon, $s);

}



function site_url($url = '', $direct = false) {

    global $htacceassConfig;

    if (!$htacceassConfig)

        $uriAdder = "/?p=";

    else

        $uriAdder = '/';

    if (!$direct) {

        if (substr(SITE_URL, strlen(SITE_URL) - 9, 9) == 'index.php')

            return SITE_URL . '/' . $url;

        return SITE_URL . $uriAdder . $url;

    }else {

        return SITE_URL . '/' . $url;

    }

}



function redirect($url = '', $direct = FALSE, $delay = FALSE) {

    if (substr($url, 0, 4 != "http") && !$direct)

        $url = site_url($url);



    if (!$delay) {

        header('Location: ' . $url);

//        exit;

    } else {

        echo '<meta http-equiv="Refresh" content="' . $delay . '; url=' . $url . '" />';

    }

    //echo '<meta http-equiv="refresh" content="0" url="'.$url.'">';

    //echo "<script>window.location.href='".$url."'</script>";

}



function load_fun($func_name) {

    if ($func_name) {

        $func_path = LIB_PATH . 'fun/' . $func_name . '.fun.php';

        if (file_exists($func_path))

            include_once($func_path);

    }

}



function curPageURL() {

    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on")

        $pageURL .= 's';

    $pageURL .= '://';

    if ($_SERVER["SERVER_PORT"] != "80")

        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];

    else

        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];

    return $pageURL;

}



function getBrowser() {

    $u_agent = $_SERVER['HTTP_USER_AGENT'];

    $bname = 'Unknown';

    $platform = 'Unknown';

    $version = "";



    if (preg_match('/linux/i', $u_agent))

        $platform = 'linux';

    elseif (preg_match('/macintosh|mac os x/i', $u_agent))

        $platform = 'mac';

    elseif (preg_match('/windows|win32/i', $u_agent))

        $platform = 'windows';



    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {

        $bname = 'Internet Explorer';

        $ub = "MSIE";

    } elseif (preg_match('/Firefox/i', $u_agent)) {

        $bname = 'Mozilla Firefox';

        $ub = "Firefox";

    } elseif (preg_match('/Chrome/i', $u_agent)) {

        $bname = 'Google Chrome';

        $ub = "Chrome";

    } elseif (preg_match('/Safari/i', $u_agent)) {

        $bname = 'Apple Safari';

        $ub = "Safari";

    } elseif (preg_match('/Opera/i', $u_agent)) {

        $bname = 'Opera';

        $ub = "Opera";

    } elseif (preg_match('/Netscape/i', $u_agent)) {

        $bname = 'Netscape';

        $ub = "Netscape";

    }



    // finally get the correct version number

    $known = array('Version', $ub, 'other');

    $pattern = '#(?<browser>' . join('|', $known) .

            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

    if (!preg_match_all($pattern, $u_agent, $matches)) {

        // we have no matching number just continue

    }



    // see how many we have

    $i = count($matches['browser']);

    if ($i != 1) {

        //we will have two since we are not using 'other' argument yet

        //see if version is before or after the name

        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {

            $version = $matches['version'][0];

        } else {

            $version = $matches['version'][1];

        }

    } else {

        $version = $matches['version'][0];

    }



    // check if we have a number

    if ($version == null || $version == "") {

        $version = "?";

    }



    return array(

        'userAgent' => $u_agent,

        'name' => $bname,

        'version' => $version,

        'platform' => $platform,

        'pattern' => $pattern

    );

}



function get_system_config($name, $exist = false) {

    global $dbCon;

    global $prefix;



    $query = "select * from {$prefix}site_config where config_name='{$name}' limit 1";

    $result = mysqli_query($dbCon, $query);



    $data = mysqli_fetch_array($result);

    if (mysqli_num_rows($result)) {

        if ($exist)

            return 1;

        else

            return $data['detail'];

    } else

        return false;

}



function update_system_config($name, $value) {

    global $dbCon;

    global $prefix;



    if (get_system_config($name, true)) {

        $query = "update {$prefix}site_config set detail='{$value}' where config_name='{$name}' limit 1";

    } else {

        $query = "insert into {$prefix}site_config (config_name,detail) values('{$name}','{$value}')";

    }

    $result = mysqli_query($dbCon, $query);

    return $result;

}



function autoLoad($funList = array()) {

    foreach ($funList as $v) {

        load_fun($v);

    }

}



function includeAppLib($appName) {

    $dir = APP_PATH . $appName . '/library';

    //print $dir;

    if (is_dir($dir)) {

        foreach (glob($dir . "/*.php") as $filename) {

            include $filename;

        }

    }

}



function _gen_menu($menu_id = NULL, $menu = array(), $def = NULL, $class = NULL) {

    //return 55555;

    $a = array();



    //return $menu;

    foreach ($menu as $k => $m) {

        $sel = '';

        //print $m['cond'];

        if ($m['cond'] === false)

            continue;

        if (isset($m['url']))

            $href = site_url($m['url']);

        if (isset($m['param']))

            $href .= '&' . $m['param'];

        if ($m['class'])

            $class_string = 'class="' . $m['class'] . '"';

        $a[] = '<li ' . $sel . '' . $class_string . '>' . $m['title'] . '</li>';

        if ($m['item']) {

            $tree = "";

            foreach ($m['item'] as $sk => $sv) {

                if ($sv['cond'] === false)

                    continue;

                $sel = $sk == $def['function'] ? 'active ' : '';

                $bullet = $sv['bullet'];

                if (!$sv['bullet']) {

                    $bullet = "fa fa-circle-o text-aqua";

                }

                $url = "#";

                if ($sv['url'])

                    $url = site_url($sv['url']);



                if (!count($sv['item'])) {

                    $tree .= '<li class="' . $sel . '"><a href="' . $url . '"><i class="' . $bullet . '"></i> <span>' . $sv['title'] . '</span></a></li>';

                } else if (count($sv['item'])) {



                    $tree .= "

        <li class='" . $sel . "treeview'>";



                    $tree .= '<a href="' . $url . '"><i class="' . $bullet . '"></i><span>' . $sv['title'] . '</span><i class="fa fa-angle-left pull-right"></i></a>';



                    $tree .= "

        <ul class='treeview-menu'>";

                    foreach ($sv['item'] as $key => $value) {

                        if ($value['cond'] === false)

                            continue;

                        $url = "#";

                        if ($value['url'])

                            $url = site_url($value['url']);

                        //print_r($value);

                        //print $key.">=<".$def['file'];

                        $sel = $key == $def['file'] ? ' class="active"' : '';

                        //print $sel;

                        $tree .= '<li' . $sel . '><a href="' . $url . '">';

                        $bullet = 'fa fa-circle-o';

                        if ($value['bullet'])

                            $bullet = $value['bullet'];

                        $tree .= '<i class="' . $bullet . '"></i>';

                        $tree .= $value['title'];

                        if ($value['num'])

                            $tree .= '<span class="label label-primary pull-right">' . $value['num'] . '</span>';

                        $tree .= '</a></li>';

                    }

                    $tree .= "</ul>";



                    $tree .= "</li>";

                }

            }

            $a[] = $tree;

        }

    }

//    return '<ul id="' . $menu_id . '" class="' . $class . '">' . implode('', $a) . '</ul>';

    return implode('',$a);

}



function sendVerifyMail($verifyData){

    $to=$verifyData['email'];

    $subject='Activate Member Account';

    $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= 'From: <info@edulearned.com>' . "\r\n";

    $message='Welcome : '.$verifyData['fName'].'<br>'

            . '=======================================<br>'

            . 'Activate account click here.<br>'

            . site_url('signin/signup/act/activate/uid/'.$verifyData['uid'].'/sid/'.$verifyData['sid']).'<br>'

            . '=======================================<br>'

            . 'EduLearned.com<br>';

    mail($to,$subject,$message,$headers);

}



function sendWarnMail($data){

    $to=$data['addr'];

    $subject='Warning!!';

    $headers="Content-type:text/html;charset=UTF-8"."\r\n";

    $headers.='From: <WarningSystem@edulearned.com>'."\r\n";

    $message='<b>Warning!!!</b>[TagID : <b>'.$data['tagID'].'</b>]<br>'

            . $data['message'].'<br>'

            . '<br>'

            . '<b>WarningSystem</b><br>Edulearned.com<br>';

    $logData=array('via'=>'"Email"','email'=>'"'.$to.'"','msg'=>'"'.$message.'"','user_id'=>'"'.$data['userID'].'"');

    insertTb('msgHist',$logData);

    mail($to,$subject,$message,$headers);

}



function gen_menu($menu_id = NULL, $menu = array(), $def = NULL, $class = NULL){

    $ret=array();

    foreach($menu as $k=>$m){

        $sel='';

//        print_r($m);

        if($m['cond']===false)continue;

        $href='#';if($m['url'])$href=site_url($m['url']);

        if($m['param'])$href.='&'.$m['param'];

        if($m['class'])$strClass='class="'.$m['class'].'"';

        $ret[]='<li '.$sel.' '.$strClass.'>'.$m['title'].'</li>';

        if($m['item']){

            $tv='';

            foreach($m['item'] as $sk=>$sv){

//                print_r($sv);

                if($sv['cond']===false)continue;

                $sel=$sk==$def['function'] ? 'active ' : '';

                $href='#';if($sv['url'])$href=site_url($sv['url']);

                $bullet='fa fa-circle-o';if($sv['bullet'])$bullet=$sv['bullet'];

                if(!count($sv['item'])){

                    $tv.='<li class="'.$sel.'"><a href="'.$href.'"><i class="'.$bullet.'"></i><span>'.$sv['title'].'</span>';

                    if($sv['num'])$tv.='<span class="label label-primary pull-right">' . $sv['num'] . '</span>';

                    $tv.='</a></li>';

                }

                else if(count($sv['item'])){

                    $tv.='<li class="'.$sel.'treeview">'

                            . '<a href="'.$href.'"><i class="'.$bullet.'"></i><span>'.$sv['title'].'</span>'

                            . '<span class="pull-right-container">'

                            . '<i class="fa fa-angle-left pull-right"></i>'

                            . '</span>'

                            . '</a>'

                            . '<ul class="treeview-menu">';

                    foreach($sv['item'] as $ssk=>$ssv){

//                        print_r($ssv);

                        if($ssv['cond']===false)continue;

                        $sel=$ssk==$def['file'] ? 'active ' : '';

                        $href='#';if($ssv['url'])$href=site_url($ssv['url']);

                        $bullet='fa fa-circle-o';if($ssv['bullet'])$bullet=$ssv['bullet'];

                        if(!count($ssv['item'])){

                            $tv.='<li class="'.$sel.'"><a href="'.$href.'"><i class="'.$bullet.'"></i>'.$ssv['title'];

                            if($ssv['num'])$tv.='<span class="label label-primary pull-right">' . $ssv['num'] . '</span>';

                            $tv.='</a></li>';

                        }else if(count($ssv['item'])){

                            $tv.='<li class="'.$sel.'"treeview">'

                                    . '<a href="'.$href.'"><i class="'.$bullet.'"></i>'.$ssv['title'].''

                                    . '<span class="pull-right-container">'

                                    . '<i class="fa fa-angle-left pull-right"></i>'

                                    . '</span>'

                                    . '</a>'

                                    . '<ul class="treeview-menu">';

                            foreach($ssv['item'] as $sssk=>$sssv){

//                                print_r($sssv);

                                if($sssv['cond']===false)continue;

                                $href='#';if($sssv['url'])$href=site_url($sssv['url']);

                                $bullet='fa fa-circle-o';if($sssv['bullet'])$bullet=$sssv['bullet'];

                                if(!count($sssv['item'])){

                                    $tv.='<li><a href="'.$href.'"><i class="'.$bullet.'"></i>'.$sssv['title'];

                                    if($sssv['num'])$tv.='<span class="label label-primary pull-right">' . $sssv['num'] . '</span>';

                                    $tv.='</a></li>';

                                }else{

                                    exit();

                                }

                            }

                            $tv.='</ul>'

                                    . '</li>';

                        }

                    }

                    $tv.='</ul>'

                            . '</li>';

                }

            }

            $ret[]=$tv;

        }

    }

    return implode('',$ret);

}





?>

