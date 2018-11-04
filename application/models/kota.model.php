<?php

class KotaModel extends Model {
   public function __construct() {
      $this->connect();
      $this->_table = "kota";
   }
}

?>