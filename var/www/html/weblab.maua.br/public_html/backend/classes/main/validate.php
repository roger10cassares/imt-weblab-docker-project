<?php

class validate{
  private $_passed = false,
          $_errors = array(),
          $_db = null;
  public function __construct(){
    $this->_db = new db;
  }
  public function check($source, $items = array()){
    foreach ($items as $item => $rules) {
      foreach ($rules as $rule => $rule_value) {
        //echo "{$item} {$rule} must obey {$rule_value} <br>"; //Rules apeared
        $value = trim($source[$item]);
        $item = escape($item);
        if ($rule === 'required' && empty($value)) {
          $this->addError("{$item} is required");
        }
        else if(!empty($value)) {
          switch ($rule) {
            case 'min':
              if (strlen($value) < $rule_value) {
                $this->addError("{$item} Deve ter no mínimo {$rule_value} caracteres");
              }
              break;
            case 'max':
              if (strlen($value) > $rule_value) {
                $this->addError("{$item} Deve ter no máximo {$rule_value} caracteres");
              }
              break;

            case 'unique':
              $check = $this->_db->get($rule_value, array($item, '=', $value));
              if ($check->count()) {
                $this->addError("{$item} Já Existe ");
              }
              break;

            case 'matches':
              if ($value != $source[$rule_value]) {
                $this->addError("{$rule_value} must match {$item}");
              }
              break;
            case 'contains':
              if (strpos($value, $rule_value) === false) {
                $this->addError("{$item} must contain {$rule_value}");
              }  
              break;
              case 'quantidade':
              $num = 0;
              foreach($rule_value as $alt){
                  if($source[$alt] != ''){
                      $num++;
                  }
              }
              if($num < 2){
                  $this->addError("{$item} must have at least 2");
              }
              break;
          }
        }
      }
    }
    if (empty($this->_errors)) {
      $this->_passed = true;
    }
    return $this;
  }
  public function addError($error){
    $this->_errors[] = $error;
  }
  public function errors(){
    return $this->_errors;
  }
  public function passed(){
    return $this->_passed;
  }
}

 ?>
