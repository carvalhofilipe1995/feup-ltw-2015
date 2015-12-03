    <div id="menu">
      <?php if (isset($_SESSION['username'])) { ?>
      <form action="action_logout.php" method="post">
        <label><?=$_SESSION['username']?></label>
        <input type="submit" value="Logout">
      </form>
      <?php } else { ?>
      <form action="action_login.php" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="Login">
      </form>
	  <form action="action_register.php" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
		<input type="date" name="bday" placeholder="data nascimento">
        <input type="email" name="email" placeholder="email">
		<input type="file" name="pic" accept="image/*">
        <input type="submit" value="Registar">
      </form>
      <?php } ?>
    </div>