<?php

include_once('config/conexao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/admin.css">
	<link rel="stylesheet" href="../css/style.css">

	<title>Painel Agendamento</title>
</head>
<body>


		<!-- SIDEBAR -->
		<section id="sidebar">
        <br>
		<a href="consultas.php" class="brand">
			<i class='bx bx-plus-medical'></i>
			<span class="text">Sistema de agendamentos</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="consultas.php">
					<i class='bx bxs-calendar' ></i>
					<span class="text">Consultas agendadas</span>
				</a>
			</li>
			<li>
				<a href="adicionarConsultas.php" id="agendar-consultas">
					<i class='bx bxs-calendar-edit' ></i>
					<span class="text">Agendar consultas</span>
				</a>
			</li>
			<li>
				<a href="medicos.php" id="equipe-medicos">
					<i class='bx bx-plus-medical' ></i>
					<span class="text">Equipe de médicos </span>
				</a>
                <ul>
                    <li>
                        <a href="adicionarMedicos.php" id="submenu-medicos" style="display: none;">
                            <i class="bx bx-plus-medical">
                                <span class="text">Adicionar médico</span>
                            </i>
                        </a>
                    </li>
                </ul>
            </li>
            
		</ul>
        
		<ul class="side-menu">
			<!--- talvez mais para frente adicionar config.
            <li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Configurações</span>
				</a>
			</li>
            -->
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Sair</span>
				</a>
			</li>
		</ul>
        
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Pesquisar...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Status de agendamentos</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Painel Administrativo</a>
						</li>
					</ul>
				</div>
				<!---BAIXAR PDF 
                    <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Baixar PDF</span>
				</a>
                --->
			</div>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Gestão de fluxo</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
					<tr style="border-color: black">
                    <th>NOME</th>
                    <th>DATA</th>
                    <th>HORA</th>
                </tr>

                    <?php
                    //consultar no banco de dados
                    $verifica = mysqli_query($mysqli_connection, 
                    "SELECT * FROM tblAGENDA ORDER BY DATA_AGENDAMENTO DESC") ;

                    //Verificar se encontrou resultado na tabela "usuarios"
                    if(($verifica ) AND ($verifica->num_rows != 0)){
                        while($row_usuario = mysqli_fetch_assoc($verifica)){
                            echo '<tr>';
                            echo '<th class="bg-gradient">'. $row_usuario['NOME_MEDICO'] .'</th>';
                            echo '<td class="bg-gradient">'. $row_usuario['DATA_AGENDAMENTO'] .'</td>';
                            echo '<td class="bg-gradient">'. $row_usuario['HORA_AGENDAMENTO'] .'</td>';
                            echo '<td></td>';
                            echo '</tr>';
                        }
                    }else{
                        echo "Nenhum usuário encontrado";
                    }
                    ?>



					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script>
		const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

			allSideMenu.forEach(item=> {
				const li = item.parentElement;
			
				item.addEventListener('click', function () {
					allSideMenu.forEach(i=> {
						i.parentElement.classList.remove('active');
					})
					li.classList.add('active');
				})
			});
			
			
			
			// TOGGLE SIDEBAR
			const menuBar = document.querySelector('#content nav .bx.bx-menu');
			const sidebar = document.getElementById('sidebar');
			
			menuBar.addEventListener('click', function () {
				sidebar.classList.toggle('hide');
			})
			
			
			
			
			
			
			
			const searchButton = document.querySelector('#content nav form .form-input button');
			const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
			const searchForm = document.querySelector('#content nav form');
			
			searchButton.addEventListener('click', function (e) {
				if(window.innerWidth < 576) {
					e.preventDefault();
					searchForm.classList.toggle('show');
					if(searchForm.classList.contains('show')) {
						searchButtonIcon.classList.replace('bx-search', 'bx-x');
					} else {
						searchButtonIcon.classList.replace('bx-x', 'bx-search');
					}
				}
			})
			
			
			
			
			
			if(window.innerWidth < 768) {
				sidebar.classList.add('hide');
			} else if(window.innerWidth > 576) {
				searchButtonIcon.classList.replace('bx-x', 'bx-search');
				searchForm.classList.remove('show');
			}
			
			
			window.addEventListener('resize', function () {
				if(this.innerWidth > 576) {
					searchButtonIcon.classList.replace('bx-x', 'bx-search');
					searchForm.classList.remove('show');
				}
			})
			
			
			
			const switchMode = document.getElementById('switch-mode');
			
			switchMode.addEventListener('change', function () {
				if(this.checked) {
					document.body.classList.add('dark');
				} else {
					document.body.classList.remove('dark');
				}
			})

	</script>
	
</body>
</html>