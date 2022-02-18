<?php

require_once __DIR__.'/../core/init.php';

require_once __DIR__.'/../classes/todo.php';

$user = new user();

$id_user = escape($user->data()->id_user);

$todo = new todo;

if(isset($_GET['load'])){

  $values = $todo->loadToDo($id_user);

  echo json_encode($values);

}
if(isset($_POST['addToDo'])){
  
  $values = $todo->inserirToDo($id_user,$_POST['addToDo']);

  echo json_encode($values);

}

if(isset($_POST['delToDo'])){

  $todo->deletarToDo($_POST['delToDo']);

}

if(isset($_POST['idCheck'])){

  echo $todo->marcarToDo($_POST['idCheck'],$_POST['isChecked']);
  
}

?>