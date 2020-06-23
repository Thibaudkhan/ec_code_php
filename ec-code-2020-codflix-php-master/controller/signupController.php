<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage() {



    $createUser = new user();
    $user     = new stdClass();

  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;


  if( !$user->id ):
    require('view/auth/signupView.php');
  else:
    require('view/homeView.php');
  endif;

  if(!empty($_POST['email']) && !empty($_POST['password']) ){
      $email = $_POST['email'];
      $password = $_POST['password'];
      $createUser->setEmail($email);
      $createUser->setPassword($password);
      $createUser->createUser();
  }else{
      echo "<script>alert('Veuillez compléter tous les champs')</script>";
  }

}



/***************************
* ----- SIGNUP FUNCTION -----
***************************/
