<?php

class pergunta{

    private $_db;

    public function __construct(){
    
        $this->_db = new db;

    }
    
    public function carregarPergunta($idTeste){

        $where = ["id_teste = ".$idTeste]; 
    
        $this->_db->select("pergunta",NULL,$where);
    
        return $this->_db->getResults();
    
    }

    public function deletarPergunta($idPergunta){

        $where = ["id_pergunta = ".$idPergunta];
    
        $this->_db->delete("pergunta",$where);
    
    }

    public function adicionarPergunta($idTeste,$text,$altA,$altB,$altC,$altD,$resp){

        $data = ["id_pergunta"=>"NULL","id_teste"=>$idTeste,"texto_pergunta"=>"'".$text."'","alta_pergunta"=>"'".$altA."'","altb_pergunta"=>"'".$altB."'","altc_pergunta"=>"'".$altC."'","altd_pergunta"=>"'".$altD."'","resposta_pergunta"=>"'".$resp."'"];

        $this->_db->insert("pergunta",$data);

        return $this->ultimaPergunta();

    }

    public function ultimaPergunta(){

        return $this->_db->pegarUltimoId();
    
    }

}

?>