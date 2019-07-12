<?php
  load_fun('oauthen');
  load_fun('user');
/*

 * Copyright 2011 Google Inc.

 *

 * Licensed under the Apache License, Version 2.0 (the "License");

 * you may not use this file except in compliance with the License.

 * You may obtain a copy of the License at

 *

 *     http://www.apache.org/licenses/LICENSE-2.0

 *

 * Unless required by applicable law or agreed to in writing, software

 * distributed under the License is distributed on an "AS IS" BASIS,

 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.

 * See the License for the specific language governing permissions and

 * limitations under the License.

 */

include_once BASE_PATH."system/library/ext/oauthen/google-api/examples/templates/base.php";

set_include_path(BASE_PATH."system/library/ext/oauthen/google-api/src/" . PATH_SEPARATOR . get_include_path());

require_once 'Google/Client.php';

require_once 'Google/Service/Urlshortener.php';
require_once 'Google/Service/Plus.php';

/************************************************

  ATTENTION: Fill in these values! Make sure

  the redirect URI is to this page, e.g:

  http://localhost:8080/user-example.php

 ************************************************/

  //$client_id = '825335543520-rn8rphfm5s31qteovqghs8hu5pv6ferl.apps.googleusercontent.com';

  //$client_secret = 'fQCi9VGuZFOiKtP4scpxFr9d';

$client_id=get_system_config('googleAppID');

$client_secret=get_system_config('googleAppSecret');

$redirect_uri = site_url('oAuthenRedirect.php',true);

/************************************************

  Make an API request on behalf of a user. In

  this case we need to have a valid OAuth 2.0

  token for the user, so we need to send them

  through a login flow. To do this we need some

  information from our API console project.

 ************************************************/



$client = new Google_Client();

$client->setClientId($client_id);

$client->setClientSecret($client_secret);

$client->setRedirectUri($redirect_uri);

$client->setScopes([
  "email","profile"
]);

/************************************************

  When we create the service here, we pass the

  client to it. The client then queries the service

  for the required scopes, and uses that when

  generating the authentication URL later.

 ************************************************/

$service = new Google_Service_Urlshortener($client);
$plusService=new Google_Service_Plus($client);
$people=$plusService->people;

/************************************************

  If we're logging out we just need to clear our

  local access token in this case

 ************************************************/

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
}

if (isset($_SESSION['google_code'])) {
  // print('555');
  // print_r($_SESSION);exit;
  $client->authenticate($_SESSION['google_code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = site_url();
  $time_logon=60*60*8;
  $_SESSION['access_token'] = $client->getAccessToken();
  $token_data = $client->verifyIdToken()->getAttributes();
  $google_data_token=json_encode($token_data);
  $google_data=json_decode($google_data_token);
  print_r($google_data);
  // exit();
  $gmail=$google_data->payload->email;
  $_SESSION['google_data']=$google_data;
  $google_username=explode("@",$gmail);
  $screen_name=$google_username[0];
  $chkAlreadyExists=chk_exists_acount('google',$gmail);
  // print $chkAlreadyExists;
  // exit;
  if(!$chkAlreadyExists){//ถ้าไม่มีข้อมูลที่เคยจับคู่ไว้ให้เพิ่มผู้ใช้
    $accession=json_encode(array(''));
    $name=$google_username[0];
    $user_data=array(
      "username"=>$gmail,
      "name"=>$name,
      "surname"=>'',
      "mobile"=>'',
      "email"=>$gmail,
      "password"=>rand(00000000,99999999),
      'accession'=>$accession,
      'active'=>'Y',
      'default_uri'=>'main/home/profile/contactAdmin',
    );
    $user_id=add_user($user_data);
    $pairUser=pair_user_oauthen('google',$gmail,$user_id,json_encode($google_data));
    //print_r ($pairUser);
  }else{
    $userData=oauthen_check_login('google',$gmail);
    // print_r($userData);
    $user_id=$userData['user_id'];
    // print($user_id); exit;
  }
  // print $user_id; exit;
  signInUser($user_id);
}



/************************************************

  If we have an access token, we can make

  requests, else we generate an authentication URL.

 ************************************************/

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}



/************************************************

  If we're signed in and have a request to shorten

  a URL, then we create a new URL object, set the

  unshortened URL, and call the 'insert' method on

  the 'url' resource. Note that we re-store the

  access_token bundle, just in case anything

  changed during the request - the main thing that

  might happen here is the access token itself is

  refreshed if the application has offline access.

 ************************************************/

    

