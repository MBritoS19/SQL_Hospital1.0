<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
    include("navbar.php");
    ?>

    <!-- Main Content -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Bem-vindo ao Sistema do Hospital</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php
            if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] == 'administrador') { ?>
                <!-- Cadastro Administrador -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro de Administrador</h5>
                            <p class="card-text">Cadastre novos administradores no sistema.</p>
                            <a href="cadastro_administrador.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php
            if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] == 'administrador') { ?>
                <!-- Cadastro Médico -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro de Médico</h5>
                            <p class="card-text">Cadastre novos médicos no sistema.</p>
                            <a href="cadastro_medico.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php
            if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] == 'administrador') { ?>
                <!-- Cadastro Enfermeiro -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro de Enfermeiro</h5>
                            <p class="card-text">Cadastre novos enfermeiros no sistema.</p>
                            <a href="cadastro_enfermeiro.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php
            if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] == 'administrador' || $_SESSION['tipo'] == 'medico') { ?>
                <!-- Cadastro Paciente -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro de Paciente</h5>
                            <p class="card-text">Cadastre novos pacientes no sistema.</p>
                            <a href="cadastro_paciente.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php
            if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] == 'administrador' || $_SESSION['tipo'] == 'medico') { ?>
                <!-- Cadastro Receita -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Cadastro de Receita</h5>
                            <p class="card-text">Cadastre novas receitas para pacientes.</p>
                            <a href="cadastro_receita.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php
            if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] == 'administrador') { ?>
                <!-- Controle de Usuários -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Controle de Usuários</h5>
                            <p class="card-text">Gerencie usuários do sistema.</p>
                            <a href="controle_usuarios.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php
            if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] == 'administrador') { ?>
                <!-- Criar Tipo de Pessoa -->
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Criar Tipo de Pessoa</h5>
                            <p class="card-text">Adicione novos tipos de pessoa (ex: médico, enfermeiro).</p>
                            <a href="criar_tipo_pessoa.php" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <!-- Receitas Pendentes -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Receitas Pendentes</h5>
                        <p class="card-text">Consulte as receitas ainda pendentes.</p>
                        <a href="receitas_pendentes.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Registrar Administração -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Registrar Administração</h5>
                        <p class="card-text">Registre a administração de medicamentos.</p>
                        <a href="registrar_administracao.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Dashboard Principal -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Dashboard</h5>
                        <p class="card-text">Visão geral do sistema hospitalar.</p>
                        <a href="dashboard.php" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>