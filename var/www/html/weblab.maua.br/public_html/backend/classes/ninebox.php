<?php

class ninebox{

  private $_db;

  public function __construct(){
    
    $this->_db = new db;

  }

  public function carregarNotas($idUsuario){

    $potencialTotal = 0;

    $potencial = 0;

    $p = 0;

    $desempenhoTotal = 0;

    $desempenho = 0;

    $d = 0 ;

    $this->_db->select("ninebox",NULL,["id_user = ".$idUsuario]);

    $resultados =  $this->_db->getResults();
    
    if(!$this->_db->count()){
    
    }

    else{

      foreach($resultados as $resultados){

        $potencial += $resultados->potencial_ninebox;

        $desempenho += $resultados->desempenho_ninebox;

        $p++;

        $d++;

      }

      $potencialTotal = $potencial/$p;

      $desempenhoTotal = $desempenho/$d;

    }

    return [$potencialTotal,$desempenhoTotal]; 


  }

  public function adicionarNinebox($idUsuario,$idAvaliador,$potencial,$desempenho){

    $data = ["id_ninebox"=>"NULL","id_user"=>$idUsuario,"id_avaliador"=>$idAvaliador,"potencial_ninebox"=>$potencial,"desempenho_ninebox"=>$desempenho,"data_ninebox"=>"'".date('Y-m-d H:i:s')."'"];

    $this->_db->insert("ninebox",$data);

  }

  public function reabrirGeral($idEmpresa){

    $this->_db->query("DELETE n FROM ninebox n INNER JOIN user u on u.id_user = n.id_user WHERE u.id_empresa = ".$idEmpresa);

  }

  public function reabrirSetor($idSetor){

    $this->_db->query("DELETE n FROM ninebox n INNER JOIN user u on u.id_user = n.id_user WHERE u.id_setor = ".$idSetor);

  }

  public function reabrirUsuario($idUsuario){

    $this->_db->query("DELETE FROM ninebox WHERE id_user = ".$idUsuario);

  }

  public function buscarMediasMes($idUser){

    $this->_db->query("SELECT data_ninebox as data, desempenho_ninebox as desempenho, potencial_ninebox as potencial FROM ninebox WHERE id_user = ".$idUser." ORDER BY data_ninebox LIMIT 5");

    return $this->_db->getResults();
  }
  
}

?>