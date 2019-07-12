<?php
  load_fun('user');
  
  user_logoff();
  session_destroy();
  
  redirect(site_url(),true);
  ?>