<?php
include 'conexao.php';

$tipo = $_POST['tipo'];

$query = $conexao->prepare("INSERT INTO tipos_pessoa (tipo) VALUES (?)");
$query->execute([$tipo]);

echo "Tipo de pessoa criado com sucesso!";
header("Location: criar_tipo_pessoa.php");
