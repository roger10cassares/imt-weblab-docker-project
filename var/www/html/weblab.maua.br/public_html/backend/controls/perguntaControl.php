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

//Adiciona Pergunta
if(isset($_POST["textPergunta"])){

    //$val = $validacao->check($_POST, array('textPergunta' => array('required' => true, 'quantidade' => array('altA','altB','altC','altD')), 'resp' => array('required' => true)));

    //if($val->passed()){

        $values = $pergunta->adicionarPergunta($_POST["idTest"],$_POST["textPergunta"],$_POST["altA"],$_POST["altB"],$_POST["altC"],$_POST["altD"],$_POST["resp"]);
        echo json_encode($values); 
        
    //}   

}

//Carrega Perguntas por id do Teste (SESSION)
if(isset($_GET["loadPergunta"])){

    $values = $pergunta->carregarPergunta($_GET["loadPergunta"]);
 
    echo json_encode($values);  

}

//Deleta Pergunta
if(isset($_POST["delPergunta"])){

    $pergunta->deletarPergunta($_POST["delPergunta"]);

}


?>