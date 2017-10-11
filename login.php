<?php
     session_start(); // debut de la session
     $error=''; // variable pour le message d'erreur

     if (isset($_POST['submit'])) {
          if (empty($_POST['username']) || empty($_POST['password'])) {
               $error = "<br>". "Username or Mot de passe invalide";
          }
          else
          {
               // Definie $username et $password
               $username=$_POST['username'];
               $password=$_POST['password'];

               // On etablie la connection avec le serveur en envoyant server_name, user_id and password dans les parametres
               $connection = mysqli_connect("localhost", "root", "");

               // Proteger les donness MySql
               // protect MySQL injection for Security purpose
               $username = stripslashes($username);
               $password = stripslashes($password);
               $username = mysqli_real_escape_string($connection,$username);
               $password = mysqli_real_escape_string($connection,$password);

               // selectionner la bdd
               $db = mysqli_select_db($connection,"bv1_icontacts" );

               // SQL requete pour injecter les informations des users
               $query = mysqli_query($connection, "SELECT * from login where password='$password' AND username='$username'");
               $rows = mysqli_num_rows($query);

               if ($rows == 1) {
                    $resultadmin = mysqli_query($connection, "SELECT admin FROM login WHERE username='$username'");
                    $valueadmin = mysqli_fetch_object($resultadmin);
                    $_SESSION['login_admin'] = $valueadmin->admin;
                    $_SESSION['login_user']=$username; // Initialiser la Session
                    header("location: profile.php"); // Rediriger vers la page de profile
               }
               if ($rows > 1) {
                    $error = "<br>" . "Username redondant : " . "<a href = 'adminmail.php' onClick='javascript:popUp('adminmail.php' ;
                    'Envoyer un mail à l'admin';position:absolute;width:200px;height:200px;left:100px;top:100px')'‌​>Contacter l'admin</a>" . "<br>" ;
               }
               else {
                    //$error = "<br>" . "Username ou Mot de passe invalide" ;
                    $error = "<br>" . "Username ou Mot de passe invalide : " . "<a href = 'adminmail.php' onClick='javascript:popUp('adminmail.php' ;
                    'Envoyer un mail à l'admin';position:absolute;width:200px;height:200px;left:100px;top:100px')'‌​>Contacter l'admin</a>" . "<br>" ;
               }
               mysqli_close($connection); // fermeture de la  Connection
          }
     }
?>
