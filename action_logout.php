<?php
  session_start();
  session_destroy();
  header('Location: templates/eventosPublicos.php')
?>
