<?php
  function googleINI(){
    include_once LIB_PATH."ext/oauthen/google-api/examples/templates/base.php";

    set_include_path(LIB_PATH."ext/oauthen/google-api//src/" . PATH_SEPARATOR . get_include_path());
  
    require_once 'Google/Client.php';
  
    require_once 'Google/Service/Urlshortener.php';
  }
  function genGoogleLinkLogin(){
    // print_r($_SESSION);
    include_once LIB_PATH."ext/oauthen/google-api/examples/templates/base.php";

    set_include_path(LIB_PATH."ext/oauthen/google-api//src/" . PATH_SEPARATOR . get_include_path());
  
    require_once 'Google/Client.php';
  
    require_once 'Google/Service/Urlshortener.php';
  /************************************************
      ATTENTION: Fill in these values! Make sure
      the redirect URI is to this page, e.g:
      http://localhost:8080/user-example.php
    ************************************************/
    /*$client_id = '450177399430-oq2m198i59bfs585o244psideoln0cnm.apps.googleusercontent.com';
    $client_secret = 'BkODEiJ77oDZkuBtrHoxfmWz';
    $redirect_uri = 'http://ssac.edsup.org/oAuthenRedirect.php';
  */
    $client_id =get_system_config('googleAppID');
    $client_secret =get_system_config('googleAppSecret');
    $redirect_uri = site_url('oAuthenRedirect.php',true);
    
    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope(array('https://www.googleapis.com/auth/userinfo.profile','https://www.googleapis.com/auth/userinfo.profile'));
    $client->setScopes('email','profile');
    
    $service = new Google_Service_Urlshortener($client);
    
    if (isset($_REQUEST['logout'])) {
      unset($_SESSION['access_token']);
    }
    
    
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $client->setAccessToken($_SESSION['access_token']);
    } else {
      $authUrl = $client->createAuthUrl();
    }
    
    if ($client->getAccessToken() && isset($_GET['url'])) {
      $url = new Google_Service_Urlshortener_Url();
      $url->longUrl = $_GET['url'];
      $short = $service->url->insert($url);
      $_SESSION['access_token'] = $client->getAccessToken();
    }
    // print('55');
    
    if (isset($authUrl))
          return $authUrl;
  }