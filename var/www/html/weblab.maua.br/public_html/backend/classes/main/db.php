<?php

class db{

  private $_pdo,
          $_query,
          $_results,
          $_count = 0;

  public function __construct(){
      try {
        $this->_pdo = new PDO('mysql:host='.config::get('mysql/host').';dbname='.config::get('mysql/db'),config::get('mysql/username'),config::get('mysql/password'));
      }
      catch (PDOException $e) {
        die($e->getMessage());
      }
  }

  public function query($sql, $params=array()){

    $this->_query = $this->_pdo->prepare($sql);

    foreach($params as $key=>$value){

      $this->_query->bindParam($key, $value);

    }

    $this->_query->execute();

    $this->_results = $this->fetchData($this->_query);

  }

  private function fetchData($stmt):array{

    $this->_count = $stmt->rowCount();

    return $array = $stmt->fetchAll(PDO::FETCH_OBJ);

  }

  public function getResults(){

    return $this->_results;

  }

  public function assembleCondition($where = array()){

    if($where){

      return $line = " WHERE ".implode(" AND ",$where);

    }
    
    else{

      return "";

    }

  }

  public function delete($table, $where=array()){
  
    $cond = $this->assembleCondition($where);

    $this->query("DELETE FROM ".$table.$cond); 

  }

  public function select($table, $col=array(), $where=array()){

    if($col == NULL){
    
      $columns = "*";

    }
    else{

      $columns = implode(", ",$col);

    }
  
    $cond = $this->assembleCondition($where);
    
    $this->query("SELECT ".$columns." FROM ".$table.$cond);
 
  }

  public function insert($table, $values=array()){

    $first = true;

    $column = "(";

    $value = "(";

      foreach($values as $col=>$val){

      if($first){

        $column = $column.$col;

        $value = $value.$val;

        $first = false;

      }
      else{

        $column = $column.", ".$col;
        
        $value = $value.", ".$val;

      }
    }

    $value = $value.")";

    $column = $column.")";

    $this->query("INSERT INTO ".$table." ".$column." VALUES ".$value);
    
  }

  public function update($table, $values=array(), $where=array()){

    $cond = $this->assembleCondition($where);

    $first = true;
    
    $value = "";
    
    foreach($values as $col=>$val){

      if($first){

        $value .= $col." = ".$val;

        $first = false;

      }
      else{

        $value .= ", ".$col." = ".$val;

      }
      

    }

    $this->query("UPDATE ".$table." SET ".$value.$cond);

  }

  public function count(){

    return $this->_count;

  }

  public function pegarUltimoId(){

    return $this->_pdo->lastInsertId();

  }

  public function getQuery(){
    return $this->_query;
  }

}

?>