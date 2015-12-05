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
	<div id="background-green">
		background
	</div>
	<div class="page">
		<div class="home-page">
			<div class="sidebar">
				<a href="eventosPublicos.php" id="logo"><img src="../images/logo.png" alt="logo"></a>
				<ul>
					<li class="selected home">
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
					<li class="projects">
						<a href="gestao.php">Gestão</a>
					</li>
					<li class="blog">
						<a href="convites.php">Convites</a>
					</li>
				</ul>
				
			</div>
			<div class="body">
				<?php if (isset($_SESSION['id'])) { 
				$_SESSION['eid'] = $_GET['eid'];
				?>
				<div class="content">
					<div class="caixaFoto">
					</div>
					<div class="caixaEvento">
						<form id = "dadosEvento" action="../action_acceptInvite.php" method="post" enctype="multipart/form-data">
							<div class="sminputs">
								<div class="input string optional">
								<label class="string optional" for="nome"></label>
								</div>
								<div class="input string optional">
								<label class="string optional" for="descricao"></label>
								</div>
							</div>
							<div class="sminputs">
								<div class="input string optional">
								<label class="string optional" for="localizacao"></label>
								</div>
								<div class="input string optional">
								<label class="string optional" for="data"></label>
								</div>
							</div>
							<div class="sminputs">
								<div class="input string optional">
								<label class="string optional" for="hora"></label>
								</div>
								<div class="input string optional">
								<label class="string optional" for="tipo"></label>
								</div>
							</div>
							<div class="simform__actions">
								<input class="sumbit" name="commit" type="submit" value="ADICIONAR" />
							</div> 
						</form>
					</div>
				<div class="caixaComentarios">
					<div class="adicionarComentario">
						<form action='../action_insertComment.php' method='post'>
							<label class="string optional" for="comentário"><h2>Faça um comentário</h2></label>
							<div class="containerComentario">
								<textarea rows="3" cols="50" name="comentario"></textarea>
							</div>	
							<div class="simform__actions">
								<input class="sumbit" name="commit" type="submit" value="ENVIAR" />
							</div> 
						</form>
					</div>
				</div>
				<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
				<script type="text/javascript" src="../js/detalhesEvento.js"></script>
<?php }
				else
					header('Location: ../index.html');
				?>							
			</div>
		</div>
	</div>
</body>
</html>