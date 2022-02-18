<?php

class cargo{

  private $_db;

  public function __construct(){
    
    $this->_db = new db;

  }

  public function adicionarCargo($idSetor,$nome,$desc,$pos,$tipo){
    
    $data = ["id_cargo"=>"NULL","id_setor"=>$idSetor,"nome_cargo"=>"'".$nome."'","desc_cargo"=>"'".$desc."'","pos_cargo"=>$pos,"tipo_cargo"=>$tipo];

    $this->_db->insert("cargo",$data);

    return $this->ultimoCargo();

  }

  public function ultimoCargo(){

    return $this->_db->pegarUltimoId(); 

  }

  public function buscarPosicaoCargos($idSetor,$tipoCargo){

    $this->_db->query("SELECT pos_cargo AS posicao FROM cargo WHERE id_setor =".$idSetor." AND tipo_cargo=".$tipoCargo." ORDER BY pos_cargo DESC");
    
    $data = $this->_db->getResults();

    return $data[0]->posicao;

  }

  public function carregarCargos($idSetor){

    $where = ["id_setor = ".$idSetor]; 

    $this->_db->select("cargo",NULL,$where);

    return $this->_db->getResults();

  }

  public function carregarCargoUsuario($idUser){

    $this->_db->query("SELECT cargo.nome_cargo,cargo.desc_cargo FROM user INNER JOIN cargo on user.id_cargo = cargo.id_cargo WHERE user.id_user =".$idUser);

    $data = $this->_db->getResults();

    return $data[0];
  }
  
  public function deletarCargo($idCargo){

    $where = ["id_cargo = ".$idCargo];

    $this->_db->delete("cargo",$where);

  }

}

?>
