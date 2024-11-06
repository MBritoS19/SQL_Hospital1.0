<?php
session_start();
include 'conexao.php';

// Verificar se o usuário está logado e é enfermeiro
if (!isset($_SESSION['usuario_id']) || ($_SESSION['tipo'] != 'enfermeiro' && $_SESSION['tipo'] != 'administrador')) {
    header("Location: login.php");
    exit;
}

// Query para buscar as receitas pendentes
$query = $conexao->prepare("SELECT r.id, p.nome AS paciente_nome, r.nome_medicamento, r.data_administracao, r.hora_administracao, p.leito FROM receitas r JOIN pessoas p ON r.paciente_id = p.id WHERE r.id NOT IN (SELECT receita_id FROM administracoes)");
$query->execute();
$receitas = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitas Pendentes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <h2 class="mb-4">Receitas Pendentes</h2>

        <?php if (!empty($receitas)) : ?>
            <ul class="list-group">
                <?php foreach ($receitas as $receita): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Paciente:</strong> <?= htmlspecialchars($receita['paciente_nome']) ?><br>
                            <strong>Medicamento:</strong> <?= htmlspecialchars($receita['nome_medicamento']) ?><br>
                            <strong>Data:</strong> <?= htmlspecialchars($receita['data_administracao']) ?><br>
                            <strong>Hora:</strong> <?= htmlspecialchars($receita['hora_administracao']) ?><br>
                            <strong>Leito:</strong> <?= htmlspecialchars($receita['leito']) ?>
                        </div>
                        <?php
                        if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] == 'enfermeiro' || $_SESSION['tipo'] == 'administrador') 
                        {?>
                            <a href="registrar_administracao.php?receita_id=<?= $receita['id'] ?>" class="btn btn-primary btn-sm">Registrar Administração</a>
                        <?php
                        }
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="alert  alert-info">Nenhuma receita pendente encontrada.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>