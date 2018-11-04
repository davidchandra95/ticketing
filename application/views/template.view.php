<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Contoh CRUD</title>
   <link rel="stylesheet" href="<?= BASE_PATH ?>/public/bootstrap/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?= BASE_PATH ?>/public/dataTables/css/dataTables.bootstrap.min.css">

   <script src="<?= BASE_PATH ?>/public/jquery/jquery-3.1.1.min.js"></script>
</head>
<body>
   <div class="container">
      <?php
         $view = new View($viewName);
         $view->bind('data', $data);
         $view->render();
      ?>
   </div>

   <script src="<?= BASE_PATH ?>/public/bootstrap/dist/js/bootstrap.min.js"></script>
   <script src="<?= BASE_PATH ?>/public/dataTables/js/jquery.dataTables.min.js"></script>
   <script src="<?= BASE_PATH ?>/public/dataTables/js/dataTables.bootstrap.min.js"></script>
</body>
</html>