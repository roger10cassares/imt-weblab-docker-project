<?php

require_once 'backend/core/init.php';
$user = new user();

if (!$user->isLoggedIn()) {
  redirect::to('login.php');
}

?>