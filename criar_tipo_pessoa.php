<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] != 'administrador') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criação de Tipo de Pessoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include("navbar.php");
    require_once 'conexao.php';

    // Consultar tipos de pessoa existentes
    $stmt = $conexao->query("SELECT * FROM tipos_pessoa ORDER BY id");
    $tiposPessoa = $stmt->fetchAll();
    ?>
    
    <div class="container mt-5">
        <h2>Criação de Tipo de Pessoa</h2>
        <form action="salvar_tipo_pessoa.php" method="POST">
            <div class="form-group">
                <label for="tipo">Tipo de Pessoa:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" required>
            </div>
            <button type="submit" class="btn btn-primary">Criar Tipo</button>
        </form>

        <!-- Exibir Tipos de Pessoa Existentes -->
        <h3 class="mt-5">Tipos de Pessoa Existentes</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tiposPessoa as $tipo): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($tipo['id']); ?></td>
                        <td><?php echo htmlspecialchars($tipo['tipo']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
