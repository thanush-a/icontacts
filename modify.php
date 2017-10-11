<?php
include('session.php');
//var_dump($_SESSION['querysearch']);
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
  <?php
     $arraymodify = $_SESSION['modify_result'];

     ?>

     <form action="" method="post">
     <table>
          <thead>
               <tr>
                   <th>Nom</th>
                   <th>Prénom</th>
                   <th>Mail</th>
                   <th>Mobile</th>

              </tr>
        </thead>
              <tbody>
              <td><input type="text" name="nom_modify" value= <?php echo $arraymodify[0][2]; ?> ></td>
              <td><input type="text" name="prenom_modify" value= <?php echo $arraymodify[0][3]; ?> ></td>
              <td><input type="text" name="mail_modify" value= <?php echo $arraymodify[0][5]; ?>></td>
              <td><input type="number" name="numero_modify" value= <?php echo $arraymodify[0][6]; ?>></td>
              </tbody>
</table>


<center>
  <input id="submit_modify" name="save_modify" type="submit" value=" Sauvegarder">
  <input id="submit_modify" name="delete" type="submit" value=" Supprimer">
  <input id="submit_search" name="back_to_profile" type="submit" value=" Back ">

  </center>
            </body>
          </html>
