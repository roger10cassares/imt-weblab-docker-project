<?php
class curso{

    private $_db;

    public function __construct(){

    $this->_db = new db;

    }

    public function adicionarCurso($nomeCurso,$descCurso,$idEmpresa){
        
        $data = ["id_curso"=>"NULL","nome_curso"=>"'".$nomeCurso."'","descricao_curso"=>"'".$descCurso."'","id_empresa"=>$idEmpresa];

        $this->_db->insert("curso",$data);

        return $this->ultimoCurso();
        
    }

    public function carregarCursos($idEmpresa){
        
        $where = ["id_empresa = ".$idEmpresa];

        $this->_db->select("curso",NULL,$where);

        return $this->_db->getResults();
    }

    private function ultimoCurso(){

        return $this->_db->pegarUltimoId(); 
    }

    public function deletarCurso($idCurso){

        $where = ["id_categoria = ".$idCurso];
    
        $this->_db->delete("curso",$where);
    
    }
    

}

?>