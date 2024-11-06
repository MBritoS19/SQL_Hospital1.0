<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

try {
// Recebe os dados do formulário
$nome = $_POST['nome'];
$coren = $_POST['coren'];
$usuario = $_POST['usuario'];
$senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

// Define o ID do tipo como "enfermeiro" diretamente
$tipo_id = 2; // Supondo que o tipo_id de "enfermeiro" seja 2

//puxando o id do tipo da pessoa criada
$comando = $conexao->prepare("SELECT id FROM tipos_pessoa WHERE tipo = 'enfermeiro'");
$comando->execute();
$linha = $comando->fetch();
$tipo_id = $linha['id'];


// Insere o enfermeiro na tabela pessoas
$sql = "INSERT INTO pessoas (nome, coren, tipo_id) VALUES (?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->execute(array($nome, $coren, $tipo_id));
$pessoa_id = $conexao->lastInsertId();

// Insere os dados de login na tabela usuarios
$sql_usuario = "INSERT INTO usuarios (pessoa_id, usuario, senha) VALUES (?, ?, ?)";
$stmt_usuario = $conexao->prepare($sql_usuario);
$stmt_usuario->execute(array($pessoa_id, $usuario, $senha));

echo "Enfermeiro cadastrado com sucesso!";
sleep(20);
header("Location: cadastro_medico.php");
} catch (PDOException $e) {
    // Verifica se o erro é de chave duplicada
    if ($e->getCode() == 23000) {
        echo "Erro: O nome de usuário '$usuario' já está em uso. Por favor, escolha um nome diferente.";
    } else {
        // Outros tipos de erro
        echo "Erro ao cadastrar o usuário: " . $e->getMessage();
    }
}
?>
