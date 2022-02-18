<?php

    require_once __DIR__.'/../core/init.php';

    require_once __DIR__.'/../classes/modulo.php';

    $modulo = new modulo;
    
    if(isset($_POST['nomeModulo'])){
        $values = $modulo->adicionarModulo($_POST['nomeModulo'],$_POST['numModulo'],$_SESSION['idCurso']);
        echo json_encode($values);
    }

    if(isset($_GET['carregarModulos'])){
        $values = $modulo->carregarModulos($_SESSION['idCurso']);
        echo json_encode($values);
    }

    if(isset($_POST['deletarModulo'])){
        $values = $modulo->deletarModulo($_POST['deletarModulo']);
    }

    if(isset($_POST['EscolherModulo'])){
        $_SESSION['idModulo'] = $_POST['EscolherModulo'];
    }
?>
