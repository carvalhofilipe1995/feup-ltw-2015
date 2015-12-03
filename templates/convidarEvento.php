<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Agenda</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
	<div id="background-lightyellow">
		background
	</div>
	<div class="page">
		<div class="project-page">
			<div class="sidebar">
				<a href="eventosPublicos.php" id="logo"><img src="../images/logo.png" alt="logo"></a>
				<ul>
					<li class="home">
						<a href="eventosPublicos.php">Eventos</a>
					</li>
					<li class="about">
						<a href="mensal.php">Mensal</a>
					</li>
					<li class="projects">
						<a href="semanal.php">Semanal</a>
					</li>
					<li class="blog">
						<a href="diario.php">Diário</a>
					</li>
					<li class="about">
						<a href="novoEvento.php">Adicionar</a>
					</li>
					<li class="selected projects">
						<a href="convidarEvento.php">Convidar</a>
					</li>
					<li class="blog">
						<a href="convites.php">Convites</a>
					</li>
				</ul>
				
			</div>
			<div class="body">
				<?php if (isset($_SESSION['id'])) { ?>
				<div class="content">
				<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
				<script type="text/javascript" src="../js/convidarEvento.js"></script>
				<?php } ?>
							
			</div>
		</div>
	</div>
</body>
</html>