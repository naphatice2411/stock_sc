<?php
    if($user){
        $charset='utf8';
        $dbCon=mysqli_connect($host,$user,$password,$database);
        if(mysqli_connect_error())die("!Error : ".mysqli_connect_error());
        mysqli_set_charset($dbCon, $charset);
    }