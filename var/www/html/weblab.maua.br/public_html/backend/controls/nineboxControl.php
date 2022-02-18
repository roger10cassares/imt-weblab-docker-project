<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/ninebox.php';

$user = new user();

$id_user = escape($user->data()->id_user);

$empresa = escape($user->data()->id_empresa);


$ninebox = new ninebox;

if(isset($_GET["load"])){

    $values = $ninebox->carregarNotas($id_user);

    if($values[0] < 3.5 && $values[1] < 3.5){

        echo 1;

    }

    if($values[0] < 7.5 && $values[0] > 3.5 && $values[1] < 3.5){

        echo 2;

    }

    if($values[0] < 3.5 && $values[1] < 7.5 && $values[1] > 3.5){

        echo 3;

    }

    if($values[0] > 7.5 && $values[1] < 3.5){

        echo 4;

    }

    if($values[0] < 3.5 && $values[1] > 7.5){

        echo 5;

    }

    if($values[0] < 7.5 && $values[0] > 3.5  && $values[1] < 7.5 && $values[1] > 3.5){

        echo 6;

    }

    if($values[0] < 7.5 && $values[0] > 3.5  && $values[1] > 7.5){

        echo 7;

    }

    if($values[0] > 7.5 && $values[1] < 7.5 && $values[1] > 3.5){

        echo 8;

    }

    if($values[0] > 7.5 && $values[1] > 7.5){

        echo 9;
        
    }

    
}

if(isset($_GET["carregarGraficoNinebox"])){
    
    $values = $ninebox->buscarMediasMes($id_user);
    $desempenho = [];
    $potencial = [];
    $datas = [];

    foreach($values as $val){

        array_push($potencial,$val->potencial);

        array_push($desempenho,$val->desempenho);

        array_push($datas,$val->data);

    }
    
    $arrReturn = [$desempenho,$potencial,$datas];

    echo json_encode($arrReturn);

}

if(isset($_POST["reabrirGeral"])){

    $ninebox->reabrirGeral($empresa);

}

if(isset($_POST["reabrirSetor"])){

    $ninebox->reabrirSetor($_POST["reabrirSetor"]);
   
}

 if(isset($_POST["reabrirUsuario"])){

    $ninebox->reabrirUsuario($_POST["reabrirUsuario"]);
   
}
 

?>