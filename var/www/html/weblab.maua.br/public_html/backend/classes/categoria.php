<?php

class categoria{

  private $_db;


  public function __construct(){
    
    $this->_db = new db;

  }

  public function carregarPorEmpresa($empresa){

    $where = ["id_empresa = ".$empresa];

    $this->_db->select("categoria",NULL,$where);

    return $this->_db->getResults();

  }

  public function adicionarCategoria($empresa, $nome, $descricao, $foto){

    $data = ["id_categoria"=>"NULL","nome_categoria"=>"'".$nome."'","desc_categoria"=>"'".$descricao."'","foto_categoria"=>"'".$foto."'","id_empresa"=>$empresa];

    $this->_db->insert("categoria",$data);

    return $this->ultimaCategoria();

  }

  public function ultimaCategoria(){

    return $this->_db->pegarUltimoId(); 

  }

  public function deletarCategoria($idCategoria){

    $where = ["id_categoria = ".$idCategoria];

    $this->_db->delete("categoria",$where);

  }

  public function carregarNotas($idUsuario){
    
    $this->_db->query("SELECT c.nome_categoria as nome, c.id_categoria as id, ROUND(AVG(n.valor_nota),1) as media FROM categoria c LEFT OUTER JOIN nota n on c.id_categoria = n.id_categoria WHERE n.id_user = ".$idUsuario." GROUP BY c.nome_categoria ORDER BY media DESC");
    
    return $this->_db->getResults();


  }

  public function carregarNotasVazias($idUsuario){
    
    $this->_db->query("SELECT c.nome_categoria as nome, c.id_categoria as id, 0 as media FROM categoria c LEFT OUTER JOIN nota n on c.id_categoria = n.id_categoria WHERE n.id_user != 1 OR n.id_user IS NULL GROUP BY c.nome_categoria");
    
    return $this->_db->getResults();


  }

}

?>