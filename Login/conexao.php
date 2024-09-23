<?php

$conn = new mySqli ("localhost", "root", "", "db_petshop");

 if ($conn->connect_error){
    die("Erro de conexão" . $conn->connect_error);
 }

 ?>