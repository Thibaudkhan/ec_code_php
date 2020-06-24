<?php
require_once( 'model/user.php' );

function showProfilePage(){
    $email =  $_SESSION['user_email'];
    require('view/auth/profileView.php');
}

function deleteUser(){
    if(!empty($_POST['confirmPassword'])){
        $user = new User();
        $pass = $_POST['confirmPassword'];
        if(User::myHash($pass,$_SESSION['user_email']) == $_SESSION['user_password']){
            $user->deleteUser();
        }
    }
}

function changePassword(){
    $user = new User();
    $message= "";
    $user_email =  $_SESSION['user_email'];
    if(!empty($_POST['newPass']) && !empty($_POST['newPass2']) && !empty($_POST['oldPass'])){
        $newPass = $_POST['newPass'];
        $newPass2 = $_POST['newPass2'];
        $oldPass = $_POST['oldPass'];
    }else{
        exit();
    }


    //echo " pass ". $_SESSION['user_password'];

    if(User::myHash($oldPass,$user_email) == $_SESSION['user_password']){
        if( $newPass == $newPass2){
                $user->changeProfile("Update user SET password =? Where id = ?",User::myHash($newPass,$user_email));
        }else{
            $message = "Les mots de passe ne correspondent pas .";
        }
    }else{
        $message = "Ce n'est pas l'ancien mot de pass.";
    }

    echo $message;

}

function changeEmail(){
    $user = new User();
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
        $user->changeProfile("Update user SET email =? Where id = ?",$email);

    }
}