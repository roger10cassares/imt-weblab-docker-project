<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/nota.php';

require_once __DIR__.'/../classes/teste.php';

$user = new user();

$nota = new nota;

$teste = new teste;

$id_user = escape($user->data()->id_user);

$empresa = escape($user->data()->id_empresa);

if(isset($_GET["mediaCategoria"])){

   $values = $nota->mediaCategorias($id_user);
  
   echo json_encode($values);
}

if(isset($_GET["buscarAderencia"])){

   $value = $teste->contarTestes($empresa);
    
   $nTestes = $value[0]->countTestes;

   $value2 = $nota->contarNotas($id_user);

   $nNotas = $value2[0]->countNotas;

   echo (($nNotas/$nTestes)*100);
}

?> 