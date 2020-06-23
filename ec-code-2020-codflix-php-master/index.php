<?php

require_once( 'controller/homeController.php' );
require_once( 'controller/loginController.php' );
require_once( 'controller/signupController.php' );
require_once( 'controller/mediaController.php' );
require_once( 'controller/historicController.php' );

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
      if(isset( $_GET['media'])){
          $media = new MediaController();
            // call function to see more details
          $media->showMoreDetails( $_GET['media']);

      }else if(isset( $_GET['redirect'])){
          switch( $_GET['redirect']):

              case 'index':
                  mediaPage();
              break;

              case 'historic':
                  showHistoric();

                  require('view/historicView.php');
              break;

          endswitch;
      }else if( isset($_GET['deleteHistoric'])){
          deleteHistoric($_GET['deleteHistoric']);
      }
      else{
          mediaPage();
      }
  else:
    homePage();
  endif;

endif;
