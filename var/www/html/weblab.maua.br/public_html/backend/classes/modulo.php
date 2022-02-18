<?php
class modulo{

    private $_db;

    public function __construct(){

    $this->_db = new db;

    }

    public function adicionarModulo($nomeModulo,$numModulo,$idCurso){
        
        $data = ["id_modulo"=>"NULL","nome_modulo"=>"'".$nomeModulo."'","numero_modulo"=>"'".$numModulo."'","id_curso"=>$idCurso];

        $this->_db->insert("modulo",$data);

        return $this->ultimoModulo();
        
    }

    public function carregarModulos($idCurso){
        
        $where = ["id_curso = ".$idCurso];

        $this->_db->select("modulo",NULL,$where);

        return $this->_db->getResults();
    }

    private function ultimoModulo(){

        return $this->_db->pegarUltimoId(); 
    }

    public function deletarModulo($idModulo){

        $where = ["id_categoria = ".$idModulo];
    
        $this->_db->delete("modulo",$where);
    
    }
    

}

?>