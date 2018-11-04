<h2 class="page-header">Data Kota</h2>

<a href="" onClick="addForm()" class="btn btn-primary">Tambah</a><br><br>

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
                  "type": "POST"
               }
            });
         });
      </script>
   </tbody>
</table>