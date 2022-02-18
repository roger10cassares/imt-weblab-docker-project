<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/categoria.php';

require_once __DIR__.'/../classes/teste.php';

require_once __DIR__.'/../classes/pergunta.php';

require_once __DIR__.'/../classes/nota.php';

$user = new user();

$id_user = escape($user->data()->id_user);

$empresa = escape($user->data()->id_empresa);

$setor = escape($user->data()->id_setor);

$teste = new teste;

$categoria = new categoria;

$pergunta = new pergunta;

$nota = new nota;

if(isset($_GET["analiseNotas"])){

   $values = $nota->analiseNotas($id_user,$_SESSION["idAnalise"]);
  
   echo json_encode($values);
}

if(isset($_GET["graficoMediaSetor"])){

   $mes1 = [];
   $mes2 = [];
   $mes3 = [];
   $mes4 = [];
   $mes5 = [];
   $mes6 = [];

   $mes1S = [];
   $mes2S = [];
   $mes3S = [];
   $mes4S = [];
   $mes5S = [];
   $mes6S = [];

   $data1 = date('Y-m-d', strtotime((date("Y/m/d"). ' - 5 months')));
   $data2 = date('Y-m-d', strtotime((date("Y/m/d"). ' - 4 months')));
   $data3 = date('Y-m-d', strtotime((date("Y/m/d"). ' - 3 months')));
   $data4 = date('Y-m-d', strtotime((date("Y/m/d"). ' - 2 months')));
   $data5 = date('Y-m-d', strtotime((date("Y/m/d"). ' - 1 months')));
   $data6 = date('Y-m-d');

   $valuesUser = $nota->buscarMediasMes($id_user,$_SESSION["idAnalise"]);

   $valuesSetor = $nota->buscarMediasMesSetor($setor,$_SESSION["idAnalise"]);

   for($i=0;$i<sizeof($valuesUser);$i++){
      if($valuesUser[$i]->data <= $data1){
         array_push($mes1,$valuesUser[$i]->nota);
      }

      if($valuesUser[$i]->data <= $data2){
         array_push($mes2,$valuesUser[$i]->nota);
      }

      if($valuesUser[$i]->data <= $data3){
         array_push($mes3,$valuesUser[$i]->nota);
      }

      if($valuesUser[$i]->data <= $data4){
         array_push($mes4,$valuesUser[$i]->nota);
      }

      if($valuesUser[$i]->data <= $data5){
         array_push($mes5,$valuesUser[$i]->nota);
      }

      if($valuesUser[$i]->data <= $data6){
         array_push($mes6,$valuesUser[$i]->nota);
      }    
   }

   for($i=0;$i<sizeof($valuesSetor);$i++){
      if($valuesSetor[$i]->data <= $data1){
         array_push($mes1S,$valuesSetor[$i]->nota);
      }

      if($valuesSetor[$i]->data <= $data2){
         array_push($mes2S,$valuesSetor[$i]->nota);
      }

      if($valuesSetor[$i]->data <= $data3){
         array_push($mes3S,$valuesSetor[$i]->nota);
      }

      if($valuesSetor[$i]->data <= $data4){
         array_push($mes4S,$valuesSetor[$i]->nota);
      }

      if($valuesSetor[$i]->data <= $data5){
         array_push($mes5S,$valuesSetor[$i]->nota);
      }

      if($valuesSetor[$i]->data <= $data6){
         array_push($mes6S,$valuesSetor[$i]->nota);
      }    
   }
   if(count($mes1))
      $med1 = array_sum($mes1)/count($mes1);
   else
      $med1 = 0;
   
   if(count($mes2))
      $med2 = array_sum($mes2)/count($mes2);
   else
      $med2 = 0;
   if(count($mes3))
      $med3 = array_sum($mes3)/count($mes3);
   else
      $med3 = 0;
   
   if(count($mes4))
      $med4 = array_sum($mes4)/count($mes4);
   else
      $med4 = 0;
      if(count($mes5))
      $med5 = array_sum($mes5)/count($mes5);
   else
      $med5 = 0;
   
   if(count($mes6))
      $med6 = array_sum($mes6)/count($mes6);
   else
      $med6 = 0;

      if(count($mes1S))
      $med1S = array_sum($mes1S)/count($mes1S);
   else
      $med1S = 0;
   
   if(count($mes2S))
      $med2S = array_sum($mes2S)/count($mes2S);
   else
      $med2S = 0;
   if(count($mes3S))
      $med3S = array_sum($mes3S)/count($mes3S);
   else
      $med3S = 0;
   
   if(count($mes4S))
      $med4S = array_sum($mes4S)/count($mes4S);
   else
      $med4S = 0;
      if(count($mes5S))
      $med5S = array_sum($mes5S)/count($mes5S);
   else
      $med5S = 0;
   
   if(count($mes6S))
      $med6S= array_sum($mes6S)/count($mes6S);
   else
      $med6S = 0;
   
   echo json_encode([[$med1,$med2,$med3,$med4,$med5,$med6],[$med1S,$med2S,$med3S,$med4S,$med5S,$med6S],[$data1,$data2,$data3,$data4,$data5,$data6]]);
   //echo json_encode([count($mes1S),count($mes2S),count($mes3S),count($mes4S),count($mes5S),count($mes6S)]);
   //echo json_encode([$med1,$med2,$med3,$med4,$med5,$med6]);
}  

?> 