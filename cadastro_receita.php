<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])  || ($_SESSION['tipo'] != 'administrador' && $_SESSION['tipo'] != 'enfermeiro')) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Receita Médica</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <div class="container mt-5">
        <h2>Cadastro de Receita Médica</h2>
        <form method="POST" action="salvar_receita.php">
            <div class="form-group">
                <label for="nome_paciente">Selecione o Paciente:</label>
                <select class="form-control" id="nome_paciente" name="nome_paciente" required>
                    <option value="">Selecione um paciente</option>
                    <?php
                    // Conexão com o banco de dados usando PDO
                    include 'conexao.php';

                    try {
                        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Consulta para buscar pacientes
                        $stmt = $conexao->query("SELECT id, nome FROM pessoas WHERE tipo_id = (SELECT id FROM tipos_pessoa WHERE tipo = 'paciente')");

                        // Verifica se existem pacientes e popula o dropdown
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['nome'] . "'>" . htmlspecialchars($row['nome']) . "</option>";
                        }
                    } catch (PDOException $e) {
                        echo "Erro: " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="nome_medicamento">Nome do Medicamento:</label>
                <input type="text" class="form-control" id="nome_medicamento" name="nome_medicamento" required>
            </div>
            <div class="form-group">
                <label for="data_administracao">Data da Administração:</label>
                <input type="date" class="form-control" id="data_administracao" name="data_administracao" required>
            </div>
            <div class="form-group">
                <label for="hora_administracao">Hora da Administração:</label>
                <input type="time" class="form-control" id="hora_administracao" name="hora_administracao" required>
            </div>
            <div class="form-group">
                <label for="dose">Dose:</label>
                <input type="text" class="form-control" id="dose" name="dose" required>
            </div><br>
            <button type="submit" class="btn btn-primary">Cadastrar Receita</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>