<?php
include('login.php'); // Inserer le script de login.php

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <title>Login</title>
     <link href="style.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Abel" />
</head>
<body>
     <div id="main">
          <h1>BV1 Annuaire iContacts</h1>
          <img src="images\image.jpg" alt="image jpg">
          <div id="login">
               <h2>Login Form</h2>
               <form action="" method="post">
                    <label>Nom de l'user :</label>
                    <input id="name" name="username" placeholder="username" type="text">
                    <br>
                    <label> Mot de passe :</label>
                    <input id="password" name="password" placeholder="**********" type="password">
                    <br></br>
                    <input name="submit" type="submit" value=" Login ">
                    <span><?php echo $error; ?></span>
               </form>
          </div>
     </div>
</body>
</html>
