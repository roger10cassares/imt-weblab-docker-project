<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/aval360.php';

require_once __DIR__.'/../classes/usuario.php';

$user = new user();

$id_user = escape($user->data()->id_user);

$empresa = escape($user->data()->id_empresa);

$usuario = new usuario;

$aval360 = new aval360;

if(isset($_GET["load"])){

    $values = $aval360->carregarNotas($id_user);
  
    echo json_encode($values);
  
}

if(isset($_GET["carregarGraficoAval360"])){

    $values = $aval360->buscarMedias($id_user);

    echo json_encode($values);

}

if(isset($_POST["reabrirGeral"])){

    $aval360->reabrirNotas($empresa);
   
}

if(isset($_POST["reabrirSetor"])){

    $aval360->reabrirSetor($_POST["reabrirSetor"]);
   
}

if(isset($_POST["reabrirUsuario"])){

    $aval360->reabrirUsuario($_POST["reabrirUsuario"]);
   
}

if(isset($_POST["enviarTeste"])){

    $val = $usuario->buscarPosicao($_SESSION['idAvalUsuario']);
    
    $val2 = $usuario->buscarPosicao(escape($user->data()->id_user));
    
    $posAvaliador = $val2->pos_cargo;
    $tipoAvaliador = $val2->tipo_cargo;

    if($tipoAvaliado == 1 && $tipoAvaliador>1){

        $posRelativa = 1;

    }
    else{
        if($posAvaliador > $posAvaliado){

            $posRelativa = 1;

        }
        else if($posAvaliador == $posAvaliado){

            $posRelativa = 2;

        }
        else{

            $posRelativa = 3;

        }
    }

    $nota = 0;
    
    for($i=1;$i<=3;$i++){

        $nota += $_POST["r".$i];

    }

    $media = $nota/3;



    $aval360->adicionarAval360($_SESSION['idAvalUsuario'],escape($user->data()->id_user),$posRelativa,$media);

}
?>