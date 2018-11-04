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

   public function edit($id) {
      $query = $this->kota->selectWhere(array('id_kota'=>$id));
      $data = $this->kota->getResult($query);
      echo json_encode($data[0]);
   }

   public function insert() {
      $data = array();
      $data['nama_kota'] = $_POST['nama'];
      $simpan = $this->kota->insert($data);
   }

   public function update() {
      $data = array();
      $data['nama_kota'] = $_POST['nama'];
      $id = $_POST['id'];
      $simpan = $this->kota->update($data, array('id_kota' => $id ));
   }

   public function delete($id) {
      $hapus = $this->kota->delete(array('id_kota'=>$id));
   }
}

?>