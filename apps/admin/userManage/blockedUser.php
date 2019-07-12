<?php
    $title='จัดการผู้ใช้ที่ถูกบล็อก';
    $subtitle=$hGET['type'];
    load_fun('box');
    $userData=selectTb('userdata','*','active="B"');
    print genSocialWidgets($userData);
    