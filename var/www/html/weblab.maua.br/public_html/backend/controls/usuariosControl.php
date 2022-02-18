<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/usuario.php';


$user = new user();

$usuario = new usuario();

$validate = new validate();

$empresaUser = escape($user->data()->id_empresa);

$idUser = escape($user->data()->id_user);

if(isset($_GET['carregarUsuariosEmpresa'])){

  $val = $usuario->carregarUsuariosEmpresa($empresaUser,$idUser);

  echo json_encode($val);

}

if(isset($_GET['carregarUsuariosSetor'])){

  $val = $usuario->carregarUsuariosSetor($_GET['carregarUsuariosSetor'],$idUser);

  echo json_encode($val);

}

if(isset($_GET['carregarUsuariosCargo'])){

  $val = $usuario->carregarUsuariosCargo($_GET['carregarUsuariosCargo'],$idUser);

  echo json_encode($val);

}

if(isset($_GET['carregarUsuarioId'])){

  $val = $usuario->carregarUsuarioId($_GET['carregarUsuarioId']);

  echo json_encode($val[0]);

}


if(isset($_POST['nomeUsuario'])){

  $validation = $validate->check($_POST, array(
    'matUsuario' => array(
    'required' => true,
    'min' => 10,
    'max' => 10
    ),
    'nomeUsuario' => array(
    'required' => true,
    'max' => 60,
    'min' => 2
    ),
    'cargoUsuario' => array(
    'required' => true,
    'max' => 100
    ),
    'setorUsuario' => array(
    'required' => true,
    'max' => 100
    ),
    'senhaUsuario' => array(
    'required' => true,
    'min' => 6
    ),
    'emailUsuario' => array(
    'required' => true,
    'contains' => '@'
    )
));

  if($validation->passed()) {


    $salt = hash::salt(32);

    $senha = hash::make($_POST['senhaUsuario'],$salt);

    $values = $usuario->adicionarUsuario($_POST['emailUsuario'],$_POST['matUsuario'],$_POST['nomeUsuario'],$_POST['setorUsuario'],$_POST['cargoUsuario'],$senha,$salt,$empresaUser,$_POST['admUsuario']);

    echo json_encode($values);

  }

}

if(isset($_POST['delUsuario'])){

  $usuario->deletarUsuario($_POST['delUsuario']);
}

if(isset($_POST['atualizarDados'])){

  $usuario->alterarDadosUsuario($_POST['atualizarDados'],$_POST['editarNome'],$_POST['editarEmail'],$_POST['editarMat'],$_POST['editarCargo'],$_POST['editarSetor'],$_POST['editarSenha']);

}
?>