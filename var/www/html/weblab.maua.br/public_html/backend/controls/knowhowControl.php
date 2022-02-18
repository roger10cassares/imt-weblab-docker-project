<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/categoria.php';

require_once __DIR__.'/../classes/teste.php';

require_once __DIR__.'/../classes/pergunta.php';

require_once __DIR__.'/../classes/nota.php';

$user = new user();

$id_user = escape($user->data()->id_user);

$empresa = escape($user->data()->id_empresa);

$teste = new teste;

$categoria = new categoria;

$pergunta = new pergunta;

$nota = new nota;

if(isset($_GET["load"])){

   $results = [];
   $notas = $categoria->carregarNotas($id_user);
   foreach($notas as $nota){
      array_push($results,$nota);
   }
   $zeros = $categoria->carregarNotasVazias($id_user);
   foreach($zeros as $zero){
      array_push($results,$zero);
   }
   
   echo json_encode($results);
  
}

if(isset($_GET["loadTestes"])){

   $values = $categoria->carregarPorEmpresa($empresa);

   $jsons = array();

   foreach($values as $values){
      
      $testes = $teste->carregarTeste($values->id_categoria);

      array_push($jsons,$testes);

   }
   
   echo json_encode($jsons);
   
}

if(isset($_GET["loadPerguntas"])){

   $values = $pergunta->carregarPergunta($_SESSION["idTesteUsuario"]);

   echo json_encode($values);  

}

if(isset($_GET["idUsuarioFeito"])){

   $values = $nota->buscarTestesFeitos($id_user);

   echo json_encode($values);
}

if(isset($_POST["reabrirGeral"])){

   $nota->reabrirGeral($empresa);
  
}

if(isset($_POST["reabrirSetor"])){

   $nota->reabrirSetor($_POST["reabrirSetor"]);
  
}

if(isset($_POST["reabrirUsuario"])){

   $nota->reabrirUsuario($_POST["reabrirUsuario"]);
  
}

?> 