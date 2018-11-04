<?php

use \application\controllers\MainController;

class KotaController extends MainController {

   function __construct () {
      $this->model('kota');
   }

   public function index() {
      $this->template('kota/index');
   }

   public function listData() {
      $query = $this->kota->selectAll();     
      $list = $this->kota->getResult($query);
      $data = array();
      $no = 0;

      foreach ($list as $li) {
         $no++;
         $row = array();
         $row[] = $no;
         $row[] = $li['nama_kota'];
         $row[] = "<a class='btn btn-primary' onclick='editForm(".$li['id_kota'].")'>Edit</a>
                  <a class='btn btn-danger' onclick='deleteData(".$li['id_kota'].")'>Hapus</a>";

         $data[] = $row;
      }

      $output = array("data" => $data);
      echo json_encode($output);
   }
}

?>