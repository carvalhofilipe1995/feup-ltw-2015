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
	<div id="background-yellow">
		background
	</div>
	<div class="page">
		<div class="about-page">
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
					<li class="selected about">
						<a href="novoEvento.php">Adicionar</a>
					</li>
					<li class="projects">
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
				<form id = "validaEvento" action="../action_addEvent.php" method="post" enctype="multipart/form-data">
				<div class="sminputs">
				    <div class="input full">
					<input type="hidden" name="id" value=<?php echo $_SESSION['id']; ?>>
					<label class="string optional" for="nome">Nome*</label>

					<input type="text" name="nome" placeholder="Nome" required>
					</div>
				</div>
				<div class="sminputs">
					<div class="input full">
					<label class="string optional" for="descricao">Descrição*</label>

					<textarea rows="2" cols="50" name="descricao" placeholder="Descrição"></textarea>
					</div>
				</div>
				<div class="sminputs">
					<div class="input string optional">
					<label class="string optional" for="localiazação">Localização*</label>
					<input type="text" name="localizacao" placeholder="localização" required>
					</div>
					<div class="input string optional">
					<label class="string optional" for="data">Data*</label>
					<input type="date" name="data" placeholder="data ocorrência" required>
					</div>
				</div>
				<div class="sminputs">
					<div class="input string optional">
					<label class="string optional" for="hora">Hora*</label>
					<input type="time" name="tempo" placeholder="tempo" required>
					</div>
					<div class="input string optional">
					<label class="string optional" for="poster">Poster*</label>
					<input type="file" name="image" required>
					</div>
				</div>
				<div class="sminputs">
					<div class="input string optional">
					<label class="string optional" for="tipo">Público*</label>
					<input type="radio" name="tipo" value="0">
					</div>
					<div class="input string optional">
					<label class="string optional" for="tipo">Privado*</label>
					<input type="radio" name="tipo" value="1">
					</div>
				</div>
				<div class="simform__actions">
					<input class="sumbit" name="commit" type="submit" value="ADICIONAR" />
				</div> 
				</form>
				</div>
				<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
				<?php } ?>
							
			</div>
		</div>
	</div>
</body>
</html>