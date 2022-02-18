<?php

session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
      'host' => 'us-cdbr-iron-east-05.cleardb.net', //It is better than write localhost -> takes less time to load the page
      'username' => 'b6c5b1afbe641a',
      'password' => 'e4cfdf95',
      'db' => 'heroku_f5e54154b8b5fa5' //Refers to database
    ),
      'remember' => array( //This part is about cookies and remember user
        'cookie_name' => 'hash', //Maybe it won't be used
        'cookie_expiry' => 86400
      ),
      'session' => array( //Session issues solver
        'session_name' => 'user',
        'token_name' => 'token'
      )
  );

spl_autoload_register(function($class){

    require_once (__DIR__.'/../classes/main/' . $class . '.php');

});

require_once (__DIR__.'/../sanitize/sanitize.php');

?>