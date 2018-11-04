<h2 class="page-header">Data Kota</h2>

<a href="" id="btnAddKota" class="btn btn-primary">Tambah</a><br><br>

<!-- Table section -->
<table class="table table-striped">
   <thead>
      <tr>
         <td width="25">No</td>
         <td>Nama Kota</td>
         <td width="120">Aksi</td>
      </tr>
   </thead>
   <tbody>
      <script>
         var table, saveMethod;
         
         $(function() {
            table = $('.table').DataTable({
               "processing": true,
               "ajax": {
                  "url": "<?= BASE_PATH ?>/kota/listData",
                  "type": "GET"
               }
            });

            $('#btnAddKota').click(function(event) {
               event.preventDefault();
               
               save_method = "add";
               $('#modal-form').modal('show');
               $('#modal-form form')[0].reset();
               $('#modalTitle').text('Tambah Kota');
            })
         });

         function editForm(id) {
            save_method = "edit";
            

            $.ajax({
               url : "<?= BASE_PATH ?>/kota/edit/" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                  $('#modal-form').modal('show');
                  $('#modalTitle').text('Edit Kota');
                  $('#id').val(data.id_kota);
                  $('#nama').val(data.nama_kota);
               },
               error: function() {
                  alert('Tidak dapat menampilkan data.');
               }
            })
         }

         function saveData() {
            if (save_method == 'add') url = "<?= BASE_PATH ?>/kota/insert"
            else url = "<?= BASE_PATH ?>/kota/update"
            $.ajax({
               url: url,
               type: "POST",
               data: $('#modal-form form').serialize(),
               success: function(data) {
                  $('#modal-form').modal('hide');
                  table.ajax.reload();
               },
               error: function() {
                  alert('Gagal menyimpan data.');
               }
            });

            return false;
         }

         function deleteData(id) {
            if(confirm("Apakah Anda yakin ingin menghapus kota ini?")) {
               $.ajax({
                  url: "<?= BASE_PATH ?>/kota/delete/" + id,
                  type: "POST",
                  success: function(data) {
                     table.ajax.reload();
                  }, 
                  error: function() {
                     alert("Gagal menghapus data.");
                  }
               });
            }
         }
      </script>
   </tbody>
</table>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" onsubmit="return saveData()">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                  </button>
                  <h4 class="modal-title" id="modalTitle">
                  </h4>
               </div>
               
               <div class="modal-body">
                  <input type="hidden" name="id" id="id">
                  <div class="form-group">
                     <label for="kota">Nama Kota</label>
                     <input type="text" class="form-control" id="nama" name="nama">
                  </div>
               </div>
               
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
               </div>
            </form>
        </div>
    </div>
</div>