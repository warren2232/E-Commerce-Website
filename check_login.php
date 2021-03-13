<?php
    //Start session management
    session_start();
    
    if( array_key_exists("loggedInEmail", $_SESSION) ){
        echo "ok";
    }
    else{
        echo 'Not logged in.';
    }
