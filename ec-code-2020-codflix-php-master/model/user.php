<?php

require_once( 'database.php' );



class User {


  protected $id;
  protected $email;
  protected $password;
  protected $user_confirmed;
  protected $user_key ;


  public function __construct( $user = null ) {

    if( $user != null ):
      $this->setId( isset( $user->id ) ? $user->id : null );
      $this->setEmail( $user->email );
      $this->setPassword( $user->password, isset( $user->password_confirm ) ? $user->password_confirm : false );
    endif;
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setEmail( $email ) {

    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)):
      throw new Exception( 'Email incorrect' );
    endif;

    $this->email = $email;

  }

  public function setPassword( $password, $password_confirm = false ) {

    if( $password_confirm && $password != $password_confirm ):
      throw new Exception( 'Vos mots de passes sont différents' );
    endif;

    $this->password = $password;
  }

    /**
     * @param mixed $user_key
     */


    /**
     * @param mixed $user_confirmed
     */
    public function setUserConfirmed($user_confirmed)
    {
        $this->user_confirmed = $user_confirmed;
    }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }


    /**
     * @return mixed
     */
    public function getUserConfirmed()
    {
        return $this->user_confirmed;
    }



  /***********************************
  * -------- CREATE NEW USER ---------
  ************************************/

  public function createUser() {

    // Open database connection
    $db   = init_db();
    $user_key = md5(uniqid(mt_rand()));

    // Check if email already exist
    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ) );

    if( $req->rowCount() > 0 ) throw new Exception( "Email ou mot de passe incorrect" );

    // Insert new user
    $req->closeCursor();

    $req  = $db->prepare( "INSERT INTO user ( email, password, user_key,user_confirmed ) VALUES ( ?,?,?,? )" );
    $req->execute([$this->getEmail(),$this->getPassword(),$user_key,0]);
      $this->emailConfirmation($user_key);
    // Close databse connection
    $db = null;

  }

  /**************************************
  * -------- GET USER DATA BY ID --------
  ***************************************/

  public static function getUserById( $id ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE id = ?" );
    $req->execute( array( $id ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

  /***************************************
  * ------- GET USER DATA BY EMAIL -------
  ****************************************/

  public function getUserByEmail() {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE user_confirmed = 1 && email = ?" );
    $req->execute( array( $this->getEmail()));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }


    /**
     * @param $the_key
     */
    public function emailConfirmation($the_key)
  {
      $eol = PHP_EOL;
      $uid = md5(uniqid(time()));

      $to      = $this->getEmail();
      $subject = 'Confirmer votre email';
      $message = <<<EOT
<html>
<body>
<h1>Bonjour, Veuillez confirmer votre compte codflex</h1>
<a href="http://localhost/Coding/Ec_code/ec_code_php/ec-code-2020-codflix-php-master/controller/VerificationController.php?user_key=$the_key">Clique connard</a>
</body>
</html>
EOT;
      $header = "From: codflix <coding@gmail.com>".$eol;
      $header .= "Reply-To: ".$this->getEmail().$eol;
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";


      mail($to, $subject, $message, $header);
      echo "<script>alert('Vous avez reçu un emal de confirmation')</script>";
  }






}
