<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])  || $_SESSION['tipo'] != 'administrador') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<title>Cadastro de Médico</title>
</head>

<body>
	<?php
	include("navbar.php");
	?>

	<div class="container mt-5">
		<h2>Cadastro de Médico</h2>
		<form action="salvar_medico.php" method="POST">
			<div class="form-group">
				<label for="nome">Nome:</label>
				<input type="text" class="form-control" id="nome" name="nome" required>
			</div>
			<div class="form-group">
				<label for="especialidade">Especialidade:</label>
				<input type="text" class="form-control" id="especialidade" name="especialidade" required>
			</div>
			<div class="form-group">
				<label for="crm">CRM:</label>
				<input type="text" class="form-control" id="crm" name="crm" required>
			</div>
			<div class="form-group">
				<label for="usuario">Usuário:</label>
				<input type="text" class="form-control" id="usuario" name="usuario" required>
			</div>
			<div class="form-group">
				<label for="senha">Senha:</label>
				<input type="password" class="form-control" id="senha" name="senha" required>
			</div><br>
			<button type="submit" class="btn btn-primary">Cadastrar</button>
		</form>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>