<?php

    $title='จัดการผู้ใช้';

    $subtitle=ucfirst($hGET['type']);

    

    load_fun('box');

    

    $userData=selectTb('userdata','*','user_type="'.$hGET['type'].'" and active="Y"');

//    print_r($userData);

    print genSocialWidgets($userData);