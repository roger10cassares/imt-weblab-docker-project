<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/setor.php';

require_once __DIR__.'/../classes/cargo.php';

$user = new user();

$setor = new setor;

$cargo = new cargo;

$empresa = escape($user->data()->id_empresa);    

if(isset($_POST["nomeSetor"])){

    $values = $setor->adicionarSetor($empresa, $_POST["nomeSetor"]);

    echo json_encode($values); 

}

if(isset($_GET["loadSetores"])){

    $values = $setor->carregarSetores($empresa);

    echo json_encode($values);

}

if(isset($_POST["nomeCargo"])){

    if($_POST["nomeCargo"] != ""){

        $posCargo = $cargo->buscarPosicaoCargos($_POST["idSetor"],1);

        for($i=0;$i<sizeof($_POST["nomeCargo"]);$i++){

            if($_POST["nomeCargo"][$i] != ""){

                $values = $cargo->adicionarCargo($_POST["idSetor"],$_POST["nomeCargo"][$i],$_POST["descCargo"][$i],($posCargo+$i+1),1);

            }
        }
    }

    if($_POST["nomeCargoG"] != ""){

        $posCargoG = $cargo->buscarPosicaoCargos($_POST["idSetor"],2);

        for($i=0;$i<sizeof($_POST["nomeCargoG"]);$i++){

            if($_POST["nomeCargoG"][$i] != ""){

                $values = $cargo->adicionarCargo($_POST["idSetor"],$_POST["nomeCargoG"][$i],$_POST["descCargoG"][$i],($posCargoG+$i+1),2);

            }

        }
    }

    if($_POST["nomeCargoE"] != ""){

        $posCargoE = $cargo->buscarPosicaoCargos($_POST["idSetor"],3);

        for($i=0;$i<sizeof($_POST["nomeCargoE"]);$i++){

            if($_POST["nomeCargoE"][$i] != ""){

                $values = $cargo->adicionarCargo($_POST["idSetor"],$_POST["nomeCargoE"][$i],$_POST["descCargoE"][$i],($posCargoE+$i+1),3);

            }

        }
    }
}

if(isset($_GET["loadCargos"])){

    $values = $cargo->carregarCargos($_GET["loadCargos"]);

    echo json_encode($values);

}

if(isset($_POST["delCargo"])){

    $cargo->deletarCargo($_POST["delCargo"]);

}


?>