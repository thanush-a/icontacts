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
      <div>
           <form action="" method="post">
           <table>
                <thead>
                     <tr>
                     <?php
                     if ($_SESSION['login_admin']){
                          ?>
                         <th>Choix</th>
                         <?php } ?>
                         <th>Nom</th>
                         <th>Prénom</th>
                         <th>Mail</th>
                         <th>Mobile</th>
                    </tr>
                    </thead>
                    <tbody>
                         <?php
                         $arrayresult = $_SESSION['querysearch'];
                         $taille_arrayresult = count($arrayresult);
                         ?>

                         <?php

                         for ($i = 0; $i < 1; $i++) {
                           for ($y = 0; $y < $taille_arrayresult; $y++) {
                                if ($_SESSION['login_admin']){
                                ?>
                                <td><input name="numero_id_radio" type="radio" value= <?php echo $arrayresult[$y][0]; ?> ></td>
                                <?php } ?>
                                <td><?php echo $arrayresult[$y][2]; ?></td>
                                <td><?php echo $arrayresult[$y][3]; ?></td>
                                <td><?php echo $arrayresult[$y][5]; ?></td>
                                <td><?php echo $arrayresult[$y][6]; ?></td>
                                </tr>

                                <?php
                           }
                      }
                      ?>
                    </tbody>
         </table>
   </div>
      <center>
           <?php
           if ($_SESSION['login_admin']){
                ?>
           <input id="submit_modify" name="modify_contact" type="submit" value=" Modifier " >
           <?php } ?>
      </form>
      <input id="submit_search" name="back_profile" type="submit" value=" Back " OnClick="window.location.href='profile.php'">

 </center>
 <center><span><?php echo $errormodifycontact; ?></span></center>
  </body>
</html>
