<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro de Paciente</title>
</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <div class="container mt-5">
        <h2>Cadastro de Paciente</h2>
        <form action="salvar_paciente.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Paciente:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="leito">Leito:</label>
                <input type="text" class="form-control" id="leito" name="leito" required>
            </div><br>
            <button type="submit" class="btn btn-primary">Cadastrar Paciente</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>