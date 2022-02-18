<?php

class usuario{

  private $_db;

  public function __construct(){
    
    $this->_db = new db;

  }

  public function getNome($id){

    $where = ["id_user = ".$id];

    $this->_db->select("user",["nome_user"],$where);

    $val = $this->_db->getResults();

    return $val[0];

  }

  public function buscarPosicao($idUser){

    $this->_db->query("SELECT user.nome_user,cargo.pos_cargo,cargo.tipo_cargo FROM user INNER JOIN cargo on user.id_cargo = cargo.id_cargo WHERE user.id_user =".$idUser);

    $data = $this->_db->getResults();

    return $data[0];
  }
  
  public function adicionarUsuario($email,$mat,$nome,$setor,$cargo,$senha,$salt,$empresa,$grupo){

    $data = ["id_user"=>"NULL","email_user"=>"'".$email."'","nome_user"=>"'".$nome."'","mat_user"=>$mat,"id_setor"=>$setor,"id_cargo"=>$cargo,"senha_user"=>"'".$senha."'","salt_user"=>"'".$salt."'","joined_user"=>"'".date('Y-m-d')."'","grupo_user"=>$grupo,"id_empresa"=>$empresa];

    $this->_db->insert("user",$data);

    return $this->ultimoUsuario();

  }

  public function ultimoUsuario(){

    return $this->_db->pegarUltimoId(); 
    
  }

  public function deletarUsuario($idUsuario){

    $where = ["id_user = ".$idUsuario];

    $this->_db->delete("user",$where);

  }

  public function carregarUsuariosEmpresa($empresaUser,$idUsuario){

    $this->_db->query("SELECT user.id_user,user.nome_user,setor.nome_setor,cargo.nome_cargo FROM user INNER JOIN setor on user.id_setor = setor.id_setor INNER JOIN cargo on user.id_cargo = cargo.id_cargo WHERE user.id_empresa =".$empresaUser." AND user.id_user !=".$idUsuario);

    return $this->_db->getResults();

  }

  public function carregarUsuariosSetor($idSetor,$idUsuario){

    $this->_db->query("SELECT user.id_user,user.nome_user,setor.nome_setor,cargo.nome_cargo FROM user INNER JOIN setor on user.id_setor = setor.id_setor INNER JOIN cargo on user.id_cargo = cargo.id_cargo WHERE user.id_setor =".$idSetor." AND user.id_user !=".$idUsuario);

    return $this->_db->getResults();

  }

  public function carregarUsuariosCargo($idCargo,$idUsuario){

    $this->_db->query("SELECT user.id_user,user.nome_user,setor.nome_setor,cargo.nome_cargo FROM user INNER JOIN setor on user.id_setor = setor.id_setor INNER JOIN cargo on user.id_cargo = cargo.id_cargo WHERE user.id_cargo =".$idCargo." AND user.id_user !=".$idUsuario);

    return $this->_db->getResults();

  }

  public function carregarUsuarioId($idUsuario){

    $this->_db->query("SELECT user.id_user,user.nome_user,user.id_setor,user.id_cargo,user.email_user,user.mat_user,user.grupo_user,setor.nome_setor,cargo.nome_cargo FROM user INNER JOIN setor on user.id_setor = setor.id_setor INNER JOIN cargo on user.id_cargo = cargo.id_cargo WHERE user.id_user = ".$idUsuario);

    return $this->_db->getResults();

  }

  public function alterarDadosUsuario($idUsuario,$nome,$email,$mat,$cargo,$setor,$senha){

    $where = ["id_user = ".$idUsuario];

    $data = ["email_user"=>"'".$email."'","nome_user"=>"'".$nome."'","mat_user"=>$mat,"id_setor"=>$setor,"id_cargo"=>$cargo];

    if($senha != ""){

      $data["senha"] = $senha;

    }

    $this->_db->update("user",$data,$where);

  }

} 

?>