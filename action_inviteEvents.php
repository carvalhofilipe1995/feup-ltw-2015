<?php
	session_start();
	include_once('database/connection.php');
	include_once('database/events.php');
	if(addGuest($_POST['convidado'], $_POST['eid']) == 0) {
		?>
		<script type="text/javascript">
		alert("Utilizador já participa nesse evento");
		window.location.href = "templates/convidarEvento.php";
		</script>
		<?php
	}
	else 
		header('Location: templates/convidarEvento.php');
?>