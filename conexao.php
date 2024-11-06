<?php 
$servidor = 'localhost';
$banco = 'hospital';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);