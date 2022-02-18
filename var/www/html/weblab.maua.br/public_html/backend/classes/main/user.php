<?php


class user{

  private $_db,
          $_data,
          $_sessionName,
          $_cookieName,
          $_isLoggedIn;

  function __construct($user = null){

      $this->_db = new db;

      $this->_sessionName = config::get('session/session_name');

      if (!$user) {

          if (session::exists($this->_sessionName)) {

              $user = session::get($this->_sessionName);

              if ($this->find($user)) {

                  $this->_isLoggedIn = true;
              }

              else {

              }

          }

      }

      else {
          
          $this->find($user);
      }

  }

  public function find($user = null){
      
    $this->_db->select("user", NULL, array("email_user = '".$user."'"));



    if($this->_db->count()){

      $data = $this->_db->getresults();
      
      $this->_data = $data[0];

      return true;

    }


    return false;

  }

  public function login($email_user = null, $senha_user = null){

    $user = $this->find($email_user);
    
    if ($user) {

      if($this->data()->senha_user === hash::make($senha_user, $this->data()->salt_user)){

        session::put($this->_sessionName, $this->data()->email_user);

        if ($remember) {

          $hash = hash::unique();

          $hashCheck = $this->_db->select('tb_session', NULL, array('mat_user = '.$this->data()->mat_session));

          if (!$hashCheck->count()) {

            $this->_db->insert('tb_session',array('email_user' => $this->data()->mat_session, 'hash_session' => $hash));

          }

          else {

            $hash = $hashCheck->first()->hash;

          }

          cookie::put($this->_cookieName, $hash, config::get('remember/cookie_expiry'));

        }
        return true;

      }

    }

    return false;

  }

  public function logout(){

    session::delete($this->_sessionName);

  }

  public function data(){

    return $this->_data;

  }

  public function isLoggedIn(){

    return $this->_isLoggedIn;

  }

} 

?>