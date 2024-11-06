<?php
session_start();
include 'conexao.php';

// Coletar dados do formulário
$nome = $_POST['nome'];
$leito = $_POST['leito'];

// Buscar o tipo de pessoa "paciente"
$query = $conexao->prepare("SELECT id FROM tipos_pessoa WHERE tipo = 'paciente'");
$query->execute();
$tipo_paciente = $query->fetch(PDO::FETCH_ASSOC);


$tipo_id = $tipo_paciente['id'];

// Inserir o paciente na tabela `pessoas`
$query = $conexao->prepare("INSERT INTO pessoas (nome, leito, tipo_id) VALUES (?, ?, ?)");
$query->execute([$nome, $leito, $tipo_id]);

echo "Paciente cadastrado com sucesso!";
header("Location: cadastro_paciente.php");


