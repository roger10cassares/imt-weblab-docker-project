<?php

    require_once __DIR__.'/../core/init.php';

    require_once __DIR__.'/../classes/curso.php';

    $user = new user();

    $curso = new curso;

    $idEmpresa = escape($user->data()->id_empresa);
    
    if(isset($_POST['nomeCurso'])){
        $values = $curso->adicionarCurso($_POST['nomeCurso'],$_POST['descCurso'],$idEmpresa);
        echo json_encode($values);
    }

    if(isset($_GET['carregarCursos'])){
        $values = $curso->carregarCursos($idEmpresa);
        echo json_encode($values);
    }

    if(isset($_POST['deletarCurso'])){
        $values = $curso->deletarCurso($_POST['deletarCurso']);
    }

    if(isset($_POST['escolherCurso'])){
        $_SESSION['idCurso'] = $_POST['escolherCurso'];
    }

?>
