<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/



function signupPage()
{
    $createUser = new user();
    $user     = new stdClass();
    $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;
    if (!$user->id):
        require('view/auth/signupView.php');
    else:
        require('view/homeView.php');
    endif;

    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])) {
        if (strlen($_POST['password']) >= 8) {
            if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['password'])) {
                $email = $_POST['email'];
                $createUser->setEmail($email);

                $createUser->setPassword(User::myHash( $_POST['password'],$_POST['email']),User::myHash( $_POST['password_confirm'],$_POST['email']));

                $createUser->createUser();
            } else {
                echo "<script>alert('Veuillez avoir un mot de passe de minimum des chiffres et des lettres ')</script>";
            }
        } else {
            echo "<script>alert('Veuillez avoir un mot de passe de minimum 8 charactères ')</script>";
        }
    }
}



/***************************
* ----- SIGNUP FUNCTION -----
***************************/
