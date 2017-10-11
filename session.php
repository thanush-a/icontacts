
<?php
     // On etablie la connection avec le serveur en envoyant server_name, user_id and password dans les parametres
     $connection = mysqli_connect("localhost", "root", "");
     // choisir la bdd
     $db = mysqli_select_db($connection, "bv1_icontacts");
     session_start();// commencer la session
     // Storing Session
     $user_check=$_SESSION['login_user'];
     // recuperer les donness des users
     $ses_sql=mysqli_query( $connection, "SELECT username from login where username='$user_check'");
     $row = mysqli_fetch_assoc($ses_sql);
     $login_session =$row['username'];

     if(!isset($login_session)){
          mysqli_close($connection); // fermeture de la  Connection
          header('Location: index.php'); // Rediriger vers la page d'accuel
     }

/*
PARTI ACTION POST DE LA PAGE PROFILE
*/
     $errorsearch=''; // variable pour le message d'erreur

     if (isset($_POST['search'])) {

          if (empty($_POST['contact_nom']) && empty($_POST['contact_prenom']) && empty($_POST['contact_mobile']) && empty($_POST['contact_mail'])) {
               $errorsearch = "<br>". "Au moins un champ doit être rempli";
          }
          else {
               // Definie $contactname
               $contact_nom=$_POST['contact_nom'];
               $contact_prenom=$_POST['contact_prenom'];
               $contact_mobile=$_POST['contact_mobile'];
               $contact_mail=$_POST['contact_mail'];

               // On etablie la connection avec le serveur en envoyant server_name, user_id and password dans les parametres
               $connectionsearch = mysqli_connect("localhost", "root", "", "bv1_icontacts");

               // Selecting Database
               $dbsearch = mysqli_select_db($connectionsearch, "bv1_icontacts");
               // SQL requete pour injecter les informations des users

               if ( (!empty($contact_nom)) && (empty($contact_prenom)) && (empty($contact_mobile)) && (empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where nom='$contact_nom'" );
               }
               if ( (empty($contact_nom)) && (!empty($contact_prenom)) && (empty($contact_mobile)) && (empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where prenom='$contact_prenom'" );
               }
               if ( (empty($contact_nom)) && (empty($contact_prenom)) && (!empty($contact_mobile)) && (empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where mobile='$contact_mobile'" );
               }
               if ( (empty($contact_nom)) && (empty($contact_prenom)) && (empty($contact_mobile)) && (!empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where mail='$contact_mail'" );
               }
               if ( (!empty($contact_nom)) && (!empty($contact_prenom)) && (empty($contact_mobile)) && (empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where nom='$contact_nom' and prenom='$contact_prenom'" );
               }
               if ( (!empty($contact_nom)) && (empty($contact_prenom)) && (!empty($contact_mobile)) && (empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where nom='$contact_nom' and mobile='$contact_mobile'" );
               }
               if ( (!empty($contact_nom)) && (empty($contact_prenom)) && (empty($contact_mobile)) && (!empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where nom='$contact_nom' and mail='$contact_mail'" );
               }
               if ( (empty($contact_nom)) && (!empty($contact_prenom)) && (!empty($contact_mobile)) && (empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where prenom='$contact_prenom' and mobile='$contact_mobile'" );
               }
               if ( (empty($contact_nom)) && (!empty($contact_prenom)) && (empty($contact_mobile)) && (!empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where prenom='$contact_prenom' and mail='$contact_mail'" );
               }
               if ( (empty($contact_nom)) && (empty($contact_prenom)) && (!empty($contact_mobile)) && (!empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where mobile='$contact_mobile' and mail='$contact_mail'" );
               }
               if ( (!empty($contact_nom)) && (!empty($contact_prenom)) && (!empty($contact_mobile)) && (empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where nom='$contact_nom' and prenom='$contact_prenom' and mobile='$contact_mobile'" );
               }
               if ( (!empty($contact_nom)) && (!empty($contact_prenom)) && (empty($contact_mobile)) && (!empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where nom='$contact_nom' and prenom='$contact_prenom' and mail='$contact_mail'" );
               }
               if ( (!empty($contact_nom)) && (empty($contact_prenom)) && (!empty($contact_mobile)) && (!empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where nom='$contact_nom' and mobile='$contact_mobile' and mail='$contact_mail'" );
               }
               if ( (empty($contact_nom)) && (!empty($contact_prenom)) && (!empty($contact_mobile)) && (!empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where prenom='$contact_prenom' and mobile='$contact_mobile' and mail='$contact_mail'" );
               }
               if ( (!empty($contact_nom)) && (!empty($contact_prenom)) && (!empty($contact_mobile)) && (!empty($contact_mail)) ) {
                    $querysearch = mysqli_query($connectionsearch, "SELECT * from login where nom='$contact_nom' and prenom='$contact_prenom' and mobile='$contact_mobile' and mail='$contact_mail'" );
               }

               $rowsearch = mysqli_num_rows($querysearch);

               if ($rowsearch == 0) {
                    $errorsearch = "<br>" . "Contact(s) non trouvé(s)" ;
               }
               else {

                    while($rowresult = mysqli_fetch_array($querysearch)){
                        $resultarray[] = $rowresult;
                    }
                    $_SESSION['querysearch'] = $resultarray;
                    header("Location: result.php");
                    //print_r($querysearch);
               }
          }
}
/*
FIN DE PARTI ACTION POST DE LA PAGE PROFILE
*/

/*
PARTI ACTION POST DE LA PAGE PROFILE POUR AJOUTER UN NOUVEAU COMPTE
*/
     $erroraddcontact=''; // variable pour le message d'erreur

     if (isset($_POST['add_contact'])) {

          if (empty($_POST['contact_nom']) || empty($_POST['contact_prenom']) || empty($_POST['contact_mobile']) || empty($_POST['contact_mail']) || empty($_POST['contact_add_username'])) {
          //if (empty($_POST['contact_nom'])) {
               $erroraddcontact = "<br>". "Tous les champs doivent être remplis";
          }
          else {
               // Definie $contactname
               $contact_add_nom=$_POST['contact_nom'];
               $contact_add_prenom=$_POST['contact_prenom'];
               $contact_add_mobile=$_POST['contact_mobile'];
               $contact_add_mail=$_POST['contact_mail'];
               $contact_add_username=$_POST['contact_add_username'];


               $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
               $contact_add_password = substr( str_shuffle( $chars ), 0, 6 );
               
               // On etablie la connection avec le serveur en envoyant server_name, user_id and password dans les parametres
               $connection_add_search = mysqli_connect("localhost", "root", "", "bv1_icontacts");

               // Selecting Database
               $db_add_search = mysqli_select_db($connection_add_search, "bv1_icontacts");
               // SQL requete pour injecter les informations des users

               // SQL requete pour injecter les informations des users
               $query_add_contact = mysqli_query($connection_add_search, "SELECT username FROM login WHERE username = '$contact_add_username'");
               $num_add_rows = mysqli_num_rows($query_add_contact);
               //print_r($num_add_rows);

               if($num_add_rows == 0) {

                    $recup_contact_add_admin="";
                    if(isset($_POST["adminradio"])){
                         $recup_contact_add_admin = $_POST["adminradio"];
                         if($recup_contact_add_admin == "1"){
                              $queryinsert = "INSERT INTO `login` (`id`, `username`, `nom`, `prenom`, `password`, `mail`, `mobile`, `admin`) VALUES (NULL, '$contact_add_username', '$contact_add_nom', '$contact_add_prenom', '$contact_add_password', '$contact_add_mail', '$contact_add_mobile', '1')";
                              if (mysqli_query($connection_add_search, $queryinsert)) {
                                  //echo $recup_contact_add_admin;
                                  echo '<script type="text/javascript">alert("Contact a été bien enregistré :)");</script>';
                              }
                              else {
                                  echo "Erreur: " . $queryinsert . "<br>" . mysqli_error($connection_add_search);
                              }
                              /*


                              */

                              $nommail = $contact_add_nom . " " . $contact_add_prenom ;
                              $mailadresse = $contact_add_mail;
                              $msgmail = "Bonjour ". $nommail . " ! " . "<br><br>" . "Voici votre :" . "<br>" . " username : " . $contact_add_username . "<br>" . " mot de passe : " . $contact_add_password . "<br><br>" . " Best regards ; " . "<br>" . "Thanush & Sandy " . "<br>" . "@Localhost " ;

                              date_default_timezone_set('Etc/UTC');
                              require 'PHPMailer-master/PHPMailerAutoload.php';
                              $mail = new PHPMailer;
                              $mail->isSMTP();
                              $mail->SMTPDebug = 0;
                              $mail->Debugoutput = 'html';
                              $mail->Host = 'smtp.gmail.com';
                              $mail->Port = 587;
                              $mail->SMTPSecure = 'tls';
                              $mail->SMTPAuth = true;
                              $mail->Username = "sisidu777@gmail.com";
                              $mail->Password = "6491275018";
                              $mail->setFrom('sisidu777@gmail.com', 'Admin BV1_iContacts');
                              $mail->addReplyTo($mailadresse, $nommail);
                              $mail->addAddress($mailadresse, $nommail);
                              $mail->Subject = 'Creation de compte sur BV1_icontacts';
                              $mail->msgHTML($msgmail);
                              //$mail->AltBody = 'This is a plain-text message body';

                              if (!$mail->send()) {
                                   echo "Mailer Error: " . $mail->ErrorInfo;
                              } else {
                                 echo '<script type="text/javascript">alert("Mail à été envoyé :)");</script>';
                                 //header('Location: index.php');
                              }
                              /**/

                         }
                         else {
                              $queryinsert = "INSERT INTO `login` (`id`, `username`, `nom`, `prenom`, `password`, `mail`, `mobile`, `admin`) VALUES (NULL, '$contact_add_username', '$contact_add_nom', '$contact_add_prenom', '$contact_add_password', '$contact_add_mail', '$contact_add_mobile', '0')";
                              if (mysqli_query($connection_add_search, $queryinsert)) {
                                  //echo $recup_contact_add_admin;
                                  echo '<script type="text/javascript">alert("Contact a été bien enregistré :)");</script>';
                                  $nommail = $contact_add_nom . " " . $contact_add_prenom ;
                                  $mailadresse = $contact_add_mail;
                                  $msgmail = "Bonjour ". $nommail . " ! " . "<br><br>" . "Voici votre :" . "<br>" . " username : " . $contact_add_username . "<br>" . " mot de passe : " . $contact_add_password . "<br><br>" . " Best regards ; " . "<br>" . "Thanush & Sandy " . "<br>" . "@Localhost " ;

                                  date_default_timezone_set('Etc/UTC');
                                  require 'PHPMailer-master/PHPMailerAutoload.php';
                                  $mail = new PHPMailer;
                                  $mail->isSMTP();
                                  $mail->SMTPDebug = 0;
                                  $mail->Debugoutput = 'html';
                                  $mail->Host = 'smtp.gmail.com';
                                  $mail->Port = 587;
                                  $mail->SMTPSecure = 'tls';
                                  $mail->SMTPAuth = true;
                                  $mail->Username = "sisidu777@gmail.com";
                                  $mail->Password = "6491275018";
                                  $mail->setFrom('sisidu777@gmail.com', 'Admin BV1_iContacts');
                                  $mail->addReplyTo($mailadresse, $nommail);
                                  $mail->addAddress($mailadresse, $nommail);
                                  $mail->Subject = 'Creation de compte sur BV1_icontacts';
                                  $mail->msgHTML($msgmail);
                                  //$mail->AltBody = 'This is a plain-text message body';

                                  if (!$mail->send()) {
                                       echo "Mailer Error: " . $mail->ErrorInfo;
                                  } else {
                                     echo '<script type="text/javascript">alert("Mail à été envoyé :)");</script>';
                                     //header('Location: index.php');
                                  }



                              }
                              else {
                                  echo "Erreur: " . $queryinsert . "<br>" . mysqli_error($connection_add_search);
                              }
                         }
                    }
                    else {
                         $erroraddcontact = "<br>" . "Choix de l'admin non effectué";
                    }
               }
               else{
                    $erroraddcontact = "<br>" . " Username existe déja" ;
               }
               $connection_add_search->close();
     }
}
/*
FIN PARTI ACTION POST DE LA PAGE PROFILE POUR AJOUTER UN NOUVEAU COMPTE
*/

/*
PARTI ACTION POST DE LA PAGE MODIFIER POUR MODIFIER COMPTE
*/
$errormodifycontact=''; // variable pour le message d'erreur

     if (isset($_POST['modify_contact'])) {

          if(isset($_POST["numero_id_radio"])){
               $recup_id_modify = $_POST["numero_id_radio"];
               $_SESSION['id_modify'] = $_POST["numero_id_radio"];
               $id_modify = $_SESSION['id_modify'];

               //connection SQL
               $connection_modify_contact = mysqli_connect("localhost", "root", "");
               // choisir la bdd
               $db_modify_contact = mysqli_select_db($connection_modify_contact, "bv1_icontacts");

               $query_modify_contact = mysqli_query($connection_modify_contact, "SELECT * FROM login WHERE id = $id_modify");

               $rowresult_modify = mysqli_num_rows($query_modify_contact);

               while($rowresult_modify = mysqli_fetch_array($query_modify_contact)){
                    $resultarray_modify[] = $rowresult_modify;
               }
               $_SESSION['modify_result'] =  $resultarray_modify;
               header('Location: modify.php'); // Rediriger vers la page modify.php
               }
               else {
               $errormodifycontact='choisir pour modifier';
          }
     }
/*
FIN DE LA PARTI ACTION POST DE LA PAGE POUR LANCER LA MODIFICATION POUR MODIFIER COMPTE
*/

/*
PARTI ACTION POST DE LA PAGE MODIFIER POUR enregistrer le COMPTE
*/

if (isset($_POST['save_modify'])) {
     $nom_modify = $_POST['nom_modify'];
     $prenom_modify = $_POST['prenom_modify'];
     $mail_modify = $_POST['mail_modify'];
     $numero_modify = $_POST['numero_modify'];

     //connection SQL
     $connection_save_contact = mysqli_connect("localhost", "root", "");
     // choisir la bdd
     $db_save_contact = mysqli_select_db($connection_save_contact, "bv1_icontacts");
     $id_save = $_SESSION['id_modify'];
     $query_modify = "UPDATE login SET nom='$nom_modify', prenom='$prenom_modify', mail='$mail_modify', mobile='$numero_modify' where id='$id_save' ";

     if (mysqli_query($connection_save_contact, $query_modify)) {
          echo '<script type="text/javascript">alert("Contact modifié :)");</script>';
     }
     else{
          echo "Error de modification";
     }
     //header('Location: profile.php'); // Rediriger vers la page d'accuel
}
/*
FIN PARTI ACTION POST DE LA PAGE MODIFIER POUR enregistrer le COMPTE
*/

/*
PARTI SUPPRIMER UN COMPTE
*/
if (isset($_POST['delete'])) {
     //connection SQL
     $connection_del_contact = mysqli_connect("localhost", "root", "");
     // choisir la bdd
     $db_del_contact = mysqli_select_db($connection_del_contact, "bv1_icontacts");
     $id_del = $_SESSION['id_modify'];
     $query_del = "DELETE FROM login WHERE id='$id_del' ";
     if (mysqli_query($connection_del_contact, $query_del)) {
          echo '<script type="text/javascript">alert("Contact supprimé :)");</script>';
          //header('Location: profile.php'); // Rediriger vers la page d'accuel
     }
     else{
          echo "Erreur de suppression";
     }
}
/*
FIN DE LA PARTI SUPPRIMER UN COMPTE
*/
/*
REVENIR EN ARRIER
*/
if (isset($_POST['back_to_profile'])) {
     header('Location: profile.php'); // Rediriger vers la page d'accuel

}
/*
FIN DE LA PARTI REVENIR EN ARRIER
*/

?>
