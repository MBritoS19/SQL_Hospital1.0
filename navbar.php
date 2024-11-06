<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">Hospital Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>


                <!-- Criação Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="creationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Criação
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="creationDropdown">
                        <?php
                        if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] == 'administrador') { ?>
                            <li><a class="dropdown-item" href="cadastro_medico.php">Cadastro de Médico</a></li>
                            <li><a class="dropdown-item" href="cadastro_enfermeiro.php">Cadastro de Enfermeiro</a></li>
                            <li><a class="dropdown-item" href="cadastro_administrador.php">Cadastro de Administrador</a></li>
                        <?php
                        }
                        ?>
                        <li><a class="dropdown-item" href="cadastro_paciente.php">Cadastro de Paciente</a></li>
                    </ul>
                </li>


                <!-- Aplicações Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="applicationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Aplicações
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="applicationDropdown">
                        <?php
                        if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] == 'medico' || $_SESSION['tipo'] == 'administrador') { ?>
                            <li><a class="dropdown-item" href="cadastro_receita.php">Cadastrar Receitas</a></li>
                        <?php
                        }
                        ?>
                        <li><a class="dropdown-item" href="receitas_pendentes.php">Visualizar Receitas</a></li>
                        <li><a class="dropdown-item" href="registrar_administracao.php">Administrações</a></li>
                    </ul>
                </li>

                <!-- Controle de Usuários Link -->
                <li class="nav-item">
                    <a class="nav-link" href="controle_usuarios.php">Controle de Usuários</a>
                </li>

                <!-- Logout Link -->
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>