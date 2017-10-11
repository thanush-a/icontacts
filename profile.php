<?php
include('session.php');
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
     <div id="profile">
          <b id="welcome"> Bonjour : <i><?php echo $login_session; ?></i></b>
          <b id="logout"><a href="logout.php">Déconnexion</a></b>
     </div>
     <div id="profilesearch">
          <form action="" method="post">
               <center>
                    <h3 > Rechercher des contacts </h3>
                    <br>
                    <b> Nom du contact :</b><input id="name" name="contact_nom" placeholder="nom" type="text"><br>
                    <b> Prénom :</b><input id="prenom" name="contact_prenom" placeholder="prenom" type="text"><br>
                    <b> Numero :</b><input id="mobile" name="contact_mobile" placeholder="mobile" type="number"><br>
                    <b> Adresse mail :</b><input id="mail" name="contact_mail" placeholder="mail" type="text"><br><br>

                    <input name="search" type="submit" value=" Search ">

                    <?php
                         if ($_SESSION['login_admin']){
                         ?>
                         <hr class="style2">
                         <b> Username :</b><input id="username" name="contact_add_username" placeholder="username" type="text"><br><br>
                         <b> Admin: </b>
                         <input name="adminradio" type="radio" value="1"/> <b> Oui </b>
                         <input name="adminradio" type="radio" value="0" /> <b> Non </b>

                         <input name="add_contact" type="submit" value=" Ajouter contact " >
                         <?php
                         }
                    ?>
                    <span><?php echo $errorsearch; ?></span>
                    <span><?php echo $erroraddcontact; ?></span>
               </center>
          </form>
    </div>
</body>
</html>
