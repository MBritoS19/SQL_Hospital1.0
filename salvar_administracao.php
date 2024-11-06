<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salvar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    include 'conexao.php';
    if (!isset($_SESSION['tipo']) || ($_SESSION['tipo'] != 'enfermeiro' && $_SESSION['tipo'] != 'administrador')) {
        header("Location: login.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $receita_id = $_POST['receita_id'];
        $data_administracao = $_POST['data_administracao'];
        $hora_administracao = $_POST['hora_administracao'];
        $dose = $_POST['dose'];
        $enfermeiro_id = $_SESSION['usuario_id'];

        $sql = $conexao->prepare("UPDATE receitas SET status = 'Administrado' WHERE id = ?");
        $sql->execute([$receita_id]);

        $stmt = $conexao->prepare("INSERT INTO administracoes (receita_id, data_administracao, hora_administracao, dose, enfermeiro_id) 
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$receita_id, $data_administracao, $hora_administracao, $dose, $enfermeiro_id]);

        echo "<div class='alert alert-success'>Administração registrada com sucesso.</div>";
        header("Location: cadastro_receita.php");
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>