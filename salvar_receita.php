<?php
session_start();
include 'conexao.php';

// Processamento do formulário
$nome_paciente = $_POST['nome_paciente'];
$nome_medicamento = $_POST['nome_medicamento'];
$data_administracao = $_POST['data_administracao'];
$hora_administracao = $_POST['hora_administracao'];
$dose = $_POST['dose'];

// Verificar se o paciente já está cadastrado
$query = $conexao->prepare("SELECT id FROM pessoas WHERE nome = '" . $nome_paciente . "' AND tipo_id = (SELECT id FROM tipos_pessoa WHERE tipo = 'paciente')");
echo "SELECT id FROM pessoas WHERE nome = '" . $nome_paciente . "' AND tipo_id = (SELECT id FROM tipos_pessoa WHERE tipo = 'paciente')";
$query->execute();
$paciente = $query->fetch(PDO::FETCH_ASSOC);

if ($paciente) {
    // Paciente já cadastrado, inserir receita
    $query = $conexao->prepare("INSERT INTO receitas (paciente_id, nome_medicamento, data_administracao, hora_administracao, dose, medico_id) VALUES (?, ?, ?, ?, ?, ?)");
    $query->execute([$paciente['id'], $nome_medicamento, $data_administracao, $hora_administracao, $dose, $_SESSION['usuario_id']]);
    echo "Receita cadastrada com sucesso!";
    header("Location: cadastro_receita.php");
} else {
    // Paciente não cadastrado, redirecionar para cadastro de paciente
    echo "Paciente não cadastrado. Por favor, cadastre o paciente primeiro.";
    // header("Location: cadastro_paciente.php");
}
