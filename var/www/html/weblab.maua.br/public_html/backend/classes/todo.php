<?php

class todo{

  private $_db;

  public function __construct(){
    
    $this->_db = new db;

  }

  public function loadToDo($id){

    $where = ["id_user = '".$id."'"];

    $this->_db->select("todo",NULL,$where);

    return $this->_db->getResults();

  }

  public function inserirToDo($id_user, $texto){

    $data = ["id_todo"=>"NULL","id_user"=>$id_user,"text_todo"=>"'".$texto."'","marked_todo"=>"0"];

    $this->_db->insert("todo",$data);

    return $this->ultimoToDo();

  }

  public function ultimoToDo(){

    return $this->_db->pegarUltimoId(); //!!!!

  }

  public function deletarToDo($idToDo){

    $where = ["id_todo = ".$idToDo];

    $this->_db->delete("todo",$where);

  }

  public function marcarToDo($idToDo, $marca){

    if($marca = 0){

      $set = 1;

    }

    else{

      $set = 0;
      
    }

    $where = ["id_todo = ".$idToDo];

    $values = ["marked_todo"=>$set];

    $this->_db->update("todo", $values, $where);

  }

}

?>