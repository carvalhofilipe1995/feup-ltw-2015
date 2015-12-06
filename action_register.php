<?php
  include_once('database/connection.php');
  include_once('database/users.php');
  var_dump($_POST);
  $id = addUser($_POST['username'], sha1($_POST['password']),$_POST['bday'], $_POST['email']);
  if ($id != null) {
	   move_uploaded_file($_FILES['image']["tmp_name"], 'photo/u'.$id.'.jpg');
	   header('Location: ' . $_SERVER['HTTP_REFERER']);

     /*
      * Writting the mail
      */
     $to = $_POST('email');
     $subject = 'Inscrição Agenda';
     $message = '<html>
                      <body>
                        <h1> Inscrição realizada com sucesso </h1>
                        <p> Já poderá usufruir das vantagens que a nossa página disponibiliza. Divirta-se!</p>
                     </body>
                </html>';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    mail($to,$subject,$message,$headers);

	}
  else {
	   echo('Utilizador/Email repetido');
  }
?>
