<?php
  session_start();       
  include_once('database/connection.php');
  include_once('database/users.php');
  $id = checkUser($_POST['username'], sha1($_POST['password']));
  if ($id != null) {
    $_SESSION['username'] = $_POST['username'];   
	$_SESSION['id'] = $id['uid'];   
	header('Location: templates/eventosPublicos.php');
	}
  else {
	?>
	<script type="text/javascript">
	alert("Username ou password errada");
	window.location.href = "index.html";
	</script>
	<?php
	}
?>
