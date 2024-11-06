<?php
session_start();
include 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Pegar receitas pendentes
$receitas_stmt = $conexao->prepare("
    SELECT r.id, r.nome_medicamento, r.data_administracao, r.hora_administracao, p.nome AS paciente_nome, p.leito, r.status
    FROM receitas r 
    JOIN pessoas p ON r.paciente_id = p.id 
    WHERE r.id NOT IN (SELECT receita_id FROM administracoes)
");
$receitas_stmt->execute();
$receitas_pendentes = $receitas_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Registrar Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <div class="container mt-5">
        <h2>Registrar Administração de Medicamento</h2>

        <?php if (count($receitas_pendentes) > 0): ?>
            <form method="POST" action="salvar_administracao.php">
                <div class="mb-3">
                    <label for="receita_id" class="form-label">Selecione a Receita:</label>
                    <select name="receita_id" id="receita_id" class="form-select" required>
                        <?php foreach ($receitas_pendentes as $receita): ?>
                            <option value="<?= $receita['id'] ?>">
                                Paciente: <?= htmlspecialchars($receita['paciente_nome']) ?> | Leito: <?= htmlspecialchars($receita['leito']) ?> |
                                Medicamento: <?= htmlspecialchars($receita['nome_medicamento']) ?> | Data: <?= htmlspecialchars($receita['data_administracao']) ?> | Hora: <?= htmlspecialchars($receita['hora_administracao']) ?> | Status: <?= htmlspecialchars($receita['status']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="data_administracao" class="form-label">Data da Administração:</label>
                    <input type="date" name="data_administracao" id="data_administracao" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="hora_administracao" class="form-label">Hora da Administração:</label>
                    <input type="time" name="hora_administracao" id="hora_administracao" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="dose" class="form-label">Dose Administrada:</label>
                    <input type="text" name="dose" id="dose" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrar Administração</button>
            </form>
        <?php else: ?>
            <div class="alert alert-info">Não há receitas pendentes para administrar.</div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>