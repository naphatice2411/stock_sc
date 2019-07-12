<?php

        load_fun("google");
        googleINI();
        print genGoogleLinkLogin();
        
        //googleINI();
        ?>
        <a class="btn btn-default" href="<?php print genGoogleLinkLogin(); ?>"><i class="fa fa-play"></i></a>