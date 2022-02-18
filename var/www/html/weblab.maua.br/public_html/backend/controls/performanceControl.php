<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/setor.php';

require_once __DIR__.'/../classes/cargo.php';

$user = new user();

$setor = new setor;

$cargo = new cargo;

$empresa = escape($user->data()->id_empresa);

if(isset($_GET["loadSetores"])){

    $values = $setor->carregarSetores($empresa);

    echo json_encode($values);

}

if(isset($_GET["loadCargos"])){

    $values = $cargo->carregarCargos($_GET["loadCargos"]);

    echo json_encode($values);

}

?>