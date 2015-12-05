<?php
	session_start();
	include_once('database/connection.php');
	include_once('database/events.php');
	if(addParticipant($_SESSION['id'], $_SESSION['eid']) == 0) {
		?>
		<script type="text/javascript">
		alert("Utilizador já participa nesse evento");
		window.location.href = document.referrer;
		</script>
		<?php
	}
?>