<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/ninebox.php';

require_once __DIR__.'/../classes/aval360.php';

require_once __DIR__.'/../classes/nota.php';

require_once __DIR__.'/../classes/teste.php';

require_once __DIR__.'/../classes/usuario.php';

$user = new user();

$id_user = escape($user->data()->id_user);

$empresa = escape($user->data()->id_empresa);

$ninebox = new ninebox;

$aval360 = new aval360;

$nota = new nota;

$teste = new teste;

$usuario = new usuario;

if(isset($_POST["reabrirKnowhowSetor"])){

   $nota->reabrirSetor($_POST["reabrirKnowhowSetor"]);
  
}

if(isset($_POST["enviarNotaKnowhow"])){
    
    $idCategoria = $teste->buscarCategoria($_SESSION['idTesteUsuario']);

    $nota->adicionarNotaKnowhow(escape($user->data()->id_user), $idCategoria, $_SESSION['idTesteUsuario'], round($_POST["enviarNotaKnowhow"],1));

    unset($_SESSION['idTesteUsuario']);

}

if(isset($_POST["enviarNotaAval360"])){
    
    
    $val = $usuario->buscarPosicao($_SESSION['idAvalUsuario']);

    $posAvaliado = $val->pos_cargo;
    $tipoAvaliado = $val->tipo_cargo;

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

    $aval360->adicionarAval360($_SESSION['idAvalUsuario'],escape($user->data()->id_user),$posRelativa,round($_POST["enviarNotaAval360"],1));

    unset($_SESSION['idAvalUsuario']);

}

if(isset($_POST["enviarNotaNinebox"])){
    
    $ninebox->adicionarNinebox($_SESSION['idNBUsuario'],escape($user->data()->id_user),$_POST["enviarNotaNinebox"],$_POST["enviarNotaNinebox"]);
    
    unset($_SESSION['idNBUsuario']);

}



?> 