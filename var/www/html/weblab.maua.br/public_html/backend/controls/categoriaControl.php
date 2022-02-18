<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/categoria.php';

require_once __DIR__.'/../classes/teste.php';

require_once __DIR__.'/../classes/pergunta.php';

$user = new user();

$categoria = new categoria;

$teste = new teste;

$pergunta = new pergunta;

$validacao = new validate;


$empresa = escape($user->data()->id_empresa);    


//Carrega Categorias
if(isset($_GET["loadCategoria"])){

    $values = $categoria->carregarPorEmpresa($empresa);

    echo json_encode($values);

}

//Adiciona Categoria
if(isset($_POST["nomeCategoria"])){

    $values = $categoria->adicionarCategoria($empresa, $_POST["nomeCategoria"], $_POST["descCategoria"],'foto');

    echo json_encode($values); 

}

//Deleta Categoria
if(isset($_POST["delCategoria"])){

    $categoria->deletarCategoria($_POST["delCategoria"]);

}

//Carrega Testes por id da Categoria
if(isset($_GET["loadTeste"])){

    $values = $teste->carregarTeste($_GET["loadTeste"]);

    $_SESSION["idCategoria"] = $_GET["loadTeste"];

    echo json_encode($values);  

}

//Adiciona Teste
if(isset($_POST["nomeTeste"])){

    $values = $teste->adicionarTeste($_SESSION["idCategoria"],$_POST["nomeTeste"],$_POST["descTeste"],"css/css-img/standard2.jpg");
    echo json_encode($values);

}

//Deleta Teste
if(isset($_POST["delTeste"])){

    $teste->deletarTeste($_POST["delTeste"]);

}


?>