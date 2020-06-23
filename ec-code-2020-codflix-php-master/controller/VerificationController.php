<?php
require_once( '../model/database.php' );

    if(isset($_GET['user_key'])){
        $db   = init_db();
        $user_key = $_GET['user_key'];
        $req  = $db->prepare( "Update user set user_confirmed=? Where user_key=? " );
        $req->execute([1,$user_key]);

        // Close databse connection
        $db   = null;
        header('location:../view/auth/VerificationView.php');
    }