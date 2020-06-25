<?php
require_once( 'model/user.php' );

function showProfilePage(){
    $email =  $_SESSION['user_email'];
    require('view/auth/profileView.php');
}
/*
 * @arg Get the email and password form
 * Check if the current password are the right and call delete user function
 */
function deleteUser(){
    if(!empty($_POST['confirmPassword'])){
        $user = new User();
        $pass = $_POST['confirmPassword'];
        if(User::myHash($pass,$_SESSION['user_email']) == $_SESSION['user_password']){
            $user->deleteUser();
        }
    }require('view/auth/profileView.php');
}

/*
 * @param Get the email and the password
 * Check if the current password and the write are the right and some other verification
 * Call the password change function
 */
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
    require('view/auth/profileView.php');
}

/*
 * @arg Get the email field
 * Write de new email calling a function
 */
function changeEmail(){
    $user = new User();
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
        $user->changeProfile("Update user SET email =? Where id = ?",$email);
    }
    require('view/auth/profileView.php');
}
