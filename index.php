<?php
    header('Content-Type: text/html; charset=utf-8');
    define('INDEX_PATH',str_replace('\\','/',dirname(__FILE__)).'/');
    // print(INDEX_PATH);
    $startRender=microtime(true);
    ob_start();
    session_start();
    // session_destroy();
    include 'system/include/config.php';
    global $htacceassConfig;
    if($htacceassConfig)$hGET=array(array_reverse($_GET));
    else{
        $str=explode('/',$_GET['p']);
        $num=0;
        $hGET=array();
        foreach($str as $v){
            if($num%2){
                $hGET[$key]=$v;
            }else{
                $key=$v;
            }
            $num++;
        }
    }
    $template=key($hGET);
    $app= array_shift($hGET);
    $function=key($hGET);
    $file=array_shift($hGET);
    load_fun('user');
    if(!current_user('user_id')){
        unset($_SESSION['access_token']);
        if($file!='redirect')unset($_SESSION['google_code']);
    };
    if(!isset($_COOKIE['start_page'])&&$template!='ajax'||!$_SESSION['siteConfig']['siteURL']&&$template!='ajax'){
        setcookie('start_page','no',time()+(86400*30),'/'); //86400=1day
        gotoURL('./');
        print_r($_SESSION);
        exit();
    }
    if(current_user('user_id')==false&&$app!="login"&&$app!="signup"&&$template!="ajax"){
        if($_SESSION['access_token']){
            redirect(site_url("signin/login/google/redirect/"),true);
        }else if(last_user('user_id')){
            define('SITE_URL',$_SESSION['siteConfig']['siteURL']);
            redirect(site_url("signin/login/form/lockscreen/"),true);
        }else if(get_system_config("activeGoogleOpenID")=='activated'){
            redirect(site_url("signin/login/form/gmail/"),true);
        }else{
            redirect(site_url("signin/login/form/regular/"),true);
        }
    }else{
        if((!$template&&!$app&&!$function&&!$file)||(current_user('user_id')&&$app=="login")){
            if(current_user('default_uri')&&current_user('user_id')){
                define('SITE_URL', get_system_config('siteURL'));
                redirect(current_user('default_uri'));
            }else{
                if(!$template)$template='main';
                if(!$app)$app='main';
                if(!$function)$function='dashboard';
                if(!$file)$file='index';    
            }
        }
    }
    
    //    print $template;
    //    print $app;
    //    print $function;
    //    print $file;
    //    exit();
    $curCRI=$template.'/'.$app.'/'.$function.'/'.$file;
    $fileContent=APP_PATH.$app.'/'.$function.'/'.$file.'.php';
    includeAppLib($app);
    if(!file_exists($fileContent)){
        print $fileContent;
        $incfile='apps/home/error/404.php';
    }else{
        $incfile=$fileContent;
    }
    
    include $incfile;
    $content = ob_get_contents();
    ob_end_clean();
    // print(current_user('user_id'));
    
    $fileNotification="system/include/MainPage/notificationMenu.inc.php";
    $notificationMenu= get_include_contents($fileNotification);
    
    $fileMainMenu='system/include/MainPage/MainMenu.inc.php';
    $MainMenu=get_include_contents($fileMainMenu);
    
    $fileSidebar='system/include/MainPage/sidebar.inc.php';
    $sidebar= get_include_contents($fileSidebar);
    
    function get_include_contents($filename) {
        $filename = BASE_PATH . $filename;
        if (is_file($filename)) {
            ob_start();
            include $filename;
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;
        }
        return false;
    }
include BASE_PATH.'system/template/'.$template.'.tem.php';
?>