<?php
session_start();
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Prepara a consulta SQL para buscar o usuário
    $sql = "SELECT u.id, u.usuario, u.senha, u.status, p.nome, t.tipo 
            FROM usuarios u
            INNER JOIN pessoas p ON u.pessoa_id = p.id
            INNER JOIN tipos_pessoa t ON p.tipo_id = t.id
            WHERE u.usuario = :usuario";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se está ativo
    if ($user && $user['status'] === 'Ativo') {
        // Verifica a senha usando password_verify
        if (password_verify($senha, $user['senha'])) {
            // Armazena informações na sessão
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['tipo'] = $user['tipo'];

            // Redireciona para a página principal ou de dashboard
            header("Location: dashboard.php");
            exit();
        } 
        else {
            $error = "Senha incorreta!";
        }
    } 
    else {
        $error = "Usuário não encontrado ou inativo!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Hospitalar</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg" style="width: 400px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login</h3>
                
                <!-- Exibe a mensagem de erro, se houver -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="form-group">
                        <label for="usuario">Usuário:</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" class="form-control" required>
                    </div><br>

                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
