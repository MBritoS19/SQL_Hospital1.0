<?php
session_start();
include 'conexao.php';

try {
$nome = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Criptografar a senha

//puxando o id do tipo da pessoa criada
$comando = $conexao->prepare("SELECT id FROM tipos_pessoa WHERE tipo = 'administrador'");
$comando->execute();
$linha = $comando->fetch();
$tipo_id = $linha['id'];

// Inserir dados na tabela `pessoas`
$query = $conexao->prepare("INSERT INTO pessoas (nome, tipo_id) VALUES (?, ?)");
$query->execute([$nome, $tipo_id]);
$pessoa_id = $conexao->lastInsertId();

// Inserir dados na tabela `usuarios`
$query = $conexao->prepare("INSERT INTO usuarios (pessoa_id, usuario, senha) VALUES (?, ?, ?)");
$query->execute([$pessoa_id, $usuario, $senha]);

echo "Cadastro realizado com sucesso!";
header("Location: cadastro_administrador.php");

} catch (PDOException $e) {
    // Verifica se o erro é de chave duplicada
    if ($e->getCode() == 23000) {
        echo "Erro: O nome de usuário '$usuario' já está em uso. Por favor, escolha um nome diferente.";
    } else {
        // Outros tipos de erro
        echo "Erro ao cadastrar o usuário: " . $e->getMessage();
    }
}


