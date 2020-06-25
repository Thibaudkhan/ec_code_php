<?php

require_once( 'controller/homeController.php' );
require_once( 'controller/loginController.php' );
require_once( 'controller/signupController.php' );
require_once( 'controller/mediaController.php' );
require_once( 'controller/historicController.php' );
require_once( 'controller/FilterController.php' );
require_once( 'controller/contactController.php' );
require_once( 'controller/profileController.php' );

/**************************
* ----- HANDLE ACTION -----
***************************/

if ( isset( $_GET['action'] ) ):

  switch( $_GET['action']):

    case 'login':

      if ( !empty( $_POST ) ) login( $_POST );
      else loginPage();

    break;

    case 'signup':

      signupPage();

    break;

    case 'logout':

      logout();

    break;



  endswitch;

else:

  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( $user_id ):
      if(isset( $_GET['detailMedia'])){
          $media = new MediaController();
            // call function to see more details
          $media->showMoreDetails( $_GET['detailMedia']);

      }elseif (isset( $_GET['media'])){
          $media = new MediaController();

          $media->watchEpisode($_GET['media']);

      }
      else if(isset( $_GET['redirect'])){
          switch( $_GET['redirect']):

              case 'index':
                  mediaPage();
              break;

              case 'contact':
                  showContact();
              break;

              case 'historic':
                  showHistoric();

              break;

              case 'profile':
                  showProfilePage();

              break;

          endswitch;
      }else if( isset($_GET['deleteHistoric'])){
          deleteHistoric($_GET['deleteHistoric']);
      }else if(isset( $_GET['filter'])){
          switch( $_GET['filter']):

              case 'ascSearch':
                  resultFitlerAsc();
                  break;

              case 'searchSeason':
                  chooseSeason();
                  break;

          endswitch;
      }else if(isset( $_GET['historic'])){
          switch( $_GET['historic']):

              case 'saveTime':
                  insertCurrentTimeWatching();
                  break;


          endswitch;
      }else if(isset($_GET['sendMail'])){
          sendMail();
      }else if(isset($_GET['changeProfile'])){
          switch( $_GET['changeProfile']):

              case 'changePassword':
                  changePassword();
                  break;


              case 'changeEmail':
                  changeEmail();
                  break;

              case 'deleteAccount':
                  deleteUser();

                  break;

          endswitch;
      }
      else{
          mediaPage();
      }
  else:
    homePage();
  endif;

endif;

