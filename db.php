<?php
   $data_base = mysqli_connect('localhost', 'root', 'root','db_ecommervce_bootstrap_template');

   echo "A conexão foi realizada com sucesso";

   if (mysqli_connect_errno()) {
       # code...
       echo "A conexão com o banco de dados falhou devido aos seguintes erros: " .mysqli_connect_error();
       die();
   }
