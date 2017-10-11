<?php
     session_start();
     if(session_destroy()) // detuire toutes les sessions
     {
          header("Location: index.php"); // Rediriger vers accueil
     }
?>
