<?php

class nota{

  private $_db;

  public function __construct(){
    
    $this->_db = new db;

  }

  public function analiseNotas($idUsuario,$idCategoria){

    $this->_db->query("SELECT categoria.nome_categoria,teste.nome_teste,nota.valor_nota,nota.data_nota FROM nota INNER JOIN categoria on categoria.id_categoria = nota.id_categoria INNER JOIN teste on teste.id_teste = nota.id_teste WHERE nota.id_user =".$idUsuario." AND nota.id_categoria =".$idCategoria." AND nota.data_nota > DATE_ADD(CURDATE(), INTERVAL -12 MONTH)");

    return $this->_db->getResults();

  }

  public function mediaCategorias($idUsuario){

    $this->_db->query("SELECT AVG(nota.valor_nota) as media,categoria.nome_categoria FROM user INNER JOIN nota on nota.id_user = user.id_user INNER JOIN categoria on nota.id_categoria = categoria.id_categoria WHERE user.id_user = ".$idUsuario." GROUP BY nota.id_categoria");

    return $this->_db->getResults();

  }

  public function adicionarNotaKnowhow($idUsuario,$idCategoria,$idTeste,$nota){

    $data = ["id_nota"=>"NULL","id_user"=>$idUsuario,"id_categoria"=>$idCategoria,"id_teste"=>$idTeste,"valor_nota"=>$nota,"data_nota"=>"'".date('Y-m-d')."'"];

    $this->_db->insert("nota",$data);

  }

  
  public function buscarTestesFeitos($idUsuario){

    $where = ["id_user = ".$idUsuario];

    $this->_db->select("nota",NULL,$where);

    $array = $this->_db->getResults();

    $testes = [];

    foreach($array as $array){

      array_push($testes,$array->id_teste);

    }

    return $testes;

  }

  public function contarNotas($idUsuario){

    $this->_db->query("SELECT COUNT(id_nota) as countNotas FROM `nota` WHERE id_user = ".$idUsuario);

    return $this->_db->getResults();

  }

  public function reabrirGeral($idEmpresa){

    $this->_db->query("DELETE n FROM nota n INNER JOIN user u on u.id_user = n.id_user WHERE u.id_empresa = ".$idEmpresa);

  }

  public function reabrirSetor($idSetor){

    $this->_db->query("DELETE n FROM nota n INNER JOIN user u on u.id_user = n.id_user WHERE u.id_setor = ".$idSetor);

  }

  public function reabrirUsuario($idUsuario){

    $this->_db->query("DELETE FROM nota WHERE id_user = ".$idUsuario);

  }

  public function buscarMediasMes($idUser,$idCategoria){

    $this->_db->query("SELECT valor_nota as nota, data_nota as data FROM nota WHERE id_user = ".$idUser." AND id_categoria = ".$idCategoria." AND data_nota > DATE_ADD(CURDATE(), INTERVAL -12 MONTH)");

    return $this->_db->getResults();
  }

  public function buscarMediasMesSetor($idSetor,$idCategoria){

    $this->_db->query("SELECT nota.valor_nota as nota, nota.data_nota as data FROM nota INNER JOIN user on nota.id_user = user.id_user WHERE nota.id_categoria = ".$idCategoria." AND user.id_setor = ".$idSetor." AND nota.data_nota > DATE_ADD(CURDATE(), INTERVAL -12 MONTH)");

    return $this->_db->getResults();
  }

}

?>