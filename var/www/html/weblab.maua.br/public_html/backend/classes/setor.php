<?php

class setor{

  private $_db;

  public function __construct(){
    
    $this->_db = new db;

  }

  public function adicionarSetor($empresa,$nome){
    
    $data = ["id_setor"=>"NULL","nome_setor"=>"'".$nome."'","id_empresa"=>$empresa];

    $this->_db->insert("setor",$data);

    return $this->ultimoSetor();

  }

  public function ultimoSetor(){

    return $this->_db->pegarUltimoId(); 

  }

  public function carregarSetores($empresa){

    $where = ["id_empresa = ".$empresa]; 

    $this->_db->select("setor",NULL,$where);

    return $this->_db->getResults();

  }

}

?>
