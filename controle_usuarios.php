<?php
session_start();
require_once 'conexao.php';

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] != 'administrador') {
    header('Location: login.php');
    exit();
}

// Função para ativar/desativar usuário
if (isset($_GET['toggle_status']) && isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    $stmt = $conexao->prepare("SELECT status FROM usuarios WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    if ($user) {
        $newStatus = $user['status'] == 'Ativo' ? 'Inativo' : 'Ativo';
        $stmt = $conexao->prepare("UPDATE usuarios SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $userId]);
        header('Location: controle_usuarios.php');
        exit();
    }
}

// Função para excluir usuário
if (isset($_GET['delete']) && isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    $stmt = $conexao->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$userId]);
    header('Location: controle_usuarios.php');
    exit();
}

// Obter lista de usuários
$stmt = $conexao->query("SELECT u.id, u.usuario, u.status, p.nome 
                     FROM usuarios u 
                     JOIN pessoas p ON u.pessoa_id = p.id");
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
    include("navbar.php");
    ?>
    <div class="container my-5">
        <h2 class="text-center">Controle de Usuários</h2>
        <table class="table table-bordered table-hover mt-4">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['status']); ?></td>
                        <td>
                            <!-- Botão para ativar/desativar usuário -->
                            <a href="controle_usuarios.php?toggle_status=1&user_id=<?php echo $usuario['id']; ?>" class="btn btn-warning btn-sm">
                                <?php echo $usuario['status'] == 'Ativo' ? 'Desativar' : 'Ativar'; ?>
                            </a>
                            <!-- Botão para excluir usuário -->
                            <a href="controle_usuarios.php?delete=1&user_id=<?php echo $usuario['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                                Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>