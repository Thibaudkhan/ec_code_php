<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

/*
 * * Allow the sign up calling creatUser method. signupPage function check if the password
 *  have more than 7 characters and if it have numbers and letter. He crypt
 * the password with first a sha256  for the password and ripemd256 reverted for
 * the mail next too they are concatenated and give a single sha512 password.
 *
 */

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

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        if (strlen($_POST['password']) >= 8) {
            if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['password'])) {
                $email = $_POST['email'];
                $createUser->setEmail($email);
                $createUser->setPassword(hash('sha512',hash('sha256', $_POST['password']) . strrev(hash('ripemd256', $_POST['email']))));
                $createUser->createUser();
            } else {
                echo "<script>alert('Veuillez avoir un mot de passe de minimum des chiffres et des lettres ')</script>";
            }
        } else {
            echo "<script>alert('Veuillez avoir un mot de passe de minimum 8 charactères ')</script>";
        }

    } else {
        echo "<script>alert('Veuillez compléter tous les champs')</script>";
    }
}



/***************************
* ----- SIGNUP FUNCTION -----
***************************/
