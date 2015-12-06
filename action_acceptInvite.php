<?php
	session_start();
	include_once('database/connection.php');
	include_once('database/events.php');
	if (isset($_SESSION['eid'])){
		$eid = $_SESSION['eid'];
		}
	else 
		$eid = $_POST['eid'];
	if(addParticipant($_SESSION['id'], $eid) == 0) {
		?>
		<script type="text/javascript">
		alert("Utilizador já participa nesse evento");
		window.location.href = document.referrer;
		</script>
		<?php
	}
	else
		header('Location: ' . $_SERVER['HTTP_REFERER']);
?>