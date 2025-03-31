<!-- PASSADO OS PARAMETROS PARA REALIZAR A CANEXAO COM O BANCO DE DADOS -->
<?php 
define('HOST', '127.0.0.1:3306');
define('USUARIO', 'root');
define('SENHA', '');
define('DB','estoque');

// REALIZA A CANEXAO COM O BANCO DE DADOS COM BASE NOS PARAMETROS PASSADOS
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Nao foi possivel conectar');

?>