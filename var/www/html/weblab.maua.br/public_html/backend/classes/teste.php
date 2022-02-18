<?php

class teste{

  private $_db;

  public function __construct(){
    
    $this->_db = new db;

  }

  public function carregarTeste($idCategoria){

    $where = ["id_categoria = ".$idCategoria]; 

    $this->_db->select("teste",NULL,$where);

    return $this->_db->getResults();

  }

  public function adicionarTeste($idCategoria, $nome, $descricao){

    $data = ["id_teste"=>"NULL","id_categoria"=>$idCategoria,"nome_teste"=>"'".$nome."'","desc_teste"=>"'".$descricao."'"];

    $this->_db->insert("teste",$data);

    return $this->ultimoTeste();

  }

  public function ultimoTeste(){

    return $this->_db->pegarUltimoId();

  }

  public function deletarTeste($idTeste){

    $where = ["id_teste = ".$idTeste];

    $this->_db->delete("teste",$where);

  }

  public function buscarCategoria($idTeste){

    $where = ["id_teste=".$idTeste]; 

    $this->_db->select("teste",NULL,$where);

    $array = $this->_db->getResults();

    foreach($array as $array){

      return $array->id_categoria;

    }

  }
  
  public function contarTestes($idEmpresa){

    $this->_db->query("SELECT COUNT(teste.id_teste) as countTestes FROM `teste` INNER JOIN `categoria` on teste.id_categoria = categoria.id_categoria WHERE categoria.id_empresa = ".$idEmpresa);

    return $this->_db->getResults();

  }

}

?>