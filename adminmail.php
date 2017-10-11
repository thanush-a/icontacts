<?php
include('sendmailtoadmin.php');
?>

<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <title>Page d'Accueil</title>
     <link href="style.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Abel" />

</head>
<body id="bodyback">
<div id="profilesearch">
     <form action="" method="post">
          <center>
               <h3 > Signaler le problem à l'admin </h3>
               <br>
               <b> Nom et prénom :</b><input name="contact_nom" placeholder="Nom Prénom" type="text"><br>
               <b> UserName :</b><input name="contact_user" placeholder="username" type="text"><br>
               <b> Adresse mail :</b><input name="contact_mail" placeholder="mail" type="text"><br>
               <b> Numéro :</b><input name="contact_numero" placeholder="12345678" type="text"><br>
               <b> Message :</b><input  name="contact_msg" placeholder="Commentaire" type="text" style="width: 300px; "><br><br>

               <input name="login_pb_send" type="submit" value=" Envoyer ">
               <input name="login_pb_back" type="submit" value=" Back ">
          </center>
     </form>
</div>
</body>
</html>
