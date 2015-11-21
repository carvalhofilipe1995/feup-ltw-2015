    <div id="utilizador">
	  <h2>Teste funções utilizador</h2>
      <?php if (isset($_SESSION['username'])) { ?>

      <form action="action_logout.php" method="post">
        <label><?=$_SESSION['username']?></label>
        <input type="submit" value="Logout">
      </form>
      <?php } else { ?>
	  <h3>Login</h3>
      <form action="action_login.php" method="post">
        <input type="text" name="username" placeholder="username" required><br>
        <input type="password" name="password" placeholder="password" required><br>
        <input type="submit" value="Login"><br>
      </form>
	  <h3>Registar</h3>
	  <form action="action_register.php" method="post" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="username" required><br>
        <input type="password" name="password" placeholder="password" required><br>
		<input type="date" name="bday" placeholder="data nascimento" required><br>
        <input type="email" name="email" placeholder="email" required><br>
		<input type="file" name="image" required><br>
        <input type="submit" value="Registar"><br>
      </form>
      <?php } ?>
    </div>
	<div id="evento">
		<h2>Teste funções evento</h2>
		<?php if (isset($_SESSION['username'])) { ?>
			<h3>Registar evento</h3>
			<form action="action_addEvent.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value=<?php echo $_SESSION['id']; ?>>
				<input type="text" name="nome" placeholder="Nome" required><br>
				<textarea rows="2" cols="50" name="descricao" placeholder="Descrição"></textarea><br>
				<input type="text" name="localizacao" placeholder="localização" required><br>
				<input type="date" name="data" placeholder="data ocorrência" required><br>
				<input type="time" name="tempo" placeholder="tempo" required><br>
				<input type="file" name="image" required><br>
				<input type="radio" name="tipo" value="0">Público<br>
				<input type="radio" name="tipo" value="1">Privado<br>
				<input type="submit" value="Registar"><br>
			</form>
			<h3>Lista eventos<h3>
			<?php
				$result = getEvent();
				foreach( $result as $row) {
					echo $row['tema']; 
					echo "<br>";
					echo $row['descricao'];
					echo "<br><br>";
					} 
				} else { ?>
			<h3>Lista eventos<h3>
			<?php
				$result = getEvent();
				foreach( $result as $row) {
					echo $row['tema']; 
					echo "<br>";
					echo $row['descricao'];
					echo "<br><br>";
					}
				}
				?>
	</div>
