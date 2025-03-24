<?php 
define('HOST', 'localhost:3306');
define('USUARIO', 'root');
define('SENHA', '');
define('DB','');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Nao foi possivel conectar');

?>