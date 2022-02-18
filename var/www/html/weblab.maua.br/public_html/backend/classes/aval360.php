<?php

class aval360{

    private $_db;

    public function __construct(){
    
        $this->_db = new db;
    
    }    

    public function carregarNotas($idUsuario){
        

        for($i=1;$i<=3;$i++){
            
            $num = 0;

            $valor = 0; 

            $this->_db->select("aval360",NULL,["id_user = ".$idUsuario,"posicao_aval360 = ".$i]);

            $resultados =  $this->_db->getResults();
            
            if(!$this->_db->count()){

                $nota[$i] = 0;
            
            }
            else{
                foreach($resultados as $r){

                    $valor += $r->nota_aval360;

                    $num++;

                }

                $nota[$i] = ($valor/$num)*10;
                                
                
            }
            
            
        }

        return [$nota[1],$nota[2],$nota[3]]; 

    }

    public function adicionarAval360($idUsuario,$idAvaliador,$posicao,$nota){

        $data = ["id_aval360"=>"NULL","id_user"=>$idUsuario,"avaliador_user"=>$idAvaliador,"posicao_aval360"=>$posicao,"nota_aval360"=>$nota,"data_aval360"=>"'".date('Y-m-d H:i:s')."'"];
    
        $this->_db->insert("aval360",$data);
    
    }

    public function reabrirNotas($idEmpresa){

        $this->_db->query("DELETE a FROM aval360 a INNER JOIN user u on u.id_user = a.id_user WHERE u.id_empresa = ".$idEmpresa);
    
    }

    public function reabrirSetor($idSetor){

        $this->_db->query("DELETE a FROM aval360 a INNER JOIN user u on u.id_user = a.id_user WHERE u.id_setor = ".$idSetor);
    
    }
    
      public function reabrirUsuario($idUsuario){
    
        $this->_db->query("DELETE FROM aval360 WHERE id_user = ".$idUsuario);
    
    }

    public function buscarMedias($idUsuario){

        $this->_db->query("SELECT AVG(nota_aval360) as media FROM aval360 WHERE id_user = ".$idUsuario." GROUP BY posicao_aval360");
    
        return $this->_db->getResults();
    }

}

?>